// Common Javascript for Transport Management System Static Implementation

// Standardize Authentication checks
function requireAuth(role) {
    const userJson = localStorage.getItem('currentUser');
    if (!userJson) {
        window.location.href = role ? '../login.html' : 'login.html';
        return null;
    }
    const user = JSON.parse(userJson);
    if (role && user.role !== role) {
        window.location.href = '../login.html';
        return null;
    }
    return user;
}

function getCurrentUser() {
    const userJson = localStorage.getItem('currentUser');
    return userJson ? JSON.parse(userJson) : null;
}

function logout() {
    localStorage.removeItem('currentUser');
    window.location.href = '../login.html'; // Ensure relative path works or just absolute
}

// Ensure logout links work
$(document).ready(function() {
    $('.logout-btn, a[href*="logout"]').on('click', function(e) {
        e.preventDefault();
        
        let path = window.location.pathname;
        let isRoot = !path.includes('/admin/') && !path.includes('/student/') && !path.includes('/driver/');
        
        localStorage.removeItem('currentUser');
        if (isRoot) {
            window.location.href = 'login.html';
        } else {
            window.location.href = '../login.html';
        }
    });
});
