<?php

$a = 1034;
$b = 234;
$c = 198;

if($a > $b and $a > $c){
    echo "a is the biggest";
} elseif ($b > $a and $b > $c){
    echo "b is the biggest";
} elseif ($c > $a and $c > $b) {
    echo "c is the biggest";
}