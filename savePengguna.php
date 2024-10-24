<?php
// savePengguna.php

header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Fungsi untuk membersihkan input
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Mengambil dan membersihkan data POST
$nama = sanitize_input($_POST['nama']);
$nope = sanitize_input($_POST['nope']);
$layanan = sanitize_input($_POST['layanan']);
$satker = sanitize_input($_POST['satker']);

// Menyiapkan dan mengikat
$stmt = $conn->prepare("INSERT INTO pengguna (nama, nope, layanan, satker) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nama, $nope, $layanan, $satker);

// Menjalankan statement
if ($stmt->execute()) {
    $response = [
        'success' => true,
        'data' => $stmt->insert_id // Mengembalikan ID dari baris yang dimasukkan
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Error: ' . $stmt->error
    ];
}

// Menutup statement dan koneksi
$stmt->close();
$conn->close();

// Mengembalikan respons JSON
echo json_encode($response);
?>