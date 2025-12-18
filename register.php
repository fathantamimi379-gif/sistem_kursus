<?php
include 'config.php';

if (isset($_POST['register'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(16));
    // Set masa berlaku 24 jam dari sekarang
    $expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

    // Cek apakah email sudah ada
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $query = "INSERT INTO users (username, password, token, token_expiry) 
                  VALUES ('$email', '$password', '$token', '$expiry')";
        if (mysqli_query($conn, $query)) {
            $msg = "Registrasi Berhasil! Silakan klik link aktivasi di bawah ini (Simulasi Email):<br>
                    <a href='aktivasi.php?token=$token'>AKTIVASI AKUN SAYA</a>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Registrasi Dosen</title></head>
<body>
    <h2>Form Registrasi Dosen</h2>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <?php if(isset($msg)) echo "<p style='color:green'>$msg</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email (Username)" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="register">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>
</html>