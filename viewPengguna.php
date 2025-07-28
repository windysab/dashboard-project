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
            padding: 20px 0;
        }

        .main-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .header-section {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #f8f9fa;
        }

        .header-title {
            color: #2c3e50;
            font-weight: 800;
            font-size: 2.8rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-subtitle {
            color: #6c757d;
            font-size: 1.2rem;
            font-weight: 400;
        }

        .search-container {
            margin-bottom: 30px;
        }

        .search-input {
            border-radius: 30px;
            border: 3px solid #e9ecef;
            padding: 15px 25px 15px 55px;
            font-size: 16px;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
            transform: translateY(-2px);
        }

        .search-icon {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            font-size: 18px;
        }

        .custom-table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .custom-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .custom-table thead th {
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            padding: 25px 20px;
            font-size: 14px;
        }

        .custom-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f1f3f4;
        }

        .custom-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
            transform: translateX(5px);
            box-shadow: 5px 0 15px rgba(102, 126, 234, 0.1);
        }

        .custom-table tbody td {
            padding: 20px;
            vertical-align: middle;
            border: none;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-right: 15px;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .user-name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }

        .phone-number {
            color: #28a745;
            font-weight: 500;
        }

        .service-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .no-data i {
            font-size: 5rem;
            margin-bottom: 25px;
            opacity: 0.4;
            color: #667eea;
        }

        .no-data h5 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 10px;
                padding: 20px;
            }

            .header-title {
                font-size: 2.2rem;
            }

            .custom-table {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="main-container">
            <div class="header-section">
                <h1 class="header-title">
                    <i class="fas fa-users"></i> Daftar Pengguna
                </h1>
                <p class="header-subtitle">Kelola dan pantau data pengguna sistem</p>
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
                            <th><i class="fas fa-building"></i> Satker</th>
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
                                        <td><strong class='text-primary'>{$row['id']}</strong></td>
                                        <td>
                                            <div class='d-flex align-items-center'>
                                                <div class='user-avatar'>{$initial}</div>
                                                <span class='user-name'>{$row['nama']}</span>
                                            </div>
                                        </td>
                                        <td><i class='fas fa-phone-alt phone-number'></i> <span class='phone-number'>{$maskedPhone}</span></td>
                                        <td><span class='service-badge'>{$row['layanan']}</span></td>
                                        <td><i class='fas fa-building text-info'></i> {$row['satker']}</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='no-data'>
                                    <i class='fas fa-users-slash'></i>
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