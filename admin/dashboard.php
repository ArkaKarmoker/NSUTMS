<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header("Location: ../login.php");
include '../db.php';

// Fetch logged-in user data
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// --- DASHBOARD STATISTICS LOGIC ---

// 1. Total Users
$userQuery = $conn->query("SELECT COUNT(*) as count FROM users");
$totalUsers = $userQuery->fetch_assoc()['count'];

// 2. Total Students
$studentQuery = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'student'");
$totalStudents = $studentQuery->fetch_assoc()['count'];

// 3. Total Drivers
$driverQuery = $conn->query("SELECT COUNT(*) as count FROM users WHERE role = 'driver'");
$totalDrivers = $driverQuery->fetch_assoc()['count'];

// 4. Destinations
$destQuery = $conn->query("SELECT COUNT(*) as count FROM destinations");
$totalDestinations = $destQuery->fetch_assoc()['count'];

// 5. Active Buses
$busQuery = $conn->query("SELECT COUNT(*) as count FROM buses");
$totalBuses = $busQuery->fetch_assoc()['count'];

// 6. Schedules
// Calculating total unique time slots defined in bus_times using DISTINCT
$scheduleQuery = $conn->query("SELECT COUNT(DISTINCT time) as count FROM bus_times"); 
$totalSchedules = $scheduleQuery->fetch_assoc()['count'];

// 7. Total Payment Methods
$methodQuery = $conn->query("SELECT COUNT(*) as count FROM payment_options");
$totalPaymentMethods = $methodQuery->fetch_assoc()['count'];

// 8. Total Rides
$rideQuery = $conn->query("SELECT COUNT(*) as count FROM rides");
$totalRides = $rideQuery->fetch_assoc()['count'];

// 9. Ticket Statistics
$ticketStatsQuery = $conn->query("
    SELECT 
        COUNT(t.id) as total_tickets,
        SUM(CASE WHEN t.payment_status = 'paid' THEN 1 ELSE 0 END) as paid_tickets,
        SUM(CASE WHEN t.payment_status = 'pending' THEN 1 ELSE 0 END) as pending_tickets,
        SUM(CASE WHEN t.payment_status = 'paid' THEN d.fare * t.seats ELSE 0 END) as total_revenue
    FROM tickets t
    LEFT JOIN destinations d ON t.destination_id = d.id
");
$ticketStats = $ticketStatsQuery->fetch_assoc();
$totalTickets = $ticketStats['total_tickets'] ?? 0;
$paidTickets = $ticketStats['paid_tickets'] ?? 0;
$pendingTickets = $ticketStats['pending_tickets'] ?? 0;
$totalRevenue = $ticketStats['total_revenue'] ?? 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Transport Management System</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <style>
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
        
        /* Content Cards */
        .content-card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        
        .section-header {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            color: var(--primary-color);
        }

        /* Ticket Stats Row */
        .ticket-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .ticket-stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: transform 0.3s;
        }

        .ticket-stat-card:hover {
            transform: translateY(-3px);
        }

        .ticket-stat-card .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .ticket-stat-card .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        .ticket-stat-card.total { border-top: 4px solid #4361ee; }
        .ticket-stat-card.total .stat-number { color: #4361ee; }

        .ticket-stat-card.paid { border-top: 4px solid #4CAF50; }
        .ticket-stat-card.paid .stat-number { color: #4CAF50; }

        .ticket-stat-card.pending { border-top: 4px solid #ff9800; }
        .ticket-stat-card.pending .stat-number { color: #ff9800; }

        .ticket-stat-card.revenue { border-top: 4px solid #9c27b0; }
        .ticket-stat-card.revenue .stat-number { color: #9c27b0; font-size: 1.5rem; }

        /* Dashboard Content */
        .dashboard-content {
            padding: 25px;
        }
        
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
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 4px solid var(--primary-color);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        /* Colors for different stats */
        .stat-card.users { border-top-color: #4361ee; }
        .stat-card.students { border-top-color: #17a2b8; }
        .stat-card.drivers { border-top-color: #6610f2; }
        .stat-card.destinations { border-top-color: #4CAF50; }
        .stat-card.buses { border-top-color: #FF9800; }
        .stat-card.schedules { border-top-color: #e83e8c; }
        .stat-card.methods { border-top-color: #6c757d; }
        .stat-card.rides { border-top-color: #2196F3; }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 15px;
        }
        
        .stat-icon.users { background-color: #4361ee; }
        .stat-icon.students { background-color: #17a2b8; }
        .stat-icon.drivers { background-color: #6610f2; }
        .stat-icon.destinations { background-color: #4CAF50; }
        .stat-icon.buses { background-color: #FF9800; }
        .stat-icon.schedules { background-color: #e83e8c; }
        .stat-icon.methods { background-color: #6c757d; }
        .stat-icon.rides { background-color: #2196F3; }
        
        .stat-card h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0 0 5px;
            color: var(--dark-color);
        }
        
        .stat-card p {
            color: #666;
            font-size: 0.95rem;
            margin: 0;
        }
        
        .quick-actions {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .action-btn {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px 20px;
            text-decoration: none;
            color: var(--dark-color);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 200px;
        }
        
        .action-btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
            text-decoration: none;
            border-color: var(--primary-color);
        }
        
        .action-btn i {
            margin-right: 12px;
            font-size: 1.3rem;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 0.9rem;
            border-top: 1px solid #eee;
            margin-top: 30px;
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
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .action-btn {
                min-width: 100%;
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
                <h3>Admin Portal</h3>
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
                <a href="track_buses.php" class="menu-item">
                    <i class="fas fa-satellite-dish"></i>
                    <span>Track Buses</span>
                </a>
                <a href="manage_users.php" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
                <a href="manage_destinations.php" class="menu-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Manage Destinations</span>
                </a>
                <a href="manage_buses.php" class="menu-item">
                    <i class="fas fa-bus"></i>
                    <span>Manage Buses</span>
                </a>
                <a href="manage_payments.php" class="menu-item">
                    <i class="fas fa-credit-card"></i>
                    <span>Manage Payments</span>
                </a>
                <a href="manage_rides.php" class="menu-item">
                    <i class="fas fa-route"></i>
                    <span>Manage Rides</span>
                </a>
                <a href="manage_tickets.php" class="menu-item">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Manage Tickets</span>
                </a>
            </div>
        </div>
        
        <div class="admin-main">
            <div class="admin-header">
                <div class="header-left">
                    <h1>Admin Dashboard</h1>
                    <div class="welcome-text">Welcome, <?php echo $user['first_name']; ?></div>
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
                    <a href="../logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
            
            <div class="dashboard-content">
                <div class="welcome-card">
                    <h2>Welcome, <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>!</h2>
                    <p>You are logged in as an administrator. Manage your bus system efficiently from this dashboard.</p>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card users">
                        <div class="stat-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3><?php echo $totalUsers; ?></h3>
                        <p>Total Users</p>
                    </div>

                    <div class="stat-card students">
                        <div class="stat-icon students">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3><?php echo $totalStudents; ?></h3>
                        <p>Total Students</p>
                    </div>

                    <div class="stat-card drivers">
                        <div class="stat-icon drivers">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h3><?php echo $totalDrivers; ?></h3>
                        <p>Total Drivers</p>
                    </div>
                    
                    <div class="stat-card destinations">
                        <div class="stat-icon destinations">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3><?php echo $totalDestinations; ?></h3>
                        <p>Destinations</p>
                    </div>
                    
                    <div class="stat-card buses">
                        <div class="stat-icon buses">
                            <i class="fas fa-bus"></i>
                        </div>
                        <h3><?php echo $totalBuses; ?></h3>
                        <p>Active Buses</p>
                    </div>

                    <div class="stat-card schedules">
                        <div class="stat-icon schedules">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3><?php echo $totalSchedules; ?></h3>
                        <p>Schedules</p>
                    </div>

                    <div class="stat-card methods">
                        <div class="stat-icon methods">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h3><?php echo $totalPaymentMethods; ?></h3>
                        <p>total payment methods</p>
                    </div>
                    
                    <div class="stat-card rides">
                        <div class="stat-icon rides">
                            <i class="fas fa-route"></i>
                        </div>
                        <h3><?php echo $totalRides; ?></h3>
                        <p>total rides</p>
                    </div>
                </div>

                <div class="content-card">
                    <h3 class="section-header">
                        <i class="fas fa-ticket-alt"></i> Ticket Overview
                    </h3>
                    <div class="ticket-stats" id="ticketStats">
                        <div class="ticket-stat-card total">
                            <div class="stat-number"><?php echo $totalTickets; ?></div>
                            <div class="stat-label"><i class="fas fa-ticket-alt"></i> Total Tickets</div>
                        </div>
                        <div class="ticket-stat-card paid">
                            <div class="stat-number"><?php echo $paidTickets; ?></div>
                            <div class="stat-label"><i class="fas fa-check-circle"></i> Paid</div>
                        </div>
                        <div class="ticket-stat-card pending">
                            <div class="stat-number"><?php echo $pendingTickets; ?></div>
                            <div class="stat-label"><i class="fas fa-clock"></i> Pending</div>
                        </div>
                        <div class="ticket-stat-card revenue">
                            <div class="stat-number">৳<?php echo number_format($totalRevenue, 2); ?></div>
                            <div class="stat-label"><i class="fas fa-coins"></i> Total Revenue</div>
                        </div>
                    </div>
                </div>
                
                <div class="quick-actions">
                    <h3 class="section-title">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h3>
                    
                    <div class="action-buttons">
                        <a href="track_buses.php" class="action-btn">
                            <i class="fas fa-satellite-dish"></i>
                            <div>
                                <strong>Track Active Buses</strong>
                                <small>Live map view</small>
                            </div>
                        </a>
                        <a href="manage_users.php" class="action-btn">
                            <i class="fas fa-user-plus"></i>
                            <div>
                                <strong>Add New User</strong>
                                <small>Create a new user account</small>
                            </div>
                        </a>
                        
                        <a href="manage_destinations.php" class="action-btn">
                            <i class="fas fa-map-marked-alt"></i>
                            <div>
                                <strong>Add Destination</strong>
                                <small>Create a new route destination</small>
                            </div>
                        </a>
                        
                        <a href="manage_buses.php" class="action-btn">
                            <i class="fas fa-bus-alt"></i>
                            <div>
                                <strong>Add New Bus</strong>
                                <small>Register a new bus to the fleet</small>
                            </div>
                        </a>
                        
                        <a href="manage_rides.php" class="action-btn">
                            <i class="fas fa-calendar-plus"></i>
                            <div>
                                <strong>Schedule Ride</strong>
                                <small>Create a new ride schedule</small>
                            </div>
                        </a>
                        
                        <a href="manage_payments.php" class="action-btn">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <div>
                                <strong>View Payments</strong>
                                <small>Check recent transactions</small>
                            </div>
                        </a>
                        
                        <a href="../logout.php" class="action-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <div>
                                <strong>Logout</strong>
                                <small>Exit the admin dashboard</small>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="footer">
                    <p>NSUTMS &copy; <?php echo date('Y'); ?> | Admin Dashboard</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class to current menu item
        $(document).ready(function() {
            // Get current page URL
            var url = window.location.pathname;
            var filename = url.substring(url.lastIndexOf('/') + 1);
            
            // Remove active class from all menu items
            $('.menu-item').removeClass('active');
            
            // Add active class to current menu item
            $('.menu-item').each(function() {
                var href = $(this).attr('href');
                if (href === filename) {
                    $(this).addClass('active');
                }
            });
            
            // Animate stat cards on load
            $('.stat-card').each(function(i) {
                var $card = $(this);
                setTimeout(function() {
                    $card.css('opacity', '0').animate({opacity: 1}, 300);
                }, i * 100);
            });
            
            // Simple animation for welcome card
            $('.welcome-card').hide().fadeIn(800);
        });
    </script>
</body>
</html>