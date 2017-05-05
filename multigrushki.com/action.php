<?php
require('./vardump.php');
require('./config.php');
session_start();

// echo 'данные из формы Заказа';
// vardump($_POST);
$_SESSION['action_log'][] = 'Поступили входящие данные из $_POST => '. implode(', ', $_POST);

if ( // перед записью в БД проверяем ключевые значения на соответствие и отсутствие мусора
    !empty(preg_match('/^\d{10}$/', $_POST['tel_value'], $matches))
    &&
    !empty(preg_match('/^\d+$/', $_POST['id'], $matches))
){
    /*
    Цель: сохранение полученных данных в БД для фиксации каждой заявки клиента
    Условия: 1) без условий (сразу после приема данных - записать путем сохранения в БД).
    План:
    1. подключение к серверу БД
    2. Выбор необходимой БД для дальнейшей работы с таблицами в ней
    3. Выполнение запросов для работы с таблицами выбранной БД
        3.1 Настройка кодировки при обмене данными с конкретной БД

        3.2 (Цель: проверка наличия в БД идентификатора $_POST['id'] из формы Заказать для обеспечения безопасноти сайта от DDoss атак,
            а также доступности и актуальности товара.)
            3.2.1 получения данных по записи из таблицы с товарами соответственно входящему от пользователю идентификатору

        3.3 запись полученных данных из формы Заказать в таблицу БД
    4. Отключение от сервера БД

    */
    $id = mysql_connect($db_host, $db_login, $db_password) or die($_SESSION['action_log'][] = mysql_error());

    mysql_select_db($db_login) or die(mysql_error());

    mysql_query("SET character_set_results = 'utf8'") or die(mysql_error());
    mysql_query("SET character_set_client = 'utf8'") or die(mysql_error());
    mysql_query("SET character_set_connection = 'utf8'") or die(mysql_error());

    $query = 'SELECT `quantity_fact` FROM `goods` WHERE id='. $_POST['id'] .' LIMIT 1';

    //// vardump($query);
    $_SESSION['action_log'][] = $query;

    $goods_data = mysql_query($query) or die(mysql_error());

    //var_dump($goods_data);

    $quantity_fact = mysql_fetch_assoc($goods_data);

    if($quantity_fact){
        // vardump('запись об этом товаре присутствует в БД');
        // При проветке количества товара в наличии и получении данных 0 - сообщаем клиенту о его отстуствии;
        // 1. извлекаем значение с количеством товара из ассоциативного массива с данными об этом товаре
        // по именю ключа "quantity_fact"
        // // vardump($quantity_fact['quantity_fact']);
        // 2. выполняем процедуру сравнения полученного количества с нулем в качестве критерия минимума
        // 3

        if ($quantity_fact['quantity_fact'] == 0){
            // vardump('Заказываемый Вами товар на данный момент отсутствует.');
        } else {
            // vardump('Заказываемый Вами товар на данный момент имеется в наличии с достаточным кол-вом. Выполнится запись Заказа в БД');
            // vardump($_SERVER['REMOTE_ADDR']);

            mysql_query(
            'INSERT INTO `orders` (
                `goods_id`,
                `tel`,
                `name`,
                `ip`
                )
                VALUES (
                        '. $_POST['id'] .',                        
                        "'. $_POST['tel_value'] .'",
                        "'. $_POST['client_name'] .'",
                        "'. $_SERVER['REMOTE_ADDR'] .'"
                        )'
            ) or die(mysql_error());

            $result = mysql_query("SELECT name FROM `goods` WHERE id=". $_POST['id'] ." LIMIT 1") or die(mysql_error());
            $res = mysql_fetch_assoc($result) or die(mysql_error());
            // vardump($res);
            // отправка информации на почту taobaolarix@gmail.com
            require('./modules/mailer.php');

            // редирект на главную страницу
            header('Location:http://'. $_SERVER['HTTP_HOST'] .'/index.php');

        }
    } else {
        // echo 'Заказываемый Вами товар на данный момент отсутствует.';
    }

    // vardump($quantity_fact);



    mysql_free_result($goods_data);

    mysql_close($id);

}

?>
