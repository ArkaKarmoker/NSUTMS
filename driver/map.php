<?php
session_start();
// SECURITY: Check if user is logged in AND is a driver
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'driver') header("Location: ../login.php");
include '../db.php';

// Fetch logged-in user data
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// --- MAP DATA LOGIC (Fetch Stops) ---
$unique_locations = [];

$query = "SELECT start_destination, start_map_coords, end_destination, end_map_coords FROM destinations";
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Process Start Coordinate
        if (!empty($row['start_map_coords']) && strpos($row['start_map_coords'], ',') !== false) {
            $coords = trim($row['start_map_coords']);
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
    <title>Route Map - Driver Portal</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    <style>
        /* --- DASHBOARD STYLES (MATCHING DRIVER THEME) --- */
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
            cursor: pointer;
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

        /* --- MAP SPECIFIC STYLES --- */
        .map-wrapper {
            padding: 25px;
            height: calc(100vh - var(--header-height));
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .map-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            flex: 1;
            display: flex;
            flex-direction: column;
            border-top: 4px solid var(--primary-color);
        }

        #map {
            flex: 1;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
            z-index: 1;
        }

        .map-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .legend {
            font-size: 0.9rem;
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            border: 1px solid #eee;
        }
        .legend span {
            display: inline-flex;
            align-items: center;
            margin-left: 15px;
        }
        .legend span:first-child { margin-left: 0; }
        
        .dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }
        .dot-blue { background-color: #2A81CB; }
        .dot-red { background-color: #FF0000; }

        /* Profile Modal Styles */
        .profile-label { font-weight: 600; color: #666; margin-bottom: 5px; }
        .profile-value { font-size: 1.1rem; color: #333; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eee; }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .admin-sidebar { width: 70px; overflow: hidden; }
            .admin-sidebar:hover { width: var(--sidebar-width); }
            .sidebar-header h3, .sidebar-header p, .menu-item span { display: none; }
            .admin-sidebar:hover .sidebar-header h3, .admin-sidebar:hover .sidebar-header p, .admin-sidebar:hover .menu-item span { display: block; }
            .admin-main { margin-left: 70px; }
        }
        @media (max-width: 768px) {
            .admin-sidebar { display: none; }
            .admin-main { margin-left: 0; }
            .admin-header { padding: 15px; flex-direction: column; height: auto; }
            .header-left { margin-bottom: 15px; text-align: center; }
            .map-controls { flex-direction: column; text-align: center; }
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
                <a href="dashboard.php" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="map.php" class="menu-item active">
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
                    <h1>Route Map</h1>
                    <div class="text-muted small">View all bus stops and check your location</div>
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
            
            <div class="map-wrapper">
                <div class="map-card">
                    <div class="map-controls">
                        <div>
                            <strong><i class="fas fa-info-circle text-primary"></i> Designated Stops: </strong> <?php echo count($map_data); ?>
                        </div>
                        <div class="legend">
                            <span><span class="dot dot-blue"></span> Bus Stop</span>
                            <span><span class="dot dot-red"></span> Your GPS Location</span>
                        </div>
                        <button class="btn btn-sm btn-primary" onclick="locateUser()">
                            <i class="fas fa-location-arrow"></i> Find Me
                        </button>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
            <div class="footer" style="text-align: center; padding: 20px; color: #777; font-size: 0.9rem; border-top: 1px solid #eee; background-color: transparent;">
                <p>NSUTMS &copy; <?php echo date('Y'); ?> | Driver Portal</p>
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // 1. Initialize Map
        var map = L.map('map').setView([23.8103, 90.4125], 11);

        // 2. Add OpenStreetMap Tile Layer
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // 3. Load PHP Data into JS
        var locations = <?php echo json_encode($map_data); ?>;
        var bounds = [];

        // 4. Loop through locations and add markers
        locations.forEach(function(loc) {
            var coords = loc.coords.split(',');
            if(coords.length === 2) {
                var lat = parseFloat(coords[0]);
                var lng = parseFloat(coords[1]);

                var marker = L.marker([lat, lng]).addTo(map);
                
                // Popup for Driver
                marker.bindPopup(`
                    <div style="text-align:center">
                        <i class="fas fa-bus-alt" style="color:#4361ee; font-size:18px;"></i><br>
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

                    if (userMarker) map.removeLayer(userMarker);

                    userMarker = L.marker([lat, lng], {icon: userIcon}).addTo(map);
                    userMarker.bindPopup("<b>You are here</b>").openPopup();
                    
                    L.circle([lat, lng], {radius: accuracy, color: 'red', fillOpacity: 0.1}).addTo(map);
                    map.flyTo([lat, lng], 15);

                }, function(error) {
                    alert("Error getting location: " + error.message);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
</body>
</html>