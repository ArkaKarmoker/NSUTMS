# NSUTMS - North South University Transportation Management System

**NSUTMS** is a web-based transportation management system built to streamline and modernize services at North South University. It provides a centralized platform for students, drivers, and administrators to manage operations efficiently and ensure a safe, reliable campus commute.

---

## 🚀 Core Features

### 🌟 Premium Landing Page
- **Visual Excellence**: Clear and responsive home page with optimized visuals focused on NSU transportation branding.
- **Content Sections**: Organized presentation of campus facilities and transportation resources, including the Mitsubishi Fuso fleet.
- **User State Logic**: Interface elements dynamically rendered based on authentication status.

### 🎒 Student Portal
- **Dashboard**: Quick view of active rides, total spent, and upcoming scheduled buses.
- **Route Tracking**: Real-time mock tracking of buses on interactive maps.
- **Digital Ticketing**: Seamless booking and payment management.

### 🚛 Driver Portal
- **Ride Management**: Start, end, and manage rides with a simple interface.
- **Route Map**: View assigned routes and destinations with interactive markers.
- **Profile Management**: View profile information.

### 🛡️ Admin Portal
- **Fleet Tracking**: Monitor all active buses across the city.
- **User Management**: Unified dashboard to manage students and drivers.
- **Bus Management**: Assign, add, edit, and delete buses.
- **Route Management**: Manage routes with add, edit, and delete functionality.
- **Payment Management**: Configure and maintain payment methods.

---

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3 (Vanilla & Bootstrap 5), JavaScript (ES6+)
- **Libraries**: jQuery, Font Awesome 6.4, Google Fonts (Outfit, Inter)
- **Data Persistence**: `localStorage` (Browser-based mock database)
- **Asset Logic**: `assets/js/db.js` (Centralized static data store)

---

## 💻 Getting Started

### Prerequisites
The project is a static web application and does not require a backend server to run.

### How to Run
1. Clone or download the project repository.
2. Navigate to the root directory.
3. Open `index.html` in your preferred web browser (Chrome, Firefox, Edge, etc.).

---

## 🔑 Demo Credentials

To experience the full functionality of the different portals, you can use the following credentials on the [Login Page](login.html):

| Role | Email Address | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@example.com` | `1234` |
| **Student** | `arka.karmoker@northsouth.edu` | `1234` |
| **Driver** | `driver.one@example.com` | `1234` |

*Note: The system ignores password hash verification in the static preview mode, so any non-empty password will technically work.*

---

## 📁 Directory Structure
```text
transport/
├── admin/          # Admin portal pages
├── assets/         
│   ├── css/        # Stylesheets (Bootstrap & custom.css)
│   ├── img/        # Project images and assets
│   └── js/         # Logic, mock database (db.js), and helper scripts
├── driver/         # Driver portal pages
├── student/        # Student portal pages
├── index.html      # Landing Page
├── login.html      # Centralized Login
└── signup.html     # Registration Page
```

---
*Created for the CSE 311L Database Systems*

Developed by: Team_04 (Arka Karmoker 2112343042, Amrita Biswas 2022015642)  
Section: 5  
Semester: Spring 2026  
