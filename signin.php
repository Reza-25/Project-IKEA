<?php
session_start();
require_once __DIR__ . '/include/config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $remeber = isset($_POST['remember']);

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
            if($remeber){
              setcookie('user_id', $user['id'], time() + (86400 * 30), "/"); // 30 days

            }
            header('Location: dashboard/index.php');
            exit;
        } else {
            $error = 'Email atau password salah';
        }
    }
}
$signupSuccess = false;
if (isset($_SESSION['signup_success']) && $_SESSION['signup_success']) {
    $signupSuccess = true;
    unset($_SESSION['signup_success']); // Hapus session setelah ditampilkan
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
    <title>Sign In - RuangKu</title>

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
        height: 100vh;
        overflow: hidden;
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
        padding: 2rem;
      }

      .form-section {
        background-color: #f8f9fa;
        flex-direction: column;
      }

      .form-box {
        width: 100%;
        max-width: 400px;
        padding: 1.5rem;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      }

      .form-box .logo {
        text-align: center;
        margin-bottom: 1rem;
      }

      .form-box .logo img {
        max-width: 100px;
      }

      .form-box h3 {
        text-align: center;
        margin-bottom: 0.5rem;
        font-size: 1.5rem;
        color: #0051ba;
        font-weight: 600;
      }

      .form-box p {
        text-align: center;
        margin-bottom: 1.2rem;
        color: #6c757d;
        font-size: 0.9rem;
      }

      .form-group {
        margin-bottom: 0.8rem;
      }

      .input-icon {
        position: relative;
      }

      .input-icon input {
        width: 100%;
        padding: 0.7rem 2.5rem 0.7rem 2.2rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s;
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
        font-size: 1rem;
      }

      .password-toggle {
        position: absolute;
        top: 50%;
        right: 1.7rem;
        transform: translateY(-50%);
        color: #6c757d;
        cursor: pointer;
        font-size: 1rem;
        transition: color 0.2s;
        z-index: 10;
        padding: 0.2rem;
      }

      .password-toggle:hover {
        color: #0051ba;
      }

      .btn-login {
        width: 100%;
        background: linear-gradient(to right, #0051ba, #0086d6);
        color: white;
        padding: 0.7rem;
        border: none;
        border-radius: 8px;
        text-align: center;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: block;
        box-shadow: 0 4px 15px rgba(0, 81, 186, 0.3);
      }

      .btn-login:hover {
        background: linear-gradient(to right, #0040a0, #0070c0);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 81, 186, 0.4);
      }

      .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0.8rem 0;
        font-size: 0.85rem;
      }

      .remember {
        display: flex;
        align-items: center;
      }

      .remember input {
        margin-right: 0.4rem;
      }

      .forgot-password {
        color: #0051ba;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
        font-size: 0.85rem;
      }

      .forgot-password:hover {
        color: #003d8f;
        text-decoration: underline;
      }

      .divider {
        text-align: center;
        position: relative;
        margin: 0.8rem 0;
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
        color: #6c757d;
        font-size: 0.8rem;
      }

      .form-sociallink {
        margin-top: 0.8rem;
      }

      .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.6rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        margin-bottom: 0.5rem;
        transition: all 0.3s;
        font-weight: 500;
        font-size: 0.85rem;
      }

      .social-btn:hover {
        background-color: #f8f9fa;
        border-color: #d0d0d0;
        transform: translateY(-1px);
      }

      .social-btn img {
        height: 18px;
        margin-right: 0.5rem;
      }

      .text-center {
        text-align: center;
        margin-top: 0.8rem;
        color: #6c757d;
        font-size: 0.85rem;
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
          padding: 1.2rem;
        }
        
        .image-content {
          padding: 20px;
        }
      }

      @media screen and (max-width: 768px) {
        .main-wrapper {
          flex-direction: column;
          height: auto;
          overflow-y: auto;
        }

        .form-section,
        .image-section {
          flex: none;
          width: 100%;
          padding: 1.5rem 1rem;
        }
        
        .image-section {
          padding: 2rem 1rem;
        }
        
        .form-box {
          max-width: 90%;
          margin: 0 auto;
        }
      }

      /* Popup Notification */
      .popup-notification {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #28a745;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            font-weight: 500;
            z-index: 9999;
            transition: top 0.5s ease-in-out;
        }

        .popup-notification.show {
            top: 20px;
        }
    </style>
  </head>
  <body>
  <?php if ($signupSuccess): ?>
        <div class="popup-notification" id="popupNotification">
            Kamu berhasil membuat akun!
        </div>
    <?php endif; ?>
    <div class="main-wrapper">
      <div class="form-section">
        <div class="form-box">
          <div class="logo">
            <img src="assets/img/favicon.png" alt="RuangKu" />
          </div>

          <h3>Welcome Back</h3>
          <p>Sign in to continue your RuangKu experience</p>

          <form action="signin.php" method="POST" id="signin-form">
    <div class="form-group">
        <div class="input-icon">
            <input type="email" name="email" placeholder="Email Address" required />
            <i class="fas fa-envelope"></i>
        </div>
    </div>

    <div class="form-group">
        <div class="input-icon">
            <input type="password" name="password" id="password" placeholder="Password" required />
            <i class="fas fa-lock"></i>
            <span class="password-toggle" id="password-toggle">
                <i class="fas fa-eye"></i>
            </span>
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
              <i class="fab fa-google" style="color: #DB4437; margin-right: 0.5rem;"></i>
              Sign in with Google
            </a>
            <a href="#" class="social-btn">
              <i class="fab fa-facebook-f" style="color: #4267B2; margin-right: 0.5rem;"></i>
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
          <h2>Your RuangKu Journey Continues</h2>
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
    <script>
      // Password visibility toggle
      const passwordToggle = document.getElementById('password-toggle');
      const passwordInput = document.getElementById('password');
      
      passwordToggle.addEventListener('click', function() {
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
      });
      
      // Tampilkan popup selama 3 detik
      document.addEventListener('DOMContentLoaded', function () {
            const popup = document.getElementById('popupNotification');
            if (popup) {
                popup.classList.add('show');
                setTimeout(() => {
                    popup.classList.remove('show');
                }, 3000); // 3 detik
            }
        });
    </script>
  </body>
</html>