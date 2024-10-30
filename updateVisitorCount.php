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

$input = json_decode(file_get_contents('php://input'), true);

$totalCount = $input['totalCount'];
$todayCount = $input['todayCount'];
$todayDate = $input['todayDate'];
$monthCount = $input['monthCount'];
$currentMonth = $input['currentMonth'];

$sql = "INSERT INTO visitor_count (total_count, today_count, today_date, month_count, current_month)
        VALUES ('$totalCount', '$todayCount', '$todayDate', '$monthCount', '$currentMonth')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$conn->close();
?>