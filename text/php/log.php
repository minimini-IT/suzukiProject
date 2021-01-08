<?php 
$file = "/home/vagrant/suzukiProject/logs/DBUPDATE.log";
$log = file_get_contents($file);
$log = str_replace("\n", "", $log);
//$log = str_replace(" ", "", $log);
$log = preg_replace("/\s\s+/", " ", $log);
$log = str_replace("(", "", $log);
$log = str_replace(")", "", $log);
//echo $log."\n";
//$pattern = "/[0-9]{4}-[0-9]{2}-[0-9]{4}:[0-9]{2}:[0-9]{2}Info:/";
$pattern = "/[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2} Info: Array/";
//$pattern_A = "/articles_id/";
//$log = explode($pattern, $log);
$log = preg_split($pattern, $log);
//preg_match($pattern, $log, $match);
$log_A = array();
foreach($log as $a)
{
    $a = str_replace("[", ",['", $a);
    $a = str_replace("]", "']", $a);
    $a = preg_replace("/,/", "", $a, 1, $count);
    $a = preg_split("/,/", $a);
    $log_B = array();
    foreach($a as $b)
    {
        //$b = array($b);
        echo print_r($b, true)."\n";
        array_push($log_B, $b);
    }
    //$a = array($a);
    array_push($log_A, $log_B);
    //$a = preg_replace("/\s\s+/", " ", $a, 1, $count);

    //echo print_r($a, true)."\n";
//    //if(!empty($b))
//    //{
//    //    echo print_r($b, true);
//    //}
}
//echo "\n";
//echo print_r($log_A, true);
//echo "\n";
//echo is_array($log_A);
//echo "\n";
//foreach($log_A as $a)
//{
//    echo is_array($a) ? "Array\n" : "not Array\n";
//    //echo $a["action"]."\n";
//}

//echo print_r($match, true);
