<?php
session_start();
require_once __DIR__ . '/include/config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = 'Email dan password wajib diisi';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_full_name'] = $user['full_name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_profile_picture'] = $user['profile_picture'];
            $_SESSION['show_login_notification'] = true;
            header('Location: dashboard/index.php');
            exit;
        } else {
            $error = 'Email atau password salah';
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
    <title>Sign In - IKEA</title>

    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.jpg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body,
      html {
        height: 100%;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
      }

      .main-wrapper {
        display: flex;
        width: 100vw;
        height: 100vh;
      }

      .form-section,
      .image-section {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
      }

      .form-section {
        background-color: #f8f9fa;
        flex-direction: column;
      }

      .form-box {
        width: 100%;
        max-width: 500px;
        padding: 40px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      }

      .form-box .logo {
        text-align: center;
        margin-bottom: 30px;
      }

      .form-box .logo img {
        max-width: 140px;
      }

      .form-box h3 {
        text-align: center;
        margin-bottom: 10px;
        font-size: 28px;
        color: #0051ba;
      }

      .form-box p {
        text-align: center;
        margin-bottom: 30px;
        color: #6c757d;
        font-size: 16px;
      }

      .form-group {
        margin-bottom: 25px;
      }

      .input-icon {
        position: relative;
      }

      .input-icon input {
        width: 100%;
        padding: 14px 20px 14px 45px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s;
      }

      .input-icon input:focus {
        border-color: #0051ba;
        box-shadow: 0 0 0 3px rgba(0, 81, 186, 0.15);
        outline: none;
      }

      .input-icon i {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 18px;
      }

      .btn-login {
        width: 100%;
        background: #0051ba;
        color: white;
        padding: 14px;
        border: none;
        border-radius: 8px;
        text-align: center;
        font-size: 17px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
        display: block;
      }

      .btn-login:hover {
        background: #003d8f;
      }

      .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0 30px;
      }

      .remember {
        display: flex;
        align-items: center;
      }

      .remember input {
        margin-right: 8px;
      }

      .forgot-password {
        color: #0051ba;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
      }

      .forgot-password:hover {
        color: #003d8f;
        text-decoration: underline;
      }

      .divider {
        text-align: center;
        position: relative;
        margin: 30px 0;
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
        padding: 0 15px;
        background: white;
        z-index: 2;
        color: #6c757d;
        font-size: 14px;
      }

      .form-sociallink {
        margin-top: 25px;
      }

      .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        margin-bottom: 12px;
        transition: all 0.3s;
        font-weight: 500;
      }

      .social-btn:hover {
        background-color: #f8f9fa;
        border-color: #d0d0d0;
      }

      .social-btn img {
        height: 22px;
        margin-right: 12px;
      }

      .text-center {
        text-align: center;
        margin-top: 30px;
        color: #6c757d;
      }

      .text-center a {
        color: #0051ba;
        text-decoration: none;
        font-weight: 500;
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
      }

      .image-content {
        max-width: 600px;
        padding: 30px;
      }

      .image-content h2 {
        font-size: 36px;
        margin-bottom: 20px;
        font-weight: 700;
      }

      .image-content p {
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 30px;
      }

      .features {
        text-align: left;
        margin-top: 40px;
      }

      .feature-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
      }

      .feature-icon {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        flex-shrink: 0;
      }

      .feature-icon i {
        font-size: 22px;
        color: white;
      }

      .feature-text h4 {
        margin-bottom: 5px;
        font-size: 18px;
      }

      .feature-text p {
        font-size: 16px;
        margin-bottom: 0;
        opacity: 0.9;
      }

      @media screen and (max-width: 992px) {
        .form-box {
          padding: 30px;
        }
        
        .image-content {
          padding: 20px;
        }
      }

      @media screen and (max-width: 768px) {
        .main-wrapper {
          flex-direction: column;
          height: auto;
        }

        .form-section,
        .image-section {
          flex: none;
          width: 100%;
          padding: 30px 20px;
        }
        
        .image-section {
          padding: 50px 20px;
        }
      }
    </style>
  </head>
  <body>
    <div class="main-wrapper">
      <div class="form-section">
        <div class="form-box">
          <div class="logo">
            <img src="assets/img/logo1.png" alt="IKEA Logo" style="width: 120px;" />
          </div>

          <h3>Welcome Back</h3>
          <p>Sign in to continue your IKEA experience</p>

          <form action="signin.php" method="POST" id="signin-form">
    <div class="form-group">
        <div class="input-icon">
            <input type="email" name="email" placeholder="Email Address" required />
            <i class="fas fa-envelope"></i>
        </div>
    </div>

    <div class="form-group">
        <div class="input-icon">
            <input type="password" name="password" placeholder="Password" required />
            <i class="fas fa-lock"></i>
        </div>
    </div>
          
          <div class="form-options">
            <div class="remember">
              <input type="checkbox" id="remember">
              <label for="remember">Remember me</label>
            </div>
            <a href="#" class="forgot-password">Forgot Password?</a>
          </div>

          <div class="form-group">
            <button type="submit" class="btn-login">Sign In</button>
          </div>
          
          <div class="divider">
            <span>Or continue with</span>
          </div>

          <div class="form-sociallink">
            <a href="#" class="social-btn">
              <img src="assets/img/icons/google.png" alt="Google" />
              Sign in with Google
            </a>
            <a href="#" class="social-btn">
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1024px-Facebook_Logo_%282019%29.png" alt="Facebook" />
              Sign in with Facebook
            </a>
          </div>

          <div class="text-center">
            Don't have an account? <a href="signup.php">Sign Up</a>
          </div>
        </div>
      </div>

      <div class="image-section">
        <div class="image-content">
          <h2>Your IKEA Journey Continues</h2>
          <p>Sign in to access your personalized home solutions, saved designs, and exclusive member benefits.</p>
          
          <div class="features">
            <div class="feature-item">
              <div class="feature-icon">
                <i class="fas fa-heart"></i>
              </div>
              <div class="feature-text">
                <h4>Save Your Favorites</h4>
                <p>Keep track of items you love across all devices</p>
              </div>
            </div>
            
            <div class="feature-item">
              <div class="feature-icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <div class="feature-text">
                <h4>Faster Checkout</h4>
                <p>Save your details for quicker purchases</p>
              </div>
            </div>
            
            <div class="feature-item">
              <div class="feature-icon">
                <i class="fas fa-gift"></i>
              </div>
              <div class="feature-text">
                <h4>Exclusive Offers</h4>
                <p>Get access to special member-only promotions</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>