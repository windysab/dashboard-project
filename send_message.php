<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Pesan berhasil dikirim";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>