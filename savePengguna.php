<?php
   require 'vendor/autoload.php';

   // Load environment variables from .env file
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();

   // Get database credentials from environment variables
   $servername = $_ENV['DB_HOST'];
   $username = $_ENV['DB_USERNAME'];
   $password = $_ENV['DB_PASSWORD'];
   $dbname = $_ENV['DB_DATABASE'];
   $port = $_ENV['DB_PORT'];

   // Debugging: Log environment variables (remove this in production)
   error_log("DB_HOST: $servername, DB_USERNAME: $username, DB_DATABASE: $dbname, DB_PORT: $port");

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname, $port);

   // Check connection
   if ($conn->connect_error) {
       error_log('Connection failed: ' . $conn->connect_error);
       die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
   }

   // Function to sanitize input
   function sanitize_input($data) {
       return htmlspecialchars(strip_tags(trim($data)));
   }

   // Validate and sanitize POST data
   $nama = isset($_POST['nama']) ? sanitize_input($_POST['nama']) : null;
   $nope = isset($_POST['nope']) ? sanitize_input($_POST['nope']) : null;
   $layanan = isset($_POST['layanan']) ? sanitize_input($_POST['layanan']) : null;
   $satker = isset($_POST['satker']) ? sanitize_input($_POST['satker']) : null;

   if (!$nama || !$nope || !$layanan || !$satker) {
       error_log('Invalid input: ' . json_encode($_POST));
       die(json_encode(['success' => false, 'message' => 'Invalid input']));
   }

   // Prepare and bind
   $stmt = $conn->prepare("INSERT INTO pengguna (nama, nope, layanan, satker) VALUES (?, ?, ?, ?)");
   if (!$stmt) {
       error_log('Prepare failed: ' . $conn->error);
       die(json_encode(['success' => false, 'message' => 'Prepare failed']));
   }
   $stmt->bind_param("ssss", $nama, $nope, $layanan, $satker);

   // Execute statement
   if ($stmt->execute()) {
       $response = [
           'success' => true,
           'data' => $stmt->insert_id // Return the ID of the inserted row
       ];
   } else {
       error_log('Execute failed: ' . $stmt->error);
       $response = [
           'success' => false,
           'message' => 'Error occurred'
       ];
   }

   // Close statement and connection
   $stmt->close();
   $conn->close();

   // Return JSON response
   echo json_encode($response);
   ?>