<div align="center">

# 🚌 NSUTMS
### North South University Transport Management System

A full-stack web application for managing university bus transport — built for students, drivers, and administrators.

[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-MariaDB_10.4-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mariadb.org)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![XAMPP](https://img.shields.io/badge/XAMPP-Local_Server-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)](https://apachefriends.org)

</div>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Database Schema](#-database-schema)
- [User Roles](#-user-roles)
- [Installation & Setup](#-installation--setup)
- [Demo Credentials](#-demo-credentials)
- [Module Breakdown](#-module-breakdown)
- [API / AJAX Endpoints](#-api--ajax-endpoints)
- [Contributing](#-contributing)
- [Team](#-team)

---

## 🌐 Overview

**NSUTMS** (North South University Transport Management System) is a role-based web application designed to digitize and streamline the NSU shuttle bus operations. The system serves three distinct user types — **Students**, **Bus Drivers**, and **Administrators** — each with a dedicated, purpose-built dashboard.

Students can purchase bus tickets online, track live bus locations, and view their ride history. Drivers manage their assigned rides and share real-time GPS coordinates. Administrators have full control over the fleet, routes, users, ticketing, and financial reports.

This project was developed as part of **CSE311L (Database Systems Lab)** at North South University.

---

## ✨ Features

### 🎓 Student Features
- **Ticket Purchase** — Browse available routes, select departure time, choose seat count, and pay online. Past dates and departed times are blocked server-side and client-side.
- **Female-Only Buses** — Students can filter and select designated female-only bus services.
- **My Tickets** — View all purchased tickets with payment status, date, route, and fare breakdown.
- **Live Bus Tracking** — Real-time map view of buses currently on active rides (Leaflet.js + GPS).
- **Route Map** — Interactive map showing all NSU bus routes with start/end coordinates.
- **Profile Management** — Edit personal details and change password securely.

### 🚌 Driver Features
- **Dashboard** — Overview of assigned rides, trip history, and status.
- **Ride Management** — Start, cancel, or end assigned rides with a single click.
- **Live Location Sharing** — Share real-time GPS coordinates to the server during an active ride for student tracking.
- **Interactive Route Map** — View the full route on a Leaflet map before departure.

### 🛡️ Admin Features
- **System Dashboard** — At-a-glance statistics: total users, students, drivers, buses, destinations, schedules, rides, and revenue.
- **Ticket Overview** — Total tickets, paid count, pending count, and total revenue (in BDT ৳).
- **Manage Users** — Create, edit, and delete Students, Drivers, and Administrators. Supports role-based profile fields (e.g., driving license, NID for drivers).
- **Manage Buses** — Register buses with seat capacity and Female-Only flag. Color-coded badges in the table view.
- **Manage Destinations** — Create and edit routes with distance, fare, and precise start/end GPS coordinates via an interactive Leaflet map picker.
- **Manage Schedules** — Add and manage bus time slots per destination.
- **Manage Rides** — View and audit all ride records with status (pending / started / cancelled / ended).
- **Manage Tickets** — Browse all ticket records across all students with full details.
- **Manage Payments** — View and configure payment methods (MFS, Cash, Cards, NexusPay, Online Banking).
- **Live Bus Tracking** — Admin-level map showing all currently active buses and their GPS coordinates.

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 8.2 (procedural + OOP MySQLi) |
| **Database** | MariaDB 10.4 (MySQL-compatible) |
| **Frontend** | HTML5, CSS3, Bootstrap 5, JavaScript (jQuery 3) |
| **Icons** | Font Awesome 6.4 |
| **Maps** | Leaflet.js (OpenStreetMap tiles) |
| **AJAX** | jQuery AJAX + PHP JSON responses |
| **Local Server** | XAMPP (Apache + MariaDB) |
| **Timezone** | Asia/Dhaka (BD Standard Time, UTC+6) |

---

## 📁 Project Structure

```
NSUTMS/
│
├── index.php                  # Public landing page (routes, schedule, info)
├── login.php                  # Unified login page (all roles)
├── signup.php                 # Student self-registration
├── logout.php                 # Session destroy & redirect
├── db.php                     # Database connection (MySQLi)
├── nsutms_db.sql              # Full database dump (schema + seed data)
│
├── admin/                     # Admin portal
│   ├── dashboard.php          # Stats overview & quick actions
│   ├── manage_users.php       # CRUD for all user roles
│   ├── manage_buses.php       # CRUD for buses & female-only flag
│   ├── manage_destinations.php# CRUD for routes with Leaflet map picker
│   ├── manage_tickets.php     # View all tickets system-wide
│   ├── manage_payments.php    # Payment method management
│   ├── manage_rides.php       # Ride history & audit log
│   ├── track_buses.php        # Live GPS tracking map (all buses)
│   └── map.php                # Route overview map
│
├── student/                   # Student portal
│   ├── dashboard.php          # Student home & stats
│   ├── buy_ticket.php         # Ticket purchase workflow
│   ├── my_tickets.php         # Ticket history
│   ├── track_buses.php        # Live bus tracker
│   ├── map.php                # Route map view
│   ├── edit_profile.php       # Profile editor
│   └── change_password.php    # Password change
│
├── driver/                    # Driver portal
│   ├── dashboard.php          # Driver home & ride summary
│   ├── manage_ride.php        # Start/end/cancel rides + live GPS
│   └── map.php                # Route map view
│
├── ajax/                      # AJAX handler scripts (JSON responses)
│   ├── user_actions.php       # Login, register, CRUD users
│   ├── bus_actions.php        # CRUD buses
│   ├── destination_actions.php# CRUD destinations & times
│   ├── ticket_actions.php     # Buy ticket, validate dates/times
│   ├── ride_actions.php       # Start/end/cancel rides, update GPS
│   └── payment_actions.php    # Payment method CRUD
│
└── assets/
    ├── css/
    │   ├── bootstrap.min.css  # Bootstrap 5
    │   └── custom.css         # Global overrides
    └── js/
        ├── jquery.min.js      # jQuery 3
        ├── bootstrap.bundle.min.js
        └── custom.js          # Shared AJAX helper (ajaxRequest)
```

---

## 🗄️ Database Schema

The database (`nsutms_db`) contains **7 tables** with foreign key constraints enforcing referential integrity.

```
┌─────────────────┐       ┌──────────────────┐      ┌──────────────┐
│     users       │       │      buses        │      │ destinations │
│─────────────────│       │──────────────────│      │──────────────│
│ id (PK)         │       │ id (PK)           │      │ id (PK)      │
│ first_name      │       │ reg_number        │      │ name         │
│ last_name       │       │ seats             │      │ distance     │
│ student_id      │       │ is_female_only    │      │ fare         │
│ email (UNIQUE)  │       │ created_at        │      │ start_coords │
│ phone           │       └──────────────────┘      │ end_coords   │
│ gender          │                                  │ start_dest   │
│ password (hash) │                                  │ end_dest     │
│ role            │       ┌──────────────────┐      └──────────────┘
│ driving_license │       │   bus_times      │
│ nid             │       │──────────────────│      ┌──────────────────┐
│ years_exp       │       │ id (PK)           │      │  bus_assignments │
└─────────────────┘       │ destination_id   │←─────│ bus_id (FK)      │
         │                │ time             │      │ destination_id FK│
         │                └──────────────────┘      │ time_id (FK)     │
         │                                          └──────────────────┘
         │          ┌──────────────────┐
         │          │     tickets      │
         └─────────►│──────────────────│
         │          │ id (PK)          │
         │          │ student_id (FK)  │
         │          │ destination_id FK│
         │          │ time_id (FK)     │
         │          │ bus_id (FK)      │
         │          │ seats            │
         │          │ female_only      │
         │          │ payment_method   │
         │          │ payment_status   │
         │          │ trip_date        │
         │          └──────────────────┘
         │
         │          ┌──────────────────┐
         └─────────►│      rides       │
                    │──────────────────│
                    │ id (PK)          │
                    │ driver_id (FK)   │
                    │ bus_id (FK)      │
                    │ destination_id FK│
                    │ time_id (FK)     │
                    │ status           │
                    │ trip_date        │
                    │ last_map_coords  │
                    └──────────────────┘
```

### Table Summary

| Table | Description |
|---|---|
| `users` | Stores all users — students, drivers, and admins — with role-specific fields |
| `buses` | Bus fleet registry with seat capacity and gender-restriction flag |
| `destinations` | Route endpoints with GPS coordinates, distance, and fare |
| `bus_times` | Departure time slots linked to destinations |
| `bus_assignments` | Maps buses to destinations and time slots (many-to-many) |
| `tickets` | Student ticket purchases with payment and trip date |
| `rides` | Ride lifecycle tracking (pending → started → ended/cancelled) with live GPS |
| `payment_options` | Configurable payment methods with default status |

---

## 👥 User Roles

| Role | Description | Access |
|---|---|---|
| **Admin** | Full system administrator | All management portals, statistics, live tracking |
| **Student** | NSU student user | Buy tickets, track buses, view ticket history |
| **Driver** | Bus driver | Manage assigned rides, broadcast live GPS location |

Role-based routing is enforced on every PHP page via `$_SESSION['role']` checks, redirecting unauthorized users back to `login.php`.

---

## ⚙️ Installation & Setup

### Prerequisites

- [XAMPP](https://apachefriends.org) (or any Apache + PHP 8.x + MySQL/MariaDB stack)
- PHP **8.0+**
- MariaDB / MySQL **5.7+**

### Steps

**1. Clone or copy the project**

```bash
git clone https://github.com/your-username/NSUTMS.git
# OR copy the folder manually to your XAMPP htdocs directory
```

Place the project folder inside:
```
C:\xampp\htdocs\NSUTMS\
```

**2. Start XAMPP services**

Open the XAMPP Control Panel and start:
- ✅ **Apache**
- ✅ **MySQL**

**3. Import the database**

1. Open your browser and go to: `http://localhost/phpmyadmin`
2. Click **"New"** in the left sidebar and create a database named `nsutms_db` *(optional — the SQL file handles this automatically)*
3. Click **"Import"** and select the file:
   ```
   C:\xampp\htdocs\NSUTMS\nsutms_db.sql
   ```
4. Click **"Go"** to execute.

**4. Configure the database connection** *(if needed)*

Open `db.php` and update credentials if your MySQL setup differs from defaults:

```php
$servername = "localhost";
$username   = "root";    // Change if needed
$password   = "";        // Change if needed
$dbname     = "nsutms_db";
```

**5. Launch the application**

Open your browser and navigate to:
```
http://localhost/NSUTMS/
```

---

## 🔑 Demo Credentials

The database is pre-seeded with the following test accounts. All passwords are `1234`.

| Role | Email | Password |
|---|---|---|
| 🛡️ **Admin** | `admin@example.com` | `1234` |
| 🎓 **Student** | `arka.karmoker@northsouth.edu` | `1234` |
| 🎓 **Student** | `amrita.biswas@northsouth.edu` | `1234` |
| 🚌 **Driver** | `driver.one@example.com` | `1234` |
| 🚌 **Driver** | `driver.two@example.com` | `1234` |

> 💡 Credentials are also displayed on the Login page for convenience.

---

## 📦 Module Breakdown

### Public Pages

| File | Description |
|---|---|
| `index.php` | Landing page — hero, schedule, routes, how-it-works, FAQ sections |
| `login.php` | Unified login for all roles with demo credential panel |
| `signup.php` | Student self-registration (student_id, gender, contact info) |
| `logout.php` | Clears session and redirects to login |

### Admin Module (`/admin/`)

| File | Description |
|---|---|
| `dashboard.php` | System stats (users, buses, tickets, revenue), quick action buttons |
| `manage_users.php` | Add / edit / delete users across all roles with role-specific fields |
| `manage_buses.php` | Register buses, set seat count, toggle Female-Only status |
| `manage_destinations.php` | CRUD for routes; Leaflet map picker for GPS coordinates; manage time slots |
| `manage_tickets.php` | Read-only view of all student ticket transactions |
| `manage_payments.php` | Add / remove payment methods and set default status |
| `manage_rides.php` | Full ride log with status, driver, bus, date, and coordinates |
| `track_buses.php` | Live Leaflet map showing active buses by last-known GPS coords |
| `map.php` | Static route overview map with all destination markers |

### Student Module (`/student/`)

| File | Description |
|---|---|
| `dashboard.php` | Welcome card, quick stats (tickets, upcoming trips) |
| `buy_ticket.php` | Route/time picker → seat selection → payment method → submit |
| `my_tickets.php` | Personal ticket history with status badges |
| `track_buses.php` | Live bus tracker — shows buses on active rides |
| `map.php` | Explore bus routes on an interactive map |
| `edit_profile.php` | Update name, phone, student ID |
| `change_password.php` | Secure password update with current password verification |

### Driver Module (`/driver/`)

| File | Description |
|---|---|
| `dashboard.php` | Ride summary — upcoming, active, and past rides |
| `manage_ride.php` | View assigned ride details; Start / End / Cancel with GPS broadcast |
| `map.php` | Route map for the driver's assigned destination |

---

## 📡 API / AJAX Endpoints

All endpoints are located in `/ajax/` and return **JSON** responses. They are called via jQuery AJAX using the shared `ajaxRequest()` helper in `custom.js`.

### `user_actions.php`
| Action | Method | Description |
|---|---|---|
| `login` | POST | Authenticate user, set session, return redirect URL |
| `register` | POST | Register a new student account |
| `add_user` | POST | Admin: add any role user |
| `update_user` | POST | Admin: update user fields |
| `delete_user` | POST | Admin: delete a user by ID |
| `get_user` | POST | Fetch a single user's data |

### `bus_actions.php`
| Action | Description |
|---|---|
| `add_bus` | Add a new bus to the fleet |
| `update_bus` | Edit bus details |
| `delete_bus` | Remove a bus |
| `get_bus` | Fetch a single bus record |

### `destination_actions.php`
| Action | Description |
|---|---|
| `add_destination` | Create a new route with coordinates |
| `update_destination` | Edit an existing route |
| `delete_destination` | Remove a route |
| `add_time` | Add a departure time to a destination |
| `update_time` | Edit a time slot |
| `delete_time` | Remove a time slot |

### `ticket_actions.php`
| Action | Description |
|---|---|
| `buy_ticket` | Purchase a ticket — validates date/time, seat availability, and female-only rules server-side |
| `get_schedule` | Fetch available time slots for a destination (filters past times dynamically) |

### `ride_actions.php`
| Action | Description |
|---|---|
| `start_ride` | Mark ride as started, record `started_at` |
| `end_ride` | Mark ride as ended, record `ended_at` |
| `cancel_ride` | Cancel an active ride |
| `update_location` | Broadcast current GPS coordinates from driver |
| `get_active_rides` | Fetch all rides with `status = 'started'` and their last GPS coords |

### `payment_actions.php`
| Action | Description |
|---|---|
| `add_method` | Add a new payment option |
| `delete_method` | Remove a payment option |

---

## 🔒 Security Highlights

- **Password Hashing** — All passwords are stored using PHP `password_hash()` (bcrypt, cost factor 10). Verified with `password_verify()`.
- **Prepared Statements** — All database queries use MySQLi prepared statements to prevent SQL injection.
- **Session-Based Auth** — Role checks on every protected page redirect unauthorized users immediately.
- **Temporal Ticket Validation** — Server enforces `Asia/Dhaka` timezone. Purchases for past dates or already-departed time slots are rejected at the AJAX layer, not just the UI.
- **CORS / Direct Access** — AJAX handlers validate `action` parameters and return structured error JSON rather than exposing raw errors.

---

## 🗺️ Key Business Logic

### Ticket Purchase Flow
1. Student selects a **destination** from the dropdown.
2. Available **departure times** for that destination are fetched via AJAX (past times are filtered out dynamically based on the current BD time).
3. Student selects **seat count**, optionally requests a **female-only** bus, and chooses a **payment method**.
4. Server-side handler in `ticket_actions.php` re-validates:
   - Trip date is not in the past.
   - Departure time has not yet passed for today.
   - A bus is assigned for the selected destination+time.
   - Seat availability is not exceeded.
5. On success, a ticket record is inserted and confirmation is shown.

### Ride Lifecycle
```
[Admin assigns route] → Driver sees ride as "pending"
       ↓
Driver clicks "Start Ride" → status = "started", started_at = NOW()
       ↓
Driver broadcasts GPS every N seconds → last_map_coords updated
       ↓
Students & Admin see bus on live tracking map
       ↓
Driver clicks "End Ride" → status = "ended", ended_at = NOW()
   (OR "Cancel" → status = "cancelled")
```

---

## 🤝 Contributing

This is an academic project. If you're building on top of it:

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "Add: your feature description"`
4. Push to your branch: `git push origin feature/your-feature`
5. Open a Pull Request.

---

## 👨‍💻 Team

**Team 04 — CSE311L, North South University**

1. Arka Karmoker 2112343042
2. Amrita Biswas 2022015642

> 📄 See `NSU_CSE311L_Project_Proposal_Team_04.pdf` and `NSUTMS_ERD.pdf` for the original project proposal and Entity-Relationship Diagram.

---

## 📄 License

This project is developed for academic purposes as part of the NSU CSE311L course. Not licensed for commercial use.
