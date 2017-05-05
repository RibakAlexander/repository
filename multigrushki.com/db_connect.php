<?php
/**
* function db_connect() - выполняет подключение к БД, используя глобальные переменные, определенные в файле config.php
* Возвращает объект (канал передачи данных) с сылкой на подключение к текущей БД.
**/
function db_connect(){
    global $db_host, $db_login, $db_password, $db_name;

    #1 Подключение к серверу БД
    $id = mysql_connect($db_host, $db_login, $db_password) or die(mysql_error());

    #2 Выбор конкретной необходимой БД для дальнейшей работы с таблицами в ней
    mysql_select_db($db_name) or die(mysql_error());

    #3 Настройка кодировки при обмене данными с конкретной БД
    mysql_query("SET character_set_results = 'utf8'") or die(mysql_error());
    mysql_query("SET character_set_client = 'utf8'") or die(mysql_error());
    mysql_query("SET character_set_connection = 'utf8'") or die(mysql_error());

    return $id;
}
?>