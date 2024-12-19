
<!DOCTYPE html>
<html>
<head>
    <title>Beetravel - Mã xác nhận mật khẩu mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .email-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
        .greeting {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .code {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <img src="assets/logo_slogan.png" alt="Beetravel">
        </div>
        <div class="greeting">
            Xin chào, đây là Gmail gửi mã xác nhận mật khẩu mới của bạn.
        </div>
        <div class="code">
            {{session('password_reset_code')}}
        </div>
    </div>
</body>
</html>