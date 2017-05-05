<?php
function vardump($obj){
	$result = typeOf($obj);
?>
<div style="font: 100% 'Courier New'; margin: 10px 0;">
<?php
	echo $result ."\n";

	if (gettype($obj) == 'array') {
    	arrayList($obj);
	}
?>
</div>
<?php
}

function arrayList($arr) {
?>
<ul style="list-style-type: none; margin: 0; padding-left: 16px;">
<?php
	foreach ($arr as $key => $value) {
?>
	<li><?php
		echo (is_int($key) ? $key : "'". $key ."'") .' => '. typeOf($value) .'<br />';
		if (gettype($value) == 'array') {
        	arrayList($value);
		}
?></li>
<?php
	}
?>
</ul>
<?php
}

function typeOf($obj) {
	if (isset($obj)) {
		switch (gettype($obj)) {
			case 'integer':
				$result = '<b style="font-size: 75%;">int</b>&nbsp;<span style="color: #0A0">'. $obj .'</span>';
				break;
			case 'double':
	            $result = '<b style="font-size: 75%;">float</b>&nbsp;<span style="color: #F00">'. $obj .'</span>';
				break;
			case 'string':
	            $result = '<b style="font-size: 75%;">string</b>&nbsp;<span style="color: #B00">\''. $obj .'\'</span>&nbsp;<i>(length='. strlen($obj) .')</i>';
				break;
	        case 'boolean':
	            $result = '<b style="font-size: 75%;">boolean</b>&nbsp;<span style="color: #00F">'. ($obj == true ? 'true' : 'false') .'</span>';
				break;
			case 'array':
	            $result = '<b>array</b>&nbsp;<i>(size='. count($obj) .'):</i>';
				break;
			default:
				$result = '<span style="color: #00A">null</span>';

		}
	} else {
		$result = 'null or "ERROR: no data"';
	}

	return $result;
}
?>