<?php
$array = ["banana", "strawberry", "yudoufu"];
$result = array_map(function($string)
{
    $vowels = ["a", "i", "u", "e", "o"];
    return str_replace($vowels, "", $string);
}, $array);
echo join(", ", $result);
/*
$a = ["test" => "testtest", "sample" => "samplesample"];
$b = function($q, $e) use ($a as $key =>$value)
{
    return ""
} 
 */
