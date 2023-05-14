<?php
$serverName="localhost";
$userName="root";
$userPassword="";
$dbName="shopping_db";
$conn=mysqli_connect($serverName,$userName,$userPassword,$dbName);
if(!$conn)
die("connection error".mysqli_connect_error());
