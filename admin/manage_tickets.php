<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header("Location: ../login.php");
include '../db.php';

// Fetch user data for the Header
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Fetch destinations for filter/edit dropdowns
$destinations = $conn->query("SELECT * FROM destinations")->fetch_all(MYSQLI_ASSOC);
// Fetch students for filter
$students = $conn->query("SELECT id, first_name, last_name, student_id FROM users WHERE role = 'student'")->fetch_all(MYSQLI_ASSOC);
$payment_options = $conn->query("SELECT * FROM payment_options")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tickets - Admin Dashboard</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    <style>
        /* --- DASHBOARD STYLES START --- */
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
        
        /* Dashboard Content */
        .dashboard-content {
            padding: 25px;
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

        /* Stats Row */
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

            .ticket-stats {
                grid-template-columns: 1fr 1fr;
            }
        }
        /* --- DASHBOARD STYLES END --- */
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
                <a href="manage_tickets.php" class="menu-item active">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Manage Tickets</span>
                </a>
            </div>
        </div>
        
        <div class="admin-main">
            <div class="admin-header">
                <div class="header-left">
                    <h1>Manage Tickets</h1>
                    <div class="welcome-text">Administration Panel</div>
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
                
                <!-- Ticket Statistics -->
                <div class="ticket-stats" id="ticketStats">
                    <div class="ticket-stat-card total">
                        <div class="stat-number" id="statTotal">0</div>
                        <div class="stat-label"><i class="fas fa-ticket-alt"></i> Total Tickets</div>
                    </div>
                    <div class="ticket-stat-card paid">
                        <div class="stat-number" id="statPaid">0</div>
                        <div class="stat-label"><i class="fas fa-check-circle"></i> Paid</div>
                    </div>
                    <div class="ticket-stat-card pending">
                        <div class="stat-number" id="statPending">0</div>
                        <div class="stat-label"><i class="fas fa-clock"></i> Pending</div>
                    </div>
                    <div class="ticket-stat-card revenue">
                        <div class="stat-number" id="statRevenue">৳0</div>
                        <div class="stat-label"><i class="fas fa-coins"></i> Total Revenue</div>
                    </div>
                </div>

                <!-- Ticket Table -->
                <div class="content-card">
                    <h3 class="section-header"><i class="fas fa-list-alt"></i> All Tickets</h3>
                    <div class="table-responsive">
                        <div id="ticketList"></div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editTicketModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white;">
                                <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Ticket</h5>
                                <button type="button" class="close" id="editTicketCloseX" style="color: white; opacity: 0.8;"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form id="editTicketForm">
                                    <input type="hidden" name="id" id="editTicketId">
                                    <div class="mb-3">
                                        <label class="form-label">Student</label>
                                        <input type="text" id="editStudentName" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Trip Date</label>
                                        <input type="date" name="trip_date" id="editTripDate" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Seats</label>
                                        <input type="number" name="seats" id="editSeats" class="form-control" min="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Payment Method</label>
                                        <select name="payment_method" id="editPaymentMethod" class="form-control" required>
                                            <?php foreach ($payment_options as $po): ?>
                                                <option value="<?php echo htmlspecialchars($po['name']); ?>"><?php echo htmlspecialchars($po['name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Payment Status</label>
                                        <select name="payment_status" id="editPaymentStatus" class="form-control" required>
                                            <option value="pending">Pending</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="editTicketCancel">Cancel</button>
                                <button type="button" class="btn btn-primary" id="saveEditTicket"><i class="fas fa-save"></i> Save Changes</button>
                            </div>
                        </div>
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
    <script src="../assets/js/custom.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function loadTickets() {
            ajaxRequest('../ajax/ticket_actions.php', {action: 'get_all_tickets'}, function(response) {
                try { response = JSON.parse(response); } catch(e) {}

                // Update stats
                var totalTickets = response.length;
                var paidTickets = response.filter(function(t) { return t.payment_status === 'paid'; }).length;
                var pendingTickets = response.filter(function(t) { return t.payment_status === 'pending'; }).length;
                var totalRevenue = 0;
                response.forEach(function(t) {
                    if (t.payment_status === 'paid') {
                        totalRevenue += parseFloat(t.fare || 0) * parseInt(t.seats || 0);
                    }
                });

                $('#statTotal').text(totalTickets);
                $('#statPaid').text(paidTickets);
                $('#statPending').text(pendingTickets);
                $('#statRevenue').text('৳' + totalRevenue.toFixed(2));

                // Build table
                var html = '<table id="ticketsTable" class="table table-hover table-bordered">' +
                    '<thead><tr>' +
                    '<th>ID</th>' +
                    '<th>Student</th>' +
                    '<th>Student ID</th>' +
                    '<th>Destination</th>' +
                    '<th>Time</th>' +
                    '<th>Bus</th>' +
                    '<th>Trip Date</th>' +
                    '<th>Seats</th>' +
                    '<th>Female Only</th>' +
                    '<th>Payment</th>' +
                    '<th>Status</th>' +
                    '<th>Purchased</th>' +
                    '<th>Actions</th>' +
                    '</tr></thead><tbody>';

                response.forEach(function(ticket) {
                    // Payment status badge
                    var statusBadge = '';
                    var pStatus = ticket.payment_status ? ticket.payment_status.toLowerCase() : 'pending';
                    if (pStatus === 'paid' || pStatus === 'completed') {
                        statusBadge = '<span class="badge bg-success" style="color: white !important;">Paid</span>';
                    } else {
                        statusBadge = '<span class="badge bg-warning" style="color: #333 !important;">Pending</span>';
                    }

                    // Female only badge
                    var femaleBadge = '';
                    if (ticket.female_only == 1) {
                        femaleBadge = '<span class="badge" style="background-color: #e91e8e; color: white !important;">Yes</span>';
                    } else {
                        femaleBadge = '<span class="badge" style="background-color: #64b5f6; color: white !important;">No</span>';
                    }

                    // Payment method badge
                    var methodBadge = '';
                    if (!ticket.payment_method || ticket.payment_method.trim() === '') {
                        methodBadge = '<span class="badge bg-secondary" style="color: white !important;">None</span>';
                    } else if (ticket.payment_method.toLowerCase() === 'online') {
                        methodBadge = '<span class="badge bg-primary" style="color: white !important;">Online</span>';
                    } else if (ticket.payment_method.toLowerCase() === 'cash') {
                        methodBadge = '<span class="badge bg-secondary" style="color: white !important;">Cash</span>';
                    } else {
                        methodBadge = '<span class="badge bg-info" style="color: #333 !important;">' + (ticket.payment_method.charAt(0).toUpperCase() + ticket.payment_method.slice(1)) + '</span>';
                    }

                    html += '<tr>' +
                        '<td>' + ticket.id + '</td>' +
                        '<td>' + ticket.student_name + '</td>' +
                        '<td>' + (ticket.student_id_number || '-') + '</td>' +
                        '<td>' + ticket.destination_name + '</td>' +
                        '<td>' + ticket.time + '</td>' +
                        '<td>' + ticket.bus_reg + '</td>' +
                        '<td>' + ticket.trip_date + '</td>' +
                        '<td>' + ticket.seats + '</td>' +
                        '<td>' + femaleBadge + '</td>' +
                        '<td>' + methodBadge + '</td>' +
                        '<td>' + statusBadge + '</td>' +
                        '<td>' + ticket.created_at + '</td>' +
                        '<td>' +
                            '<button class="btn btn-sm btn-warning editTicket me-1" ' +
                                'data-id="' + ticket.id + '" ' +
                                'data-student="' + ticket.student_name + '" ' +
                                'data-trip-date="' + ticket.trip_date + '" ' +
                                'data-seats="' + ticket.seats + '" ' +
                                'data-payment-method="' + ticket.payment_method + '" ' +
                                'data-payment-status="' + ticket.payment_status + '">' +
                                '<i class="fas fa-edit"></i>' +
                            '</button>' +
                            '<button class="btn btn-sm btn-danger deleteTicket" data-id="' + ticket.id + '">' +
                                '<i class="fas fa-trash"></i>' +
                            '</button>' +
                        '</td>' +
                        '</tr>';
                });
                html += '</tbody></table>';

                if ($.fn.DataTable.isDataTable('#ticketsTable')) {
                    $('#ticketsTable').DataTable().destroy();
                }
                $('#ticketList').html(html);
                $('#ticketsTable').DataTable({
                    order: [[0, 'desc']],
                    pageLength: 25
                });
            });
        }

        loadTickets();

        // Force-close modal via raw DOM (bypasses broken Bootstrap modal API)
        function closeEditModal() {
            var modal = document.getElementById('editTicketModal');
            modal.classList.remove('show');
            modal.style.display = 'none';
            modal.setAttribute('aria-hidden', 'true');
            modal.removeAttribute('aria-modal');
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('padding-right');
            // Remove all backdrops
            var backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(function(b) { b.remove(); });
        }

        // Close modal handlers
        $('#editTicketCancel, #editTicketCloseX').click(function() {
            closeEditModal();
        });

        // Edit ticket
        $(document).on('click', '.editTicket', function() {
            $('#editTicketId').val($(this).data('id'));
            $('#editStudentName').val($(this).data('student'));
            $('#editTripDate').val($(this).data('trip-date'));
            $('#editSeats').val($(this).data('seats'));
            $('#editPaymentMethod').val($(this).data('payment-method'));
            $('#editPaymentStatus').val($(this).data('payment-status'));
            // Show modal via raw DOM
            var modal = document.getElementById('editTicketModal');
            modal.style.display = 'block';
            modal.classList.add('show');
            modal.setAttribute('aria-modal', 'true');
            modal.removeAttribute('aria-hidden');
            document.body.classList.add('modal-open');
            // Add backdrop
            var backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            document.body.appendChild(backdrop);
        });

        // Save edit
        $('#saveEditTicket').click(function() {
            var data = $('#editTicketForm').serialize() + '&action=admin_edit_ticket';
            ajaxRequest('../ajax/ticket_actions.php', data, function(response) {
                try { response = JSON.parse(response); } catch(e) {}
                if (response.success) {
                    closeEditModal();
                    loadTickets();
                } else {
                    alert(response.message || 'Failed to update ticket');
                }
            });
        });

        // Delete ticket
        $(document).on('click', '.deleteTicket', function() {
            var ticketId = $(this).data('id');
            if (confirm('Are you sure you want to delete ticket #' + ticketId + '?')) {
                ajaxRequest('../ajax/ticket_actions.php', {action: 'admin_delete_ticket', id: ticketId}, function(response) {
                    try { response = JSON.parse(response); } catch(e) {}
                    if (response.success) {
                        loadTickets();
                    } else {
                        alert(response.message || 'Failed to delete ticket');
                    }
                });
            }
        });
    </script>
</body>
</html>
