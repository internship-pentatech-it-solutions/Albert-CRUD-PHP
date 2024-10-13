<?php
// DATABASE CONNECTION DETAILS
$host = "localhost";
$port = 3307;
$db = "internship_ecommerce";
$username = "root";
$password = "";

$dsn ="mysql:host=$host;port=$port;dbname=$db";

// CREATING A NEW PDO INSTANCE FOR DATABASE CONNECTION
$conn = new PDO($dsn,$username,$password);
