<?php
    require_once __DIR__ . '/config/database.php';
    $conn = connectDB();

    $status='';
    if(isset($_POST["register"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = $conn->prepare("INSERT INTO user (username,password) VALUES (:nama,:password)");
        $sql->bindParam(':nama',$username);
        $sql->bindParam(':password',$hashedPassword);

        if($sql->execute()){
        $status= "kamu berhasil register";
        }else{
        $status= "Error silakan coba lagi";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section class="auth">
        <div class="container">
            <h2>Register</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <span style="color:red"><?php echo $status;?></span>
                <button type="submit" name="register"> Register </button>
            </form>
            <p>Sudah memliki akun? <a href="login.php">Login</a></p>
        </div>
    </section>
</body>
</html>