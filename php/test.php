<?php

$s1 = 'cheese';
$s2 = 'nips';
$s3 = 'blob';

$str = <<<JSON
    "s1" : "$s1",
    "s2" : "$s2",
    "s3" : "$s3"
JSON;

$str .= 3;
echo "{<br>" . $str . "<br>}<br>";

$arr = array("1", "2", "3");
$arr = array_merge( $arr, array(4, 5, 6));
print_r($arr);
echo "<br>";

$xml = simplexml_load_string('<root/>');
$child = $xml->addChild('astrid');
$child->addChild('david');
$xml->addChild('beverly');
$xml->addChild('chad');
$xml->addChild('astrid');
print_r($xml);
echo '<br>';
print_r(sizeof($xml->children()));

?>