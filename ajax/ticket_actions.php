<?php
include '../db.php';
session_start();
$action = $_POST['action'] ?? '';
if ($action == 'buy_ticket') {
    if (!isset($_SESSION['user_id'])) exit(json_encode(['success' => false]));
    $female_only = $_POST['female_only'] ?? 0;
    
    // Validate date and time server-side
    $today = date('Y-m-d');
    if ($_POST['trip_date'] < $today) {
        echo json_encode(['success' => false, 'message' => 'Cannot purchase tickets for past dates']);
        exit();
    }
    if ($_POST['trip_date'] == $today) {
        $stmt_time = $conn->prepare("SELECT time FROM bus_times WHERE id = ?");
        $stmt_time->bind_param("i", $_POST['time_id']);
        $stmt_time->execute();
        $time_res = $stmt_time->get_result()->fetch_assoc();
        if ($time_res && $time_res['time'] <= date('H:i:s')) {
            echo json_encode(['success' => false, 'message' => 'This bus has already departed']);
            exit();
        }
    }

    $stmt = $conn->prepare("SELECT ba.bus_id FROM bus_assignments ba JOIN buses b ON ba.bus_id = b.id WHERE ba.destination_id = ? AND ba.time_id = ? AND b.is_female_only = ?");
    $stmt->bind_param("iii", $_POST['destination_id'], $_POST['time_id'], $female_only);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $bus_id = $row['bus_id'];
    } else {
        echo json_encode(['success' => false, 'message' => 'No bus available for selected options']);
        exit();
    }
    // Check seats availability for that date
    $stmt = $conn->prepare("SELECT SUM(seats) as booked FROM tickets WHERE bus_id = ? AND time_id = ? AND destination_id = ? AND trip_date = ?");
    $stmt->bind_param("iiis", $bus_id, $_POST['time_id'], $_POST['destination_id'], $_POST['trip_date']);
    $stmt->execute();
    $booked = $stmt->get_result()->fetch_assoc()['booked'] ?? 0;
    $stmt = $conn->prepare("SELECT seats FROM buses WHERE id = ?");
    $stmt->bind_param("i", $bus_id);
    $stmt->execute();
    $total_seats = $stmt->get_result()->fetch_assoc()['seats'];
    if ($booked + $_POST['seats'] > $total_seats) {
        echo json_encode(['success' => false, 'message' => 'Not enough seats available']);
        exit();
    }
    // Fetch default_status for the selected payment method
    $pay_stmt = $conn->prepare("SELECT default_status FROM payment_options WHERE name = ?");
    $pay_stmt->bind_param("s", $_POST['payment_method']);
    $pay_stmt->execute();
    $pay_row = $pay_stmt->get_result()->fetch_assoc();
    $payment_status = $pay_row['default_status'] ?? 'pending';

    $stmt = $conn->prepare("INSERT INTO tickets (student_id, destination_id, time_id, bus_id, seats, female_only, payment_method, trip_date, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiiissss", $_SESSION['user_id'], $_POST['destination_id'], $_POST['time_id'], $bus_id, $_POST['seats'], $female_only, $_POST['payment_method'], $_POST['trip_date'], $payment_status);
    if ($stmt->execute()) {
        $ticket_id = $stmt->insert_id;
        echo json_encode(['success' => true, 'ticket_id' => $ticket_id, 'payment_method' => $_POST['payment_method']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ticket purchase failed']);
    }
} elseif ($action == 'check_seats') {
    $female_only = $_POST['female_only'] ?? 0;
    
    // Validate date and time server-side
    $today = date('Y-m-d');
    if ($_POST['trip_date'] < $today) {
        echo json_encode(['success' => false, 'message' => 'Cannot check seats for past dates']);
        exit();
    }
    if ($_POST['trip_date'] == $today) {
        $stmt_time = $conn->prepare("SELECT time FROM bus_times WHERE id = ?");
        $stmt_time->bind_param("i", $_POST['time_id']);
        $stmt_time->execute();
        $time_res = $stmt_time->get_result()->fetch_assoc();
        if ($time_res && $time_res['time'] <= date('H:i:s')) {
            echo json_encode(['success' => false, 'message' => 'This bus has already departed']);
            exit();
        }
    }
    $stmt = $conn->prepare("SELECT ba.bus_id, b.seats as total_seats FROM bus_assignments ba JOIN buses b ON ba.bus_id = b.id WHERE ba.destination_id = ? AND ba.time_id = ? AND b.is_female_only = ?");
    $stmt->bind_param("iii", $_POST['destination_id'], $_POST['time_id'], $female_only);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $bus_id = $row['bus_id'];
        $total_seats = $row['total_seats'];
        $stmt = $conn->prepare("SELECT SUM(seats) as booked FROM tickets WHERE bus_id = ? AND time_id = ? AND destination_id = ? AND trip_date = ?");
        $stmt->bind_param("iiis", $bus_id, $_POST['time_id'], $_POST['destination_id'], $_POST['trip_date']);
        $stmt->execute();
        $booked = $stmt->get_result()->fetch_assoc()['booked'] ?? 0;
        $available = max(0, $total_seats - $booked);
        echo json_encode(['success' => true, 'available_seats' => $available]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No bus available for selected options']);
    }
} elseif ($action == 'get_all_tickets') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') exit(json_encode(['success' => false]));
    $result = $conn->query("
        SELECT t.*, 
               CONCAT(u.first_name, ' ', u.last_name) as student_name,
               u.student_id as student_id_number,
               d.name as destination_name,
               d.fare as fare,
               bt.time as time,
               b.reg_number as bus_reg
        FROM tickets t
        JOIN users u ON t.student_id = u.id
        JOIN destinations d ON t.destination_id = d.id
        JOIN bus_times bt ON t.time_id = bt.id
        JOIN buses b ON t.bus_id = b.id
        ORDER BY t.id DESC
    ");
    $tickets = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($tickets);
} elseif ($action == 'admin_edit_ticket') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') exit(json_encode(['success' => false]));
    $stmt = $conn->prepare("UPDATE tickets SET trip_date = ?, seats = ?, payment_method = ?, payment_status = ? WHERE id = ?");
    $stmt->bind_param("sissi", $_POST['trip_date'], $_POST['seats'], $_POST['payment_method'], $_POST['payment_status'], $_POST['id']);
    echo json_encode(['success' => $stmt->execute()]);
} elseif ($action == 'admin_delete_ticket') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') exit(json_encode(['success' => false]));
    $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
    $stmt->bind_param("i", $_POST['id']);
    echo json_encode(['success' => $stmt->execute()]);
}
?>