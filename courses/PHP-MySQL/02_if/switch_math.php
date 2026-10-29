<?php

$a = 52;
$b = 27;
$op = "@";
$txt = null ;
$result = null ;

switch ($op) {
    case "+":
        $txt = "حاصل جمع دو متغیر";
        $result = $a + $b;
        break;
    case "-":
        $txt = "حاصل تفریق دو متغیر";
        $result = $a - $b;
        break;
    case "/":
        $txt = "حاصل تقسیم دو متغیر";
        $result = $a / $b;
        break;
    case "*":
        $txt = "حاصل ضرب دو متغیر";
        $result = $a * $b;
        break;

    default:
        echo "error";
}

if($txt == null and $result == null){
    echo "";
}else{
    echo $txt . " : " . $result;
}
