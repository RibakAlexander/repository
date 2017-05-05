<?php

header('Content-type: text/html; charset="utf-8"');

require('./SxGeo.php');

/***
// Первый параметр - имя файла с базой (используется бинарная БД Sypex Geo)
// Второй параметр - режим работы: 
//  SXGEO_FILE   (работа с файлом базы, режим по умолчанию); 
//  SXGEO_BATCH  (пакетная обработка, увеличивает скорость при обработке множества 
//                IP за раз);
//  SXGEO_MEMORY (кэширование БД в памяти, еще увеличивает скорость пакетной обработки, 
//                но требует больше памяти, для загрузки всей базы в память).
*/

$SxGeo = new SxGeo('SxGeoCity.dat'); // Режим по умолчанию, файл бд SxGeo.dat
//$SxGeo = new SxGeo('SxGeo.dat', SXGEO_BATCH | SXGEO_MEMORY); // Самый быстрый режим пакетный режим

$country = $SxGeo->getCountry($_SERVER['REMOTE_ADDR']);  //(возвращает двухзначный ISO-код страны)
// $SxGeo->getCountryId($ip); (возвращает номер страны)

var_dump($country);

$city = $SxGeo->getCity($_SERVER['REMOTE_ADDR']);

var_dump($city);


echo 'фывапролд';
?>