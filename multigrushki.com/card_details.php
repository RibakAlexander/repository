<?php
//считывание данных (информации) о товарак из БД (MY_SQL)
$id = db_connect();

/*
#1 Подключение к серверу БД
$id = mysql_connect('localhost', 'ukr410817_store', 'vlad2012') or die(mysql_error());

#2 Выбор конкретной необходимой БД для дальнейшей работы с таблицами в ней
mysql_select_db('ukr410817_store') or die(mysql_error());

#3 Выполнение запросов для работы с таблицами выбранной БД
    #3.1 Настройка кодировки при обмене данными с конкретной БД
    mysql_query("SET character_set_results = 'utf8'") or die(mysql_error());
    mysql_query("SET character_set_client = 'utf8'") or die(mysql_error());
    mysql_query("SET character_set_connection = 'utf8'") or die(mysql_error());
*/

    #3.2 Считывание содержимого (строки с данными) таблицы БД
    #vardump('SELECT * FROM goods WHERE id='. $_GET['goodsdetail'] .' LIMIT 1');
    $result = mysql_query('SELECT * FROM `goods` WHERE id='. $_GET['goodsdetail'] .' LIMIT 1') or die(mysql_error());

#4 Оброботка полученных данных

$element = mysql_fetch_array($result, MYSQL_ASSOC);

$cat_id = $element['category_id'];
$result_cat = mysql_query('SELECT * FROM `categories` WHERE id = '. $cat_id .' LIMIT 1') or die(mysql_error());
$row_cat = mysql_fetch_array($result_cat, MYSQL_ASSOC);

#5.1 (предпоследний пункт) очистка буфера результатов на сервере БД
mysql_free_result($result);
#5.2 (самый последний пункт) Отключение от сервера БД
mysql_close($id);
?>
                    <h2><?=$row_cat['name']?></h2>
                    <!--[START goods]-->
                    <div id="goods">
                    <?php
                    /*
                    1. в левом верхнем углу отображаем фото товара в большом размере(50% от ширины области артиклз);
                    2. в правой части артиклз:
                        2.1 отбражаем "Детальная информация о товаре:" и подробно ...
                        2.2 указываем цену;
                        2.3 кнопка "Заказать".

                    */
                    ?>
                        <div id="details">
                            <img src="./img/gallery/img_<?=$element['id']?>_orig.jpg" alt="<?=$element['name']?>" />
                            <div>
                                <h3><?=$element['name']?></h3>
                                <p id="in_stock">В налиции</p>
                                <h4><?=$element['price']?>,00 грн</h4>
                                <button name="btn_order" onclick="display_form('<?=$element['id']?>', '<?=$element['name']?>', '<?=$element['price']?>')">Заказать</button>
                            </div>
                            <br class="clear" />
                            <div class="btn_details">
                                <span>Детальная информация о товаре:</span>
                                <p><?=$element['description']?></p>
                            </div>
                        </div>
                        
                    </div>
                    <!--[END goods]-->
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
