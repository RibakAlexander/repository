<?
/****
// Список регионов и цен, для показа.
*/
$price = array(
	'UA' => array(
		'country'	=> 'Украина',
		'currency'	=> 'грн',
		'current'	=> 848,
		'your'		=> 399
	),
	'RU' =>	array(
		'country'	=> 'Россия',
		'currency'	=> 'р',
		'current'	=> 2440,
		'your'		=> 1150
	),
	'KZ' =>	array(
		'country'	=> 'Казахстан',
		'currency'	=> 'тг',
		'current'	=> 29765,
		'your'		=> 13990
	),
	'BY' =>	array(
		'country'	=> 'Беларусь',
		'currency'	=> 'р',
		'current'	=> 74,
		'your'		=> 35
	)
);

/****
// Подключение определителя региона пользователя.
// Для работы модуля, необходимо наличие файла "SxGeo.dat" с базой регионов.
// Модуль взят на https://sypexgeo.net/ 
*/
require('./SxGeo.php');
$SxGeo = new SxGeo();
$country = $SxGeo->getCountry($_SERVER['REMOTE_ADDR']); //(возвращает двухзначный ISO-код страны)

/****
// Проверка наличия записи о регионе пользователя.
// Если запись о регионе пользователя отсутствует в списке $price, то
// устанавливается регион поумолчанию, из регионов, определенных в списке $price.
*/
if (!array_key_exists($country, $price)) $country = 'UA';
?>