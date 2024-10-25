<?php
session_start();

$response = array('role' => 'guest');
if (isset($_SESSION['role'])) {
    $response['role'] = $_SESSION['role'];
}

echo json_encode($response);
?>