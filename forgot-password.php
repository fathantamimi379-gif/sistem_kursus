<?php
include 'config.php';
if (isset($_POST['reset_request'])) {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16));
    
    // Cek apakah email terdaftar
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$email'");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE users SET token='$token' WHERE username='$email'");
        echo "Link reset password telah dikirim ke email: 
              <a href='reset-password.php?token=$token'>Reset Password Sekarang</a>";
    } else {
        echo "Email tidak ditemukan.";
    }
}
?>
<form method="POST">
    <h3>Lupa Password</h3>
    <input type="email" name="email" placeholder="Masukkan Email Anda" required>
    <button type="submit" name="reset_request">Kirim Link Reset</button>
</form>