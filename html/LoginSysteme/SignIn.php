<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Animated Stars Background</title>
    <link rel="stylesheet" href="../../css/backgroundAnimated.css">

    <style>
        body {
            background-image: url('../../assets/backgroundLogin.png');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: rgba(74, 74, 74, 0.2);
            /* Semi-transparent background */
            backdrop-filter: blur(10px);
            /* Creates the frosted glass effect */
            -webkit-backdrop-filter: blur(10px);
            /* For Safari */
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(85, 85, 85, 0.3);
            /* Semi-transparent border */
            z-index: 9999;
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            filter: blur(8px);
            z-index: -1;
            margin: -20px;
            /* Expands the blur area */
        }

        .logo-section {
            text-align: center;
            width: 70%;
        }

        .logo-ornament {
            color: #d4af37;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .logo-title {
            color: #fff;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 5px;
        }

        .logo-subtitle {
            color: #d4af37;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .login-title {
            color: #d4af37;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #3a3a3a;
            border: 1px solid #555;
            border-radius: 8px;
            color: #fff;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #4a4a4a;
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            color: #fff;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .login-btn {
            background: linear-gradient(145deg, #d4af37, #b8941f);
            border: none;
            border-radius: 8px;
            color: #000;
            font-weight: bold;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .login-btn:hover {
            background: linear-gradient(145deg, #b8941f, #d4af37);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .lock-icon {
            margin-right: 8px;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body class="cosmic-starfield-wrapper" id="cosmicWrapper">

    <div class="container d-flex justify-content-center align-items-center">
        <div class="login-container ">
            <!-- Logo Section -->
            <div class="d-flex flex-column align-items-center">
                <img src="../../assets/logo.png" alt="logo" class="img-fluid logo-section">
            </div>

            <!-- Login Title -->
            <h2 class="login-title">LOGIN</h2>

            <!-- Login Form -->
            <form id="loginForm">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" class="login-btn">
                    <i class="fas fa-lock lock-icon"></i>LOGIN
                </button>
            </form>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="../../js/backgroundAnimation.js"></script>
<script src="../../js/signin.js"></script>

</html>