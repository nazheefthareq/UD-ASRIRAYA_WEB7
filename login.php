<?php
session_start();

require_once __DIR__ . '/config/database.php';
$conn = connectDB();

// Proses login 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password wajib diisi!";
    } else {
        // Cek user di database
        $sql = $conn->prepare("SELECT * FROM user WHERE username = :username");
        $sql->bindParam(':username', $username);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            // Buat session
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            header('Location: views/admin/dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = "Username atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
                * {
            box-sizing: border-box;
        }
        body {
            height: 100vh;
            background-color: #f2f3fb;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            width: 350px;
            background-color: #10375C;
            padding: 30px;
            border-radius: 10px;
            color: #fff;
            border: 1px solid black; 
        }
        .logo-img {
            display: block;
            margin: 0 auto 20px auto;
            width: 60px;
            height: 60px;
        }
        h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 30px;
        }
        input[type="text"], input[type="password"], .btn {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        input[type="text"], input[type="password"] {
            background-color: #c6d1e0;
        }
        .btn {
            background-color: #F3C623;
            color: black;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }
        .error-msg {
            background: #ffe5e5;
            color: red;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="assets/img/logo.png" alt="Logo" class="logo-img">
        
        <h2>Login</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-msg"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Enter your username..." required>
            <input type="password" name="password" placeholder="Enter your password..." required>
            <button type="submit" class="btn">Continue</button>
        </form>
    </div>
</body>
</html>
