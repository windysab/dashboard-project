<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$response = array('success' => false, 'message' => 'Pendaftaran gagal');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitasi input
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Gunakan prepared statements untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO hak (nama, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Pendaftaran berhasil';
    } else {
        $response['message'] = 'Terjadi kesalahan saat mendaftar';
    }

    $stmt->close();
}

$conn->close();

// Tambahkan header untuk memastikan konten JSON
header('Content-Type: application/json');
echo json_encode($response);
?>