<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NSUTMS</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    
    <style>
        /* --- THEME STYLES (MATCHING DASHBOARD) --- */
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4CAF50;
            --danger-color: #f44336;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb; /* Same background as dashboard */
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-card, .creds-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
            width: 100%;
            border-top: 6px solid var(--primary-color);
            height: 100%;
        }

        .creds-card {
            border-top-color: var(--accent-color);
        }

        .creds-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cred-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-left: 4px solid #ddd;
            transition: all 0.3s;
        }

        .cred-item:hover {
            transform: translateX(5px);
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .cred-item.admin { border-left-color: var(--danger-color); }
        .cred-item.student { border-left-color: var(--primary-color); }
        .cred-item.driver { border-left-color: var(--success-color); }

        .cred-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            color: #777;
            margin-bottom: 5px;
        }

        .cred-text {
            font-family: 'Courier New', Courier, monospace;
            font-weight: 600;
            color: var(--dark-color);
            word-break: break-all;
        }

        @media (max-width: 768px) {
            .creds-card { margin-top: 20px; }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .login-header p {
            color: #777;
            font-size: 0.9rem;
        }

        .form-control {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: var(--primary-color);
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 8px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px;
            font-weight: 600;
            width: 100%;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ddd;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container" style="max-width: 900px;">
        <div class="mb-4">
            <a href="index.php" class="text-decoration-none text-muted fw-bold small">
                <i class="fas fa-arrow-left me-2"></i> Back to Home
            </a>
        </div>
        <div class="row g-4 align-items-stretch">
            <!-- Login Card -->
            <div class="col-md-6">
                <div class="login-card">
                    <div class="login-header">
                        <div style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 10px;">
                            <i class="fas fa-bus-alt"></i>
                        </div>
                        <h2>Welcome Back</h2>
                        <p>Login to Transport Management System</p>
                    </div>

                    <form id="loginForm">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" id="login_password" class="form-control" placeholder="Enter your password" required>
                                <span class="input-group-text toggle-password" style="cursor: pointer;" onclick="togglePassword('login_password', this)">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>
                    
                    <div id="loginAlert" class="mt-3"></div>
                    
                    <div class="signup-link">
                        Don't have an account? <a href="signup.php">Signup as Student</a>
                    </div>
                </div>
            </div>

            <!-- Credentials Card -->
            <div class="col-md-6">
                <div class="creds-card">
                    <h4 class="creds-title">
                        <i class="fas fa-key text-accent"></i>
                        Demo Credentials
                    </h4>
                    
                    <div class="cred-item admin">
                        <div class="cred-label text-danger">Administrator Access</div>
                        <div class="small mb-1 d-flex justify-content-between align-items-center">
                            <span>Email: <span class="cred-text">admin@example.com</span></span>
                            <i class="fas fa-copy text-muted" style="cursor: pointer; transition: color 0.2s;" onclick="copyText('admin@example.com', this)" title="Copy"></i>
                        </div>
                        <div class="small d-flex justify-content-between align-items-center">
                            <span>Password: <span class="cred-text">1234</span></span>
                            <i class="fas fa-copy text-muted" style="cursor: pointer; transition: color 0.2s;" onclick="copyText('1234', this)" title="Copy"></i>
                        </div>
                    </div>

                    <div class="cred-item student">
                        <div class="cred-label text-primary">Student Access</div>
                        <div class="small mb-1 d-flex justify-content-between align-items-center">
                            <span>Email: <span class="cred-text">arka.karmoker@northsouth.edu</span></span>
                            <i class="fas fa-copy text-muted" style="cursor: pointer; transition: color 0.2s;" onclick="copyText('arka.karmoker@northsouth.edu', this)" title="Copy"></i>
                        </div>
                        <div class="small d-flex justify-content-between align-items-center">
                            <span>Password: <span class="cred-text">1234</span></span>
                            <i class="fas fa-copy text-muted" style="cursor: pointer; transition: color 0.2s;" onclick="copyText('1234', this)" title="Copy"></i>
                        </div>
                    </div>

                    <div class="cred-item driver">
                        <div class="cred-label text-success">Driver Access</div>
                        <div class="small mb-1 d-flex justify-content-between align-items-center">
                            <span>Email: <span class="cred-text">driver.one@example.com</span></span>
                            <i class="fas fa-copy text-muted" style="cursor: pointer; transition: color 0.2s;" onclick="copyText('driver.one@example.com', this)" title="Copy"></i>
                        </div>
                        <div class="small d-flex justify-content-between align-items-center">
                            <span>Password: <span class="cred-text">1234</span></span>
                            <i class="fas fa-copy text-muted" style="cursor: pointer; transition: color 0.2s;" onclick="copyText('1234', this)" title="Copy"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        function copyText(text, iconElement) {
            navigator.clipboard.writeText(text).then(() => {
                iconElement.classList.remove('fa-copy');
                iconElement.classList.add('fa-check', 'text-success');
                setTimeout(() => {
                    iconElement.classList.remove('fa-check', 'text-success');
                    iconElement.classList.add('fa-copy');
                }, 1500);
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }

        function togglePassword(inputId, iconSpan) {
            var input = document.getElementById(inputId);
            var icon = iconSpan.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        $('#loginForm').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize() + '&action=login';
            ajaxRequest('ajax/user_actions.php', data, function(response) {
                response = JSON.parse(response);
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    $('#loginAlert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-circle"></i> ' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
            });
        });
    </script>
</body>
</html>