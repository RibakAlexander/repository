 <?php header('Content-Type: text/html; charset="utf-8"');

ini_set('display_errors', 1);

require('./vardump.php');

$header = "Date: ". date("D, j M Y G:i:s") ." +0300\r\n";
$header.= "From: =?utf-8?Q?". str_replace("+", "_", str_replace("%", "=", urlencode('Максим'))). "?=<sales@alexcreater.in.ua>\r\n";
$header.= "X-Mailer: The Bat! (v3.99.3) Professional\r\n";
$header.= "Reply-To: =?utf-8?Q?". str_replace("+", "_", str_replace("%", "=", urlencode('Максим'))). "?=<sales@alexcreater.in.ua>\r\n";
$header.= "X-Priority: 3 (Normal)\r\n";
$header.= "Message-ID: <172562218.". date("YmjHis") ."@alexcreater.in.ua>\r\n";
$header.= "To: =?utf-8?Q?". str_replace("+", "_", str_replace("%", "=", urlencode('Сергей')))."?=<asd@qwe.ru>\r\n";
$header.= "Subject: =?utf-8?Q?". str_replace("+", "_", str_replace("%", "=", urlencode('проверка')))."?=\r\n";
$header.= "MIME-Version: 1.0\r\n";
$header.= "Content-Type: text/plain; charset=utf-8\r\n";
$header.= "Content-Transfer-Encoding: 8bit\r\n";

$text = "привет, проверка связи.";

vardump($header);
vardump($text);

$smtp_conn = fsockopen("mail.alexcreater.in.ua", 2525, $errno, $errstr, 10);

function get_data($smtp_conn)
{
    $data = "";
    while ($str = fgets($smtp_conn,515))
    {
        $data .= $str;
        if (substr($str, 3, 1) == " "){ break; }
    }
    return $data;
}

$data = get_data($smtp_conn);

fputs($smtp_conn, "EHLO mail.alexcreater.in.ua\r\n");
$data = get_data($smtp_conn);

fputs($smtp_conn, "AUTH LOGIN\r\n");
$data = get_data($smtp_conn);

fputs($smtp_conn, base64_encode("sales@alexcreater.in.ua")."\r\n");
$data = get_data($smtp_conn);

fputs($smtp_conn, base64_encode("vlad2012")."\r\n");
$data = get_data($smtp_conn);

fputs($smtp_conn, "MAIL FROM:sales@alexcreater.in.ua\r\n");
$data = get_data($smtp_conn);

fputs($smtp_conn, "RCPT TO:ed-210@ukr.net\r\n");
$data = get_data($smtp_conn);

fputs($smtp_conn, "DATA\r\n");
$data = get_data($smtp_conn);

fputs($smtp_conn, $header ."\r\n". $text ."\r\n.\r\n");
$data = get_data($smtp_conn);

fputs($smtp_conn, "QUIT\r\n");
$data = get_data($smtp_conn);

//mail("lighter_r@yahoo.com", "My Subject", "Line 1\nLine 2\nLine 3", "From: webmaster@". $_SERVER['SERVER_NAME'] ."\r\n");

?>