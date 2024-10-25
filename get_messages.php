<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$recipient = $_GET['recipient'];
$sql = "SELECT username, message, timestamp FROM messages WHERE recipient='$recipient' ORDER BY timestamp DESC";
$result = $conn->query($sql);

$messages = array();
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);

$conn->close();
?>