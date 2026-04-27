<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header("Location: ../login.php");
include '../db.php';

// Fetch logged-in user data
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// --- MAP DATA LOGIC ---
$unique_locations = [];

$query = "SELECT start_destination, start_map_coords, end_destination, end_map_coords FROM destinations";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Process Start Coordinate
        if (!empty($row['start_map_coords']) && strpos($row['start_map_coords'], ',') !== false) {
            $coords = trim($row['start_map_coords']);
            // Use coords as key to prevent duplicates
            if (!isset($unique_locations[$coords])) {
                $unique_locations[$coords] = [
                    'name' => $row['start_destination'],
                    'coords' => $coords
                ];
            }
        }

        // Process End Coordinate
        if (!empty($row['end_map_coords']) && strpos($row['end_map_coords'], ',') !== false) {
            $coords = trim($row['end_map_coords']);
            // Use coords as key to prevent duplicates
            if (!isset($unique_locations[$coords])) {
                $unique_locations[$coords] = [
                    'name' => $row['end_destination'],
                    'coords' => $coords
                ];
            }
        }
    }
}

// Re-index array for JSON output
$map_data = array_values($unique_locations);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Map - Transport Management System</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    <style>
        /* --- DASHBOARD STYLING IMPORT --- */
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

        /* --- MAP SPECIFIC STYLES --- */
        .map-container-wrapper {
            padding: 25px;
            /* Adjust height calculation to account for padding */
            height: calc(100vh - var(--header-height));
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        #map {
            flex: 1; /* Take remaining height */
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border: 2px solid white;
        }

        .map-controls {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 4px solid var(--primary-color);
        }

        .legend {
            font-size: 0.95rem;
            color: #555;
        }
        .legend span {
            display: inline-block;
            margin-left: 20px;
        }
        .dot {
            height: 12px;
            width: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        .dot-blue { background-color: #2A81CB; } /* Default Leaflet Color */
        .dot-red { background-color: #FF0000; }

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
                padding: 15px;
                flex-direction: column;
                height: auto;
            }

            .header-left {
                margin-bottom: 10px;
            }

            .map-controls {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            
            .legend span {
                margin: 0 10px;
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
                <a href="dashboard.php" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="map.php" class="menu-item active">
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
                    <h1>Route Map</h1>
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
            
            <div class="map-container-wrapper">
                <div class="map-controls">
                    <div>
                        <strong>Total Unique Stops: </strong> <?php echo count($map_data); ?>
                    </div>
                    <div class="legend">
                        <span><span class="dot dot-blue"></span> Bus Stops</span>
                        <span><span class="dot dot-red"></span> Your Location</span>
                    </div>
                    <button class="btn btn-sm btn-primary" onclick="locateUser()">
                        <i class="fas fa-location-arrow"></i> Find Me
                    </button>
                </div>
                <div id="map"></div>
            </div>
            <div class="footer" style="text-align: center; padding: 20px; color: #777; font-size: 0.9rem; border-top: 1px solid #eee; background-color: transparent;">
                <p>NSUTMS &copy; <?php echo date('Y'); ?> | Admin Dashboard</p>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // 1. Initialize Map (Centered on Dhaka by default)
        var map = L.map('map').setView([23.8103, 90.4125], 11);

        // 2. Add OpenStreetMap Tile Layer
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // 3. Load PHP Data into JS
        var locations = <?php echo json_encode($map_data); ?>;

        // 4. Loop through locations and add markers
        var bounds = []; // To auto-zoom to fit all markers

        locations.forEach(function(loc) {
            // Split coordinate string "lat,lng"
            var coords = loc.coords.split(',');
            
            if(coords.length === 2) {
                var lat = parseFloat(coords[0]);
                var lng = parseFloat(coords[1]);

                // Create Marker
                var marker = L.marker([lat, lng]).addTo(map);

                // Bind Tooltip (Hover)
                marker.bindTooltip(`<b>${loc.name}</b><br>Coords: ${loc.coords}`, {
                    permanent: false, 
                    direction: 'top'
                });

                // Bind Popup (Click)
                marker.bindPopup(`
                    <div style="text-align:center">
                        <i class="fas fa-map-pin" style="color:#4361ee; font-size:20px;"></i><br>
                        <strong>${loc.name}</strong><br>
                        <small class="text-muted">${loc.coords}</small>
                    </div>
                `);

                bounds.push([lat, lng]);
            }
        });

        // Auto-fit map to show all markers
        if (bounds.length > 0) {
            map.fitBounds(bounds);
        }

        // 5. User Geolocation Logic
        var userMarker = null;
        var userIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        function locateUser() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var accuracy = position.coords.accuracy;

                    // Remove existing user marker if any
                    if (userMarker) {
                        map.removeLayer(userMarker);
                    }

                    // Add Red Marker for User
                    userMarker = L.marker([lat, lng], {icon: userIcon}).addTo(map);
                    userMarker.bindPopup("<b>You are here</b>").openPopup();

                    // Circle showing accuracy
                    L.circle([lat, lng], {radius: accuracy, color: 'red', fillOpacity: 0.1}).addTo(map);

                    // Fly to user
                    map.flyTo([lat, lng], 15);

                }, function(error) {
                    alert("Error getting location: " + error.message);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Trigger geolocation on load (optional)
        locateUser();
    </script>
</body>
</html>