<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['user'];
$message = $_POST['message'];

$sql = "INSERT INTO messages (user, message) VALUES ('$user', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>