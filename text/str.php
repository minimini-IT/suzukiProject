<?php
$a = [
    "a" => 1,
    "b" => 1,
    "c" => 1,
];


$b = [
    [
        "a" => 1,
    ],
    [
        "b" => 1,
    ],
    [
        "c" => 1,
    ]
];

foreach($a as $c)
{
    var_dump($c);
}

foreach($b as $d)
{
    var_dump($d);
}
