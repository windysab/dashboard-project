<?php
header('Content-Type: application/json');
// Get database credentials from environment variables
$servername = '127.0.0.1';
$username = 'u520364085_chart';
$password = 'Kadatahu123db';
$dbname = 'u520364085_chart';
$port = 3306;
// Buat koneksi

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM visitor_count ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    $data = [
        'total_count' => 0,
        'today_count' => 0,
        'today_date' => date('Y-m-d'),
        'month_count' => 0,
        'current_month' => date('n')
    ];
}

echo json_encode($data);
$conn->close();
?>