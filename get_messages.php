<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$recipient = $_SESSION['username'];
$sql = "SELECT username, message, timestamp FROM messages WHERE recipient='$recipient' OR recipient='admin' ORDER BY timestamp DESC";
$result = $conn->query($sql);

$messages = array();
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);

$conn->close();
?>