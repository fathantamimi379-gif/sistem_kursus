<?php
include 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Cek apakah token valid
    $query = mysqli_query($conn, "SELECT * FROM users WHERE token = '$token'");
    $user = mysqli_fetch_assoc($query);

    if (!$user) {
        die("Token tidak valid atau sudah digunakan.");
    }

    if (isset($_POST['update_password'])) {
        $new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Update password dan hapus token agar tidak bisa dipakai lagi
        mysqli_query($conn, "UPDATE users SET password = '$new_pass', token = NULL WHERE token = '$token'");
        
        echo "<h2>Password Berhasil Diperbarui!</h2><p>Silakan <a href='login.php'>Login</a> dengan password baru.</p>";
        exit();
    }
} else {
    header("Location: forgot-password.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Reset Password Baru</title></head>
<body>
    <h2>Buat Password Baru</h2>
    <form method="POST">
        <input type="password" name="password" placeholder="Masukkan Password Baru" required><br><br>
        <button type="submit" name="update_password">Simpan Password</button>
    </form>
</body>
</html>