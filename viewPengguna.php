<?php
require 'vendor/autoload.php';
require 'dbConnection.php'; // Include the database connection file

// Query to get all users with created_at timestamp
$sql = "SELECT id, nama, nope, layanan, satker, created_at FROM pengguna ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna - PTSP Online</title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="icon" href="assets/images/PA-AMUNTAI.ico">

    <!-- Custom Styles -->
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
            margin: 20px;
            padding: 30px;
            animation: fadeInUp 0.8s ease;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .page-header h1 {
            margin: 0;
            font-weight: 700;
            font-size: 2.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .page-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .stats-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-card {
            flex: 1;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            min-width: 200px;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .table {
            margin: 0;
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 20px 15px;
            font-size: 0.9rem;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #eee;
        }

        .table tbody tr:hover {
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table tbody td {
            padding: 18px 15px;
            vertical-align: middle;
            border: none;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .user-details h6 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        .user-details small {
            color: #666;
        }

        .badge-layanan {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-chat {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
        }

        .badge-telepon {
            background: linear-gradient(45deg, #007bff, #6610f2);
            color: white;
        }

        .badge-video {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
        }

        .date-badge {
            background: linear-gradient(45deg, #6c757d, #495057);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .no-data i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 10px;
                padding: 20px;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .stats-cards {
                flex-direction: column;
            }

            .table-responsive {
                font-size: 0.9rem;
            }

            .user-info {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="main-container">
            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-users"></i> Daftar Pengguna</h1>
                <p>Sistem Pelayanan Terpadu Satu Pintu Online - PA Amuntai</p>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3><?php echo $result->num_rows; ?></h3>
                    <p>Total Pengguna</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar-day"></i>
                    <h3><?php echo date('d'); ?></h3>
                    <p><?php echo date('F Y'); ?></p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-clock"></i>
                    <h3><?php echo date('H:i'); ?></h3>
                    <p>Waktu Sekarang</p>
                </div>
            </div>

            <!-- Users Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> ID</th>
                                <th><i class="fas fa-user"></i> Pengguna</th>
                                <th><i class="fas fa-phone"></i> Kontak</th>
                                <th><i class="fas fa-concierge-bell"></i> Layanan</th>
                                <th><i class="fas fa-building"></i> Satuan Kerja</th>
                                <th><i class="fas fa-calendar-plus"></i> Tanggal Input</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                $no = 1;
                                while ($row = $result->fetch_assoc()) {
                                    // Get first letter of name for avatar
                                    $initial = strtoupper(substr($row['nama'], 0, 1));

                                    // Format date
                                    $tanggal_input = isset($row['created_at']) && $row['created_at'] ?
                                        date('d M Y, H:i', strtotime($row['created_at'])) :
                                        'Tidak tersedia';

                                    // Determine layanan badge class
                                    $badge_class = '';
                                    switch (strtolower($row['layanan'])) {
                                        case 'chat':
                                            $badge_class = 'badge-chat';
                                            break;
                                        case 'telepon':
                                            $badge_class = 'badge-telepon';
                                            break;
                                        case 'video':
                                            $badge_class = 'badge-video';
                                            break;
                                        default:
                                            $badge_class = 'badge-chat';
                                    }

                                    echo "<tr>
                                            <td><strong>#{$row['id']}</strong></td>
                                            <td>
                                                <div class='user-info'>
                                                    <div class='user-avatar'>{$initial}</div>
                                                    <div class='user-details'>
                                                        <h6>{$row['nama']}</h6>
                                                        <small>Pengguna #{$row['id']}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <i class='fas fa-phone-alt' style='color: #28a745; margin-right: 8px;'></i>
                                                {$row['nope']}
                                            </td>
                                            <td>
                                                <span class='badge-layanan {$badge_class}'>
                                                    " . ucfirst($row['layanan']) . "
                                                </span>
                                            </td>
                                            <td>
                                                <i class='fas fa-building' style='color: #6c757d; margin-right: 8px;'></i>
                                                {$row['satker']}
                                            </td>
                                            <td>
                                                <span class='date-badge'>
                                                    <i class='fas fa-calendar' style='margin-right: 5px;'></i>
                                                    {$tanggal_input}
                                                </span>
                                            </td>
                                          </tr>";
                                    $no++;
                                }
                            } else {
                                echo "<tr>
                                        <td colspan='6' class='no-data'>
                                            <i class='fas fa-users-slash'></i>
                                            <h5>Tidak ada data pengguna</h5>
                                            <p>Belum ada pengguna yang terdaftar dalam sistem</p>
                                        </td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-info-circle"></i>
                    Data diperbarui secara real-time |
                    <i class="fas fa-shield-alt"></i>
                    Sistem Aman & Terpercaya |
                    <i class="fas fa-clock"></i>
                    <?php echo date('d F Y, H:i:s'); ?>
                </small>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add some interactive effects
        $(document).ready(function() {
            // Animate stats cards on page load
            $('.stat-card').each(function(index) {
                $(this).delay(200 * index).animate({
                    opacity: 1
                }, 500);
            });

            // Add click effect to table rows
            $('.table tbody tr').click(function() {
                $(this).addClass('table-active');
                setTimeout(() => {
                    $(this).removeClass('table-active');
                }, 200);
            });
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>