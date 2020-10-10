<?php 
$a = 1;
$b = 2;
try
{
    $a = 3;
    throw new Exception("error");
    $b = 4;
}
catch(Exception $e)
{
    echo "例外", $e->getMessage(), "\n";
}

echo "{$a}\n";
echo "{$b}\n";
