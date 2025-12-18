<?php
include 'config.php';

if (isset($_POST['request_reset'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Cek apakah email terdaftar
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$email'");
    
    if (mysqli_num_rows($query) > 0) {
        $token = bin2hex(random_bytes(16));
        // Update token di database untuk user tersebut
        mysqli_query($conn, "UPDATE users SET token = '$token' WHERE username = '$email'");
        
        $msg = "Link reset password telah dibuat (Simulasi Email):<br>
                <a href='reset-password.php?token=$token'>KLIK DI SINI UNTUK RESET PASSWORD</a>";
    } else {
        $error = "Email tidak terdaftar dalam sistem.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Lupa Password</title></head>
<body>
    <h2>Lupa Password</h2>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <?php if(isset($msg)) echo "<p style='color:green'>$msg</p>"; ?>
    
    <p>Masukkan email Anda untuk menerima tautan reset password.</p>
    <form method="POST">
        <input type="email" name="email" placeholder="Email Anda" required><br><br>
        <button type="submit" name="request_reset">Kirim Link Reset</button>
    </form>
    <p><a href="login.php">Kembali ke Login</a></p>
</body>
</html>