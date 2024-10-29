<?php
$servername = '127.0.0.1';
$username = 'u520364085_chart';
$password = 'Kadatahu123db';
$dbname = 'u520364085_chart';
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    echo 'Connection successful';
}

$conn->close();
?>