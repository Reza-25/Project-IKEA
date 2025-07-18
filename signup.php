<?php
session_start();
require_once __DIR__ . '/include/config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    //$confirm_password = trim($_POST['confirm_password']); // Added confirm password

    // Validasi
    if (empty($full_name)) {
        $error = 'Nama lengkap wajib diisi';
    } elseif (empty($email)) {
        $error = 'Email wajib diisi';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid';
    } elseif (empty($password)) {
        $error = 'Password wajib diisi';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter';
    } else {
        // Cek email sudah terdaftar
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $error = 'Email sudah terdaftar';
        } else {
            // Upload gambar profil
            $profile_picture = 'default.jpg';
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $target_dir = __DIR__ . '/assets/img/profiles/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }
                    $file_ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
                    $filename = uniqid() . '.' . $file_ext;
                    $target_file = $target_dir . $filename;
                    
                    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                        $profile_picture = $filename;
                    } else {
                        $error = 'Terjadi kesalahan saat mengupload gambar profil';
                    }
                }
            }

            // Jika tidak ada error, simpan ke database
            if (empty($error)) {
                // Hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Simpan ke database
                try {
                    $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, profile_picture, created_at) VALUES (?, ?, ?, ?, NOW())");
                    if ($stmt->execute([$full_name, $email, $hashed_password, $profile_picture])) {
                        $_SESSION['signup_success'] = true;
                        header('Location: signin.php');
                        exit;
                    } else {
                        $error = 'Terjadi kesalahan. Silakan coba lagi.';
                    }
                } catch (Exception $e) {
                    $error = 'Terjadi kesalahan: ' . $e->getMessage();
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Sign Up - IKEA</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100vh;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
        }

        .main-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        .form-section, .image-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .form-section {
            background-color: #fff;
            flex-direction: column;
        }

        .form-box {
            width: 100%;
            max-width: 350px;
            padding: 1.2rem;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 0.8rem;
        }

        .logo img {
            max-width: 90px;
        }

        h3 {
            text-align: center;
            margin-bottom: 0.2rem;
            font-size: 1.4rem;
            color: #0051ba;
            font-weight: 700;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 1rem;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 8px;
            padding: 0.4rem 0.6rem;
            margin-bottom: 0.6rem;
            font-size: 0.8rem;
        }

        .form-group {
            margin-bottom: 0.7rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.25rem;
            font-weight: 500;
            color: #495057;
            font-size: 0.8rem;
        }

        .input-icon {
            position: relative;
        }

        .input-icon input {
            width: 100%;
            padding: 0.6rem 0.7rem 0.6rem 2.2rem;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .input-icon input.password-field {
            padding-right: 3.5rem;
        }

        .input-icon input:focus {
            border-color: #0051ba;
            box-shadow: 0 0 0 2px rgba(0, 81, 186, 0.15);
            outline: none;
        }

        .input-icon i {
            position: absolute;
            top: 50%;
            left: 0.7rem;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 0.9rem;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 1.7rem;
            transform: translateY(-50%);
            color: #6c757d;
            cursor: pointer;
            font-size: 0.9rem;
            z-index: 10;
            padding: 0.2rem;
        }

        .password-toggle:hover {
            color: #0051ba;
        }

        .form-control {
            width: 100%;
            padding: 0.6rem 0.7rem;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #0051ba;
            box-shadow: 0 0 0 2px rgba(0, 81, 186, 0.15);
            outline: none;
        }

        .btn-signup {
            width: 100%;
            background: #0051ba;
            background: linear-gradient(to right, #0051ba, #0086d6);
            color: white;
            padding: 0.6rem;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 81, 186, 0.3);
        }

        .btn-signup:hover {
            background: linear-gradient(to right, #0040a0, #0070c0);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 81, 186, 0.4);
        }

        .divider {
            text-align: center;
            position: relative;
            margin: 0.6rem 0;
            color: #6c757d;
        }

        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
            z-index: 1;
        }

        .divider span {
            position: relative;
            padding: 0 0.8rem;
            background: white;
            z-index: 2;
            font-size: 0.8rem;
        }

        .social-login {
            display: flex;
            gap: 0.6rem;
            margin-top: 0.6rem;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 0.8rem;
        }

        .social-btn:hover {
            background-color: #f8f9fa;
            border-color: #d0d0d0;
            transform: translateY(-1px);
        }

        .social-btn i {
            margin-right: 0.3rem;
            font-size: 0.9rem;
        }

        .google-btn {
            color: #DB4437;
        }

        .facebook-btn {
            color: #4267B2;
        }

        .text-center {
            text-align: center;
            margin-top: 0.6rem;
            color: #6c757d;
            font-size: 0.8rem;
        }

        .text-center a {
            color: #0051ba;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .text-center a:hover {
            color: #003d8f;
            text-decoration: underline;
        }

        .image-section {
            background: linear-gradient(rgba(0, 81, 186, 0.85), rgba(0, 81, 186, 0.85)), 
                       url('https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') center center / cover no-repeat;
            color: white;
            flex-direction: column;
            text-align: center;
            display: none;
        }

        .image-content {
            max-width: 600px;
            padding: 1.5rem;
        }

        .image-content h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .image-content p {
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
        }

        .features {
            text-align: left;
            margin-top: 1.5rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .feature-icon {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .feature-icon i {
            font-size: 1.3rem;
            color: white;
        }

        .feature-text h4 {
            margin-bottom: 0.2rem;
            font-size: 1.1rem;
        }

        .feature-text p {
            font-size: 0.9rem;
            margin-bottom: 0;
            opacity: 0.9;
        }

        @media (min-width: 768px) {
            .image-section {
                display: flex;
            }
        }
        
        @media (max-width: 767px) {
            .main-wrapper {
                flex-direction: column;
            }
            
            .image-section {
                display: none;
            }
            
            .form-box {
                max-width: 100%;
                margin: 0.5rem;
                padding: 1rem;
            }
            
            .form-group {
                margin-bottom: 0.8rem;
            }
            
            .text-center {
                margin-top: 0.8rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
    <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
        <div class="form-section">
            <div class="form-box">
                <div class="logo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/52/IKEA_logo.svg/240px-IKEA_logo.svg.png" alt="IKEA Logo" />
                </div>

                <h3>Create an Account</h3>
                <p class="subtitle">Join our community to get started</p>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="signup.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="text" name="full_name" placeholder="Full Name" required value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>" />
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-icon">
                            <input type="email" name="email" placeholder="Email Address" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="password" name="password" id="password" class="password-field" placeholder="Password" required />
                            <i class="fas fa-lock"></i>
                            <span class="password-toggle" id="password-toggle">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="password" name="confirm_password" id="confirm_password" class="password-field" placeholder="Confirm Password" required />
                            <i class="fas fa-lock"></i>
                            <span class="password-toggle" id="confirm-password-toggle">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="profile_picture" class="form-label">Profile Picture (Optional)</label>
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-signup">Sign Up</button>
                    </div>
                </form>
                
                <div class="divider">
                    <span>or sign up with</span>
                </div>
                
                <div class="social-login">
                    <a href="#" class="social-btn google-btn">
                        <i class="fab fa-google"></i> Google
                    </a>
                    <a href="#" class="social-btn facebook-btn">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                </div>
                
                <div class="text-center">
                    Already have an account? <a href="signin.php">Sign In</a>
                </div>
            </div>
        </div>
        
        <div class="image-section">
            <div class="image-content">
                <h2>Welcome to IKEA Family</h2>
                <p>Create an account to unlock exclusive benefits and personalized experiences</p>
                
                <div class="features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-percent"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Exclusive Discounts</h4>
                            <p>Special offers and discounts just for members</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Free Delivery</h4>
                            <p>Enjoy free shipping on eligible orders</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Save Your Favorites</h4>
                            <p>Create wishlists and save your favorite products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Password visibility toggle
        const passwordToggle = document.getElementById('password-toggle');
        const passwordInput = document.getElementById('password');
        
        const confirmPasswordToggle = document.getElementById('confirm-password-toggle');
        const confirmPasswordInput = document.getElementById('confirm_password');
        
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
        
        confirmPasswordToggle.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Konfirmasi password tidak sesuai');
                confirmPasswordInput.focus();
            }
        });
    </script>
</body>
</html>