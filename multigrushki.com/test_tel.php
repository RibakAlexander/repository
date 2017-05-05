<?php
require('./vardump.php');
$subject = "0123456789";
$pattern = '/^\d{10}$/'; // http://www.php.su/lessons/?lesson_17
/*
^ - начинать с первого символа,
\d - проверить на предмет соответстви€ только числу (от 0 до 9),
{10} - количество Ё“»’ символов,
$ - проверить указанные услови€ до самого конца данной строки
*/
preg_match($pattern, $subject, $matches);
vardump($matches);

if (
    !empty(
        preg_match($pattern, $subject, $matches)
        )
    )
{
    echo $subject;
}
?>
