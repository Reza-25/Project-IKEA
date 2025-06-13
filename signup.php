<?php

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
    <title>Sign Up</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body,
      html {
        height: 100%;
        font-family: Arial, sans-serif;
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
        max-width: 800px;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      }

      .form-box .logo {
        text-align: center;
        margin-bottom: 20px;
      }

      .form-box .logo img {
        max-width: 120px;
      }

      .form-box h3 {
        text-align: center;
        margin-bottom: 10px;
      }

      .form-box p {
        text-align: center;
        margin-bottom: 30px;
        color: #555;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .input-icon {
        position: relative;
      }

      .input-icon input {
        width: 100%;
        padding: 10px 35px 10px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
      }

      .input-icon i {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        color: #888;
      }

      .btn-login {
        width: 100%;
        background: #007bff;
        color: white;
        padding: 10px;
        border-radius: 6px;
        text-align: center;
        display: inline-block;
        text-decoration: none;
      }

      .btn-login:hover {
        background: #0056b3;
      }

      .text-center {
        text-align: center;
        margin-top: 20px;
      }

      .form-sociallink {
        margin-top: 20px;
      }

      .form-sociallink a {
        display: block;
        margin: 8px 0;
        text-decoration: none;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        color: #333;
        text-align: center;
      }

      .form-sociallink img {
        height: 20px;
        margin-right: 8px;
        vertical-align: middle;
      }

      .image-section {
        background: url("assets/img/login.png") center center / cover no-repeat;
      }

      @media screen and (max-width: 768px) {
        .main-wrapper {
          flex-direction: column;
        }

        .form-section,
        .image-section {
          flex: none;
          width: 100%;
          height: 50%;
        }
      }
    </style>
  </head>
  <body>
    <div class="main-wrapper">
      <div class="form-section">
        <div class="form-box">
          <div class="logo">
            <img src="assets/img/logo1.png" alt="Logo" />
          </div>

          <h3>Create an Account</h3>
          <p>Continue where you left off</p>

          <div class="form-group">
            <div class="input-icon">
              <input type="text" placeholder="Full Name" />
              <i class="fas fa-user"></i>
            </div>
          </div>

          <div class="form-group">
            <div class="input-icon">
              <input type="email" placeholder="Email Address" />
              <i class="fas fa-envelope"></i>
            </div>
          </div>

          <div class="form-group">
            <div class="input-icon">
              <input type="password" placeholder="Password" />
              <i class="fas fa-lock"></i>
            </div>
          </div>

          <div class="form-group">
            <a href="#" class="btn-login">Sign Up</a>
          </div>

          <div class="text-center">
            Already a user? <a href="signin.html">Sign In</a>
          </div>

          <div class="form-sociallink">
            <a href="#"><img src="assets/img/icons/google.png" alt="Google" /> Sign up with Google</a>
            <a href="#"><img src="assets/img/icons/facebook.png" alt="Facebook" /> Sign up with Facebook</a>
          </div>
        </div>
      </div>

      <div class="image-section"></div>
    </div>
  </body>
</html>
