<?php
include 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $now = date('Y-m-d H:i:s');

    // Cari user dengan token yang belum expired
    $query = "SELECT * FROM users WHERE token = '$token' AND token_expiry > '$now'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        mysqli_query($conn, "UPDATE users SET status = 'AKTIF', token = NULL, token_expiry = NULL WHERE token = '$token'");
        echo "<h2>Akun Berhasil Diaktifkan!</h2><p>Silakan <a href='login.php'>Login</a></p>";
    } else {
        echo "<h2>Aktivasi Gagal!</h2><p>Token tidak valid atau sudah kadaluwarsa (lebih dari 24 jam).</p>";
    }
}
?>