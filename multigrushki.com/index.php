<?php
session_start();
header('Content-type: text/html; charset="utf-8"');

ini_set('display_errors', '1');

require('./vardump.php');

require("./config.php");

require('./db_connect.php');

//vardump($_SESSION['action_log']);

?>

<?php echo '<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Мульт Игрушки</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="./img/icon3.png" />
    <link rel="stylesheet" type="text/css" href="./css/main.css" />
    <link rel="stylesheet" type="text/css" href="./css/goods.css" />
    <script type="text/javascript" src="./js/main.js"></script>
    <script type="text/javascript" src="./js/goods.js"></script>
    <script type="text/javascript" src="./js/menu_main.js"></script>
    <!--<meta name="description" content="Description of the contents" />
    <meta name="keywords" content="keyword1, keyword2" />
    <link rel="icon" type="image/vnd.microsoft.icon" href="./favicon.ico" />

        <link rel="icon" type="image/png" href="/someimage.png" />
        <link rel="icon" type="image/jpeg" href="/someimage.jpg" />

    <link rel="stylesheet" type="text/css" href="./style.css" />

    <script type="text/javascript" src="./script.js"></script>
    <script type="text/javascript">
//<![CDATA[

//]]>
    </script>
    -->
</head>
<body>

<!--[START layout]-->
<div id="layout">

    <!--[START layout_top]-->
    <div id="layout_top">

        <!--[START layout_top_in]-->
        <div id="layout_top_in">
            &nbsp;
        </div>
        <!--[END layout_top_in]-->

    </div>
    <!--[END layout_top]-->

<!--[START layin]-->
    <div id="layin">

        <!--[START header]-->
        <div id="header">

            <!--[START call_back]-->
            <div id="call_back">
                <p>Заказать обратный звонок</p>
            </div>

            <!--[END call_back]-->

            <!--[START logo]-->
            <h1><a href="index.php" title="Мульт Игрушки - перейти на главную"><b>Toys</b>Store</a></h1>
            <!--[END logo]-->


        </div>
        <!--[END header]-->


        <div id="middle">

            <div id="right_side">

                <!--[START article]-->
                <div id="article">
                <?php
                    //место для реагирование на отсутствие или наличее параметра, отвечающий за показ контента ниже
                    if ( !empty($_GET['goodsdetail']) ){
                        require('./card_details.php');
                    } else {
                        require('./goods.php');
                    }
                ?>


                <?php
                //конец процесса реагирования на режимы показа карточки товара
                ?>

                </div>
                <!--[END article]-->

                <!--[START blocks]-->
                <div id="blocks">

                        <div id="about">
                            <h2>О нас</h2>
                            <p>
                            Окунитесь в мир детства с игрушками из любимых мультфильмов!<br /><br />Пусть яркая и смелая жизнь начинается с самого рождения. Мы отобрали для Вас самое лучшее.<br /><br />К Вашим услугам широкий ассортимент, удобство доставки и оплаты.<br /><br />Вместе мы сможем раскрасить детство наших малышей удивительными цветами, удвоить пользу и удовольствие от процесса познания мира, сделать его незабываемым.
                            </p>
                        </div>

                        <div id="events">
                            <h2>Оплата и доставка</h2>
                            <p>
                            <u>Оплата:</u><br />Вы можете оплатить товар любым удобным для Вас способом!<br />По факту получения товара<br />По предоплате на карту Приват Банка БЕЗ КОМИССИИ.<br /><br /><u>Доставка:</u><br />Заказ можно получить в 1 из 2000+ отделений "Новой Почты", а также на отделениях других транспортных компаний: Интайм, Автолюкс, Деливери. Так же есть возможность забрать свой заказ в городе Одесса с нашего склада самовывозом.
                            </p>
                        </div>
                    <br class="clear"/>
                    </div>
                    <!--[END blocks]-->

            </div>

            <!--[START nav]-->
            <div id="nav">
                <h2>Каталог</h2>
<?php
if (file_exists($mod_nav)){
    require($mod_nav);
}
?>
            </div>
            <!--[END nav]-->
        </div>
        <br class="clear" />
    </div>
    <!--[END layin]-->


    <!--[START layout_bottom]-->
    <div id="layout_bottom">

        <!--[START layout_bottom_in]-->
        <div id="layout_bottom_in">
            <div id="footer">
                <p>Copyright 2017 &copy; multigrushki.com Mult Igrushki Store. All Rights Reserved. Powered by AlexCreator</p>
            </div>
        </div>
        <!--[END layout_bottom_in]-->

    </div>
    <!--[END layout_bottom]-->

</div>
<!--[END layout]-->




</body>
</html>