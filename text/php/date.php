<?php
$datetime = date("Y-m-d H:i:s");
echo "{$datetime}\n";
$datetime = date("Y-m-d H:i:s", strtotime("-1 month -2day"));
echo "{$datetime}\n";

