<?php
require 'vendor/autoload.php';
require 'dbConnection.php'; // Include the database connection file

// Function to format phone number for display
function formatPhoneNumber($phone)
{
    if (empty($phone)) return '-';

    // Remove any non-numeric characters
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

    if (strlen($cleanPhone) >= 3) {
        // Show first 2-3 digits followed by xxx
        if (substr($cleanPhone, 0, 2) == '08') {
            return '08xxx';
        } else if (substr($cleanPhone, 0, 3) == '628') {
            return '628xxx';
        } else if (substr($cleanPhone, 0, 1) == '0') {
            return substr($cleanPhone, 0, 2) . 'xxx';
        } else {
            return substr($cleanPhone, 0, 3) . 'xxx';
        }
    }
    return $phone; // Return original if too short
}

// Query to get all users
$sql = "SELECT id, nama, nope, layanan, satker FROM pengguna";
$result = $conn->query($sql);

// Get total user count
$countSql = "SELECT COUNT(*) as total FROM pengguna";
$countResult = $conn->query($countSql);
$totalUsers = $countResult->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            margin-top: 30px;
            padding: 30px;
        }

        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-title {
            color: #2c3e50;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .search-container {
            margin-bottom: 25px;
        }

        .search-input {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 12px 20px 12px 50px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .custom-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .custom-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .custom-table thead th {
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 20px 15px;
        }

        .custom-table tbody tr {
            transition: all 0.3s ease;
        }

        .custom-table tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.01);
        }

        .custom-table tbody td {
            padding: 15px;
            border-color: #e9ecef;
            vertical-align: middle;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 10px;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: #6c757d;
        }

        .no-data i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="fas fa-users"></i> Dashboard Pengguna
                </h1>
                <p class="text-muted">Kelola dan pantau data pengguna sistem</p>
            </div>

            <div class="row">
                <div class="col-md-4 mx-auto">
                    <div class="stats-card">
                        <div class="stats-number"><?php echo $totalUsers; ?></div>
                        <div class="stats-label">
                            <i class="fas fa-user-friends"></i> Total Pengguna
                        </div>
                    </div>
                </div>
            </div>

            <div class="search-container">
                <div class="position-relative">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari pengguna berdasarkan nama, layanan, atau satker...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table custom-table" id="userTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> ID</th>
                            <th><i class="fas fa-user"></i> Nama</th>
                            <th><i class="fas fa-phone"></i> No. HP</th>
                            <th><i class="fas fa-cog"></i> Layanan</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $initial = strtoupper(substr($row['nama'], 0, 1));
                                $maskedPhone = formatPhoneNumber($row['nope']);
                                echo "<tr>
                                        <td><strong>{$row['id']}</strong></td>
                                        <td>
                                            <div class='d-flex align-items-center'>
                                                <div class='user-avatar'>{$initial}</div>
                                                <span>{$row['nama']}</span>
                                            </div>
                                        </td>
                                        <td><i class='fas fa-phone-alt text-success'></i> {$maskedPhone}</td>
                                        <td><span class='badge badge-primary'>{$row['layanan']}</span></td>
                                        
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='no-data'>
                                    <i class='fas fa-inbox'></i>
                                    <h5>Tidak ada data pengguna</h5>
                                    <p>Belum ada pengguna yang terdaftar dalam sistem</p>
                                  </td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Search functionality
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#userTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>