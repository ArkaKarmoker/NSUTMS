<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'driver') header("Location: ../login.php");
include '../db.php';

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Fetch rides
$stmt = $conn->prepare("SELECT r.*, d.name as dest, bt.time as time FROM rides r JOIN destinations d ON r.destination_id = d.id JOIN bus_times bt ON r.time_id = bt.id WHERE driver_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$rides = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard - NSUTMS</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    <style>
        /* --- DASHBOARD STYLES (MATCHING ADMIN/STUDENT THEME) --- */
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4CAF50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
            --sidebar-width: 250px;
            --header-height: 70px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
            position: fixed;
            height: 100%;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h3 {
            font-weight: 600;
            margin: 0;
            font-size: 1.4rem;
        }
        
        .sidebar-header p {
            opacity: 0.8;
            font-size: 0.9rem;
            margin: 5px 0 0;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            cursor: pointer; /* Ensures it looks clickable */
        }
        
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--accent-color);
            color: white;
            text-decoration: none;
        }
        
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--accent-color);
        }
        
        .menu-item i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 25px;
            text-align: center;
        }
        
        /* Main Content Area */
        .admin-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 0;
        }
        
        .admin-header {
            height: var(--header-height);
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        
        .header-left h1 {
            font-size: 1.5rem;
            color: var(--dark-color);
            margin: 0;
            font-weight: 600;
        }
        
        .welcome-text {
            font-size: 0.95rem;
            color: #666;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
            font-size: 1.2rem;
        }
        
        .logout-btn {
            background-color: var(--danger-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .logout-btn:hover {
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(244, 67, 54, 0.3);
        }
        
        .logout-btn i {
            margin-right: 6px;
        }
        
        /* Profile Button Style */
        .profile-btn-header {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-right: 10px;
            cursor: pointer;
        }

        .profile-btn-header:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 25px;
        }
        
        /* Welcome Section */
        .welcome-card {
            background: linear-gradient(135deg, var(--primary-color), #5a6ff0);
            color: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
        }

        .welcome-card h2 {
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .welcome-card p {
            opacity: 0.9;
            margin-bottom: 0;
            font-size: 1.1rem;
        }

        /* Content Cards */
        .content-card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            height: 100%;
            transition: all 0.3s;
            border-top: 4px solid var(--primary-color);
        }
        
        /* Action Card Styling */
        .content-card.action-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            justify-content: center;
            border-top-color: var(--warning-color);
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .action-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: #fff8e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--warning-color);
            transition: all 0.3s;
        }
        
        .content-card:hover .action-icon {
            background-color: var(--warning-color);
            color: white;
        }
        
        .section-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            color: var(--primary-color);
            font-size: 1.3rem;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            margin-top: 30px;
        }
        
        /* Profile Modal Styles */
        .profile-label {
            font-weight: 600;
            color: #666;
            margin-bottom: 5px;
        }
        .profile-value {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .admin-sidebar {
                width: 70px;
                overflow: hidden;
            }
            
            .admin-sidebar:hover {
                width: var(--sidebar-width);
            }
            
            .sidebar-header h3, .sidebar-header p, .menu-item span {
                display: none;
            }
            
            .admin-sidebar:hover .sidebar-header h3,
            .admin-sidebar:hover .sidebar-header p,
            .admin-sidebar:hover .menu-item span {
                display: block;
            }
            
            .admin-main {
                margin-left: 70px;
            }
            
            .admin-sidebar:hover .menu-item i {
                margin-right: 12px;
            }
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                display: none;
            }
            
            .admin-main {
                margin-left: 0;
            }
            
            .admin-header {
                padding: 0 15px;
                flex-direction: column;
                height: auto;
                padding: 15px;
            }
            
            .header-left {
                margin-bottom: 15px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-sidebar">
            <div class="sidebar-header">
                <h3>Driver Portal</h3>
                <p>NSUTMS</p>
            </div>
            
            <div class="sidebar-menu">
                <a href="dashboard.php" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="map.php" class="menu-item">
                    <i class="fas fa-map"></i>
                    <span>Route Map</span>
                </a>
                <a href="manage_ride.php" class="menu-item">
                    <i class="fas fa-bus"></i>
                    <span>Manage Ride</span>
                </a>
                <div class="menu-item" data-bs-toggle="modal" data-bs-target="#profileModal">
                    <i class="fas fa-user-circle"></i>
                    <span>View Profile</span>
                </div>
            </div>
        </div>
        
        <div class="admin-main">
            <div class="admin-header">
                <div class="header-left">
                    <h1>Driver Dashboard</h1>
                    <div class="welcome-text">Welcome, <?php echo htmlspecialchars($user['first_name']); ?></div>
                </div>
                
                <div class="user-info">
                    <div class="user-avatar" style="padding: 0; overflow: hidden; background: transparent;">
                        <?php 
                        $avatar_role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : (isset($user['role']) ? strtolower($user['role']) : 'student');
                        $avatar_gender = 'male';
                        if (isset($user['gender'])) $avatar_gender = strtolower($user['gender']);
                        elseif (isset($user_header['gender'])) $avatar_gender = strtolower($user_header['gender']);
                        elseif (isset($gender)) $avatar_gender = strtolower($gender);
                        
                        $avatar_url = '../assets/img/avatars/student_male.png';
                        if ($avatar_role === 'admin') $avatar_url = '../assets/img/avatars/admin.png';
                        elseif ($avatar_role === 'driver') $avatar_url = '../assets/img/avatars/driver.png';
                        elseif ($avatar_gender === 'female') $avatar_url = '../assets/img/avatars/student_female.png';
                        echo '<img src="' . $avatar_url . '" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">';
                        ?>
                    </div>
                    <button class="profile-btn-header" data-bs-toggle="modal" data-bs-target="#profileModal">
                        <i class="fas fa-user me-2"></i> Profile
                    </button>
                    <a href="../logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
            
            <div class="dashboard-content">
                
                <div class="welcome-card">
                    <h2>Welcome back, <?php echo htmlspecialchars($user['first_name']); ?>!</h2>
                    <p>View your assigned trips and update ride statuses below.</p>
                </div>
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="content-card action-card">
                            <div class="action-icon">
                                <i class="fas fa-play-circle"></i>
                            </div>
                            <h5>Current Operations</h5>
                            <p class="text-muted small mb-3">Update status for your assigned trips</p>
                            <a href="manage_ride.php" class="btn btn-primary w-100">Manage Active Ride</a>
                        </div>
                    </div>
                </div>

                <div class="content-card">
                    <h3 class="section-header"><i class="fas fa-history me-2"></i> My Rides History</h3>
                    <div class="table-responsive">
                        <table id="ridesTable" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Trip Date</th>
                                    <th>Destination</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Started At</th>
                                    <th>Ended At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($rides)): ?>
                                    <tr><td colspan="6" class="text-center">No rides found.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($rides as $ride): ?>
                                        <tr>
                                            <td><?php echo $ride['trip_date']; ?></td>
                                            <td><?php echo $ride['dest']; ?></td>
                                            <td><?php echo $ride['time']; ?></td>
                                            <td>
                                                <?php 
                                                    $status = strtolower($ride['status']);
                                                    $badgeClass = 'bg-secondary';
                                                    if ($status == 'completed' || $status == 'ended') $badgeClass = 'bg-success';
                                                    elseif ($status == 'started') $badgeClass = 'bg-primary';
                                                    elseif ($status == 'pending') $badgeClass = 'bg-warning';
                                                    elseif ($status == 'cancelled') $badgeClass = 'bg-danger';
                                                ?>
                                                <span class="badge <?php echo $badgeClass; ?>" style="color: white !important;">
                                                    <?php echo ucfirst($ride['status']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo $ride['started_at'] ?? '-'; ?></td>
                                            <td><?php echo $ride['ended_at'] ?? '-'; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="footer">
                    <p>NSUTMS &copy; <?php echo date('Y'); ?> | Driver Portal</p>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="profileModalLabel"><i class="fas fa-id-card me-2"></i>My Driver Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="user-avatar mx-auto" style="padding: 0; overflow: hidden; background: transparent;">
                        <?php 
                        $avatar_role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : (isset($user['role']) ? strtolower($user['role']) : 'student');
                        $avatar_gender = 'male';
                        if (isset($user['gender'])) $avatar_gender = strtolower($user['gender']);
                        elseif (isset($user_header['gender'])) $avatar_gender = strtolower($user_header['gender']);
                        elseif (isset($gender)) $avatar_gender = strtolower($gender);
                        
                        $avatar_url = '../assets/img/avatars/student_male.png';
                        if ($avatar_role === 'admin') $avatar_url = '../assets/img/avatars/admin.png';
                        elseif ($avatar_role === 'driver') $avatar_url = '../assets/img/avatars/driver.png';
                        elseif ($avatar_gender === 'female') $avatar_url = '../assets/img/avatars/student_female.png';
                        echo '<img src="' . $avatar_url . '" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">';
                        ?>
                    </div>
                        <h4 class="mt-2"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h4>
                        <span class="badge bg-secondary">Role: <?php echo ucfirst($user['role']); ?></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-label">Email Address</div>
                            <div class="profile-value"><?php echo htmlspecialchars($user['email']); ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-label">Phone Number</div>
                            <div class="profile-value"><?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-label">Gender</div>
                            <div class="profile-value"><?php echo htmlspecialchars(ucfirst($user['gender'] ?? 'N/A')); ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-label">Driving License</div>
                            <div class="profile-value"><?php echo htmlspecialchars($user['driving_license'] ?? 'N/A'); ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-label">Experience</div>
                            <div class="profile-value"><?php echo htmlspecialchars($user['years_of_experience'] ?? '0'); ?> Years</div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-label">National ID (NID)</div>
                            <div class="profile-value"><?php echo htmlspecialchars($user['nid'] ?? 'N/A'); ?></div>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-2 mb-0 d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-3 fa-2x"></i>
                        <div>
                            <strong>Need to update information?</strong><br>
                            Please contact the admin at <a href="mailto:admin@example.com" class="alert-link">admin@example.com</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#ridesTable').DataTable();
            
            // Add active class to current menu item
            var url = window.location.pathname;
            var filename = url.substring(url.lastIndexOf('/') + 1);
            $('.menu-item').removeClass('active');
            $('.menu-item').each(function() {
                var href = $(this).attr('href');
                if (href === filename) {
                    $(this).addClass('active');
                }
            });
            
            // Animate cards on load
            $('.content-card').each(function(i) {
                var $card = $(this);
                $card.css('opacity', '0');
                setTimeout(function() {
                    $card.css('opacity', '1').animate({opacity: 1}, 300);
                }, i * 100);
            });
            
            // Simple animation for welcome card
            $('.welcome-card').hide().fadeIn(800);
        });
    </script>
</body>
</html>