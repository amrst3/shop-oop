<?php

$host = "localhost";
$user = "root";
$pass = "";
$dpName = "shop";

$conn = mysqli_connect($host,$user,$pass,$dpName);

if (!$conn) {
    echo "Connection faild";
}