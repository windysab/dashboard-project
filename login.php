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

$response = array('success' => false, 'message' => 'Username atau password salah');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitasi input
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Gunakan prepared statements untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM hak WHERE nama = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Debugging: Log data pengguna
        error_log("User found: " . print_r($user, true));

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            $response['success'] = true;
            $response['message'] = 'Login berhasil';
        } else {
            // Debugging: Log ketidakcocokan password
            error_log("Password mismatch for user: $username");
        }
    } else {
        // Debugging: Log pengguna tidak ditemukan
        error_log("User not found: $username");
    }

    $stmt->close();
}

$conn->close();

// Tambahkan header untuk memastikan konten JSON
header('Content-Type: application/json');
echo json_encode($response);
?>