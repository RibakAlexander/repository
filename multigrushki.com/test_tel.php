<?php
require('./vardump.php');
$subject = "0123456789";
$pattern = '/^\d{10}$/'; // http://www.php.su/lessons/?lesson_17
/*
^ - �������� � ������� �������,
\d - ��������� �� ������� ������������ ������ ����� (�� 0 �� 9),
{10} - ���������� ���� ��������,
$ - ��������� ��������� ������� �� ������ ����� ������ ������
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
