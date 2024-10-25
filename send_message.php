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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $message = $_POST['message'];
    $recipient = $_POST['recipient'];

    $sql = "INSERT INTO messages (username, message, recipient) VALUES ('$username', '$message', '$recipient')";
    if ($conn->query($sql) === TRUE) {
        echo "Pesan berhasil dikirim";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>