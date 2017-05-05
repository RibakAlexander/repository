<?php

if ( !empty($_GET['catalog']) ){
    $cat_id = $_GET['catalog'];
    $param = ' WHERE category_id = '. $_GET['catalog'];
} else {
    $cat_id = 1;
    $param = '';
    // в противном случае показывает все карточки без фильтра категории
}

$id = db_connect();

require("./img_resize.php");

//считывание данных (информации) о товарак из БД (MY_SQL)
/*
#1 Подключение к серверу БД
$id = mysql_connect($db_host, $db_login, $db_password) or die(mysql_error());

#2 Выбор конкретной необходимой БД для дальнейшей работы с таблицами в ней
mysql_select_db('ukr410817_store') or die(mysql_error());

#3 Выполнение запросов для работы с таблицами выбранной БД
    #3.1 Настройка кодировки при обмене данными с конкретной БД
    mysql_query("SET character_set_results = 'utf8'") or die(mysql_error());
    mysql_query("SET character_set_client = 'utf8'") or die(mysql_error());
    mysql_query("SET character_set_connection = 'utf8'") or die(mysql_error());
*/

    #3.2 Считывание содержимого (строки с данными) таблицы БД
    $result_cat = mysql_query('SELECT * FROM `categories` WHERE id = '. $cat_id .' LIMIT 1') or die(mysql_error());
    $row_cat = mysql_fetch_array($result_cat, MYSQL_ASSOC);

    $result = mysql_query('SELECT * FROM `goods`'. $param) or die(mysql_error());


#4 Оброботка полученных данных
$formated_data = array();
#4.3 повторяем процедуру 4.1 до тех пор пока имеются строки с данными
while (
        (
            #4.1 извлекаем одну строку данных из архива результатов и сохраням в переменную
            $row = mysql_fetch_array($result, MYSQL_ASSOC)
        )
        !== #4.2 производим проверку на наличие последней строки с данными / конец цикла
        false
      )
{
    $formated_data[] = $row; #4.4 пересохранняем временный результат строки данных в резервный масив для дальнейшей работы
}

#5.1 (предпоследний пункт) очистка буфера результатов на сервере БД
mysql_free_result($result);
#5.2 (самый последний пункт) Отключение от сервера БД
mysql_close($id);
?>
                    <h2><?=$row_cat['name']?></h2>

                    <!--[START goods]-->
                    <div id="goods">

                        <?php //вывод данных из базы
                            //echo 'вывод данных из базы';
//                            vardump($formated_data);
                            /*
                            1. из $formated_data извлечь группы данных по каждому отдельному товару (подмассивы)
                            2. вывести каждый элемент подмассива по отдельности, а затем определить место для содержимого
                                каждого элемента в структуре карточки товара
                            3. Поместить эти элементы в карточку товара, заменив первичное содержимое на требущееся
                                из этих элементов.
                            */
                            foreach ($formated_data as $key => $element){
//                                echo 'Вывод данных элемента - '. $key . "\n";
//                                vardump($element);
//                                echo 'Содержимое ключа "id" - '. $element['id']. "<br/>\n";
//                                echo 'Содержимое ключа "category_id" - '. $element['category_id']. "<br/>\n";
//                                echo 'Содержимое ключа "name" - '. $element['name']. "<br/>\n";
//                                echo 'Содержимое ключа "price" - '. $element['price']. "<br/>\n";
//                                echo 'Содержимое ключа "quantity_fact" - '. $element['quantity_fact']. "<br/>\n";
//                                echo 'Содержимое ключа "description" - '. $element['description']. "<br/>\n";

                               //($key+1 % 4) // 0 % 3 = 0
                                        // 1 % 3 = 1
                                        // 2 % 3 = 2
                                        // 3 % 3 = 0
                                        //
                                        // 4 % 4 = 0
                                $addition_class = '';
                                if ( ($key+1) % 4 == 0){
                                    $addition_class = ' last';
                                }

                        ?>

                        <!--[START card <?=$element['id']?>]-->
                        <div class="card<?=$addition_class?>">
                            <!--[
                            1. что бы ссылка была на развернутую карточку о данном конкретном товаре (mult-ingrushki.com/goodsdetail-1)
                            2. заменить заголовок на краткое наименование данного товара и вместо карточек товара отобразить
                            детальную инфо о выбранном товаре
                            ]-->
                            <a href="?goodsdetail=<?=$element['id']?>" title="<?=$element['name']?>">
                                <?php
                                if ( !file_exists('./img/gallery/img_'. $element['id'] .'_main.jpg') ){
                                    @img_resize(
                                        './img/gallery/img_'. $element['id'] .'_orig.jpg',
                                        './img/gallery/img_'. $element['id'] .'_main.jpg',
                                        177, 177
                                    );
                                }
                                ?>
                                <span>
                                    <img src="./img/gallery/img_<?=$element['id']?>_main.jpg" alt="<?=$element['name']?>"
                                    onmouseover="this.src = './img/gallery/img_<?=$element['id']?>_hover.jpg';"
                                    onmouseout="this.src = './img/gallery/img_<?=$element['id']?>_main.jpg';" />
                                </span>

                                <u><?=$element['price']?>,00 грн</u>

                                <p>
                                    <?=$element['description']?>
                                </p>
                            </a>
                            <button name="btn_order" onclick="display_form('<?=$element['id']?>', '<?=$element['name']?>', '<?=$element['price']?>')">

                                           Заказать
                            </button>
                            <!--
                            После нажатия кнопки Заказать должна появится форма для заполнения данных (телефон, имя) и
                            дальнейшей отправки введенной информации для дальнейшего оформления заказа на покупку выбранного товара.
                            1. Интерфейс всплывающего окна - форма с информацией (указать время прозвона клиентов 8-20) и полями для заполнения данных, а именно:
                                - телефон,
                                - имя,
                                - удобное время принятия звонка,
                                - e-mail
                            2. Алгоритм работы:
                                - при нажатии кнопки Заказать отобразить всплывающее окно формы поверх текущей страницы сайта (приглушенный на 30% и неактивной)
                                - введение данных клиента в необходимые поля
                                - реакция на нажатие кнопки формы Отправить, а именно:
                                    - отправка данных в БД из полей формы с указанием IP адреса клиента, а также даты и времени отправки заявки
                                    - отправка данных в электронном виде на определенный почтовый адрес
                                - вывести сообщение "Ваша заявка принята" с кнопкой Закрыть
                                - по нажатию кнопки Закрыть выведенное сообщение убрать
                                - текущая страница сайта возвращается в исходное состояние (т.е. активной) до нажатия кнопки Заказать
                            3. Реализация:
                                - всплывающая Форма заказа (по умолчанию не отображаемая)

                            -->

                            <!--<input type="button" value="Order by 1 click" />-->
                        </div>
                        <!--[END card <?=$element['id']?>]-->

                        <?php
                            if ( ($key+1) % 4 == 0){
                            ?>
                            <br class="clear" />
                            <?php
                            }
                        }
                        // END foreach

                        if ( ( ($key+1) % 4) != 0){
                        ?>
                        <br class="clear" />
                        <?php
                        }
                        ?>


                        <!--<br class="clear"/>-->

                    </div>
                    <!--[END goods]-->

                    <!--Заказ в 1 клик
                Номер телефона
                +38 (0__)___-__-__ <button>Заказать</button>
                Заказать без оформления. Просто оставить телефон и консультант решит все вопросы по оформлению заказа. Время -->
                    <div id="modal">

                        <form name="q_order" id="q_order" action="./action.php" method="post">
                            <h3>Быстрый заказ</h3>
                            <h4><span><?=$element['name']?></span> (1 шт.) - на сумму: <?=$element['price']?>,00 грн</h4>
                            <p>Ваше Имя:</p>
                                <input type="text" name="client_name" />
                            <p>
                                Телефон:    
                            </p>                            
                            <input type="hidden" name="id" />
                            <input type="hidden" name="tel_value" />
                            <input type="text" name="tel" onkeydown="check_tel(event)" onkeypress="check_form(event)"/>
                            <p>
                                После получения заказа наш менеджер свяжется с вами и уточнит все детали, после чего вы сможете получить свой товар в убодное для вас время.
                            </p>
                            <input class="btn btn-2 btn-2c" type="button" value="Оформить Заказ" onclick="check_form(event)" />
                            <input class="btn btn-2 btn-2c" type="button" value="Отмена" onclick="cancel_form()" />
                        </form>
                    </div>