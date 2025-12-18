<?php
include 'config.php';
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(16)); // Generate token unik
    $expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email sudah terdaftar!";
    } else {
        $sql = "INSERT INTO users (username, password, token, token_expiry) VALUES ('$email', '$pass', '$token', '$expiry')";
        if (mysqli_query($conn, $sql)) {
            // Simulasi pengiriman email
            echo "Registrasi Berhasil! Klik link ini untuk aktivasi (berlaku 24 jam): 
                  <a href='aktivasi.php?token=$token'>Aktivasi Akun</a>";
        }
    }
}
?>
<form method="POST">
    <input type="email" name="email" placeholder="Email (Username)" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Daftar sebagai Dosen</button>
</form>