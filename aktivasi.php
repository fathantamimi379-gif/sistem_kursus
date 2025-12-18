<?php
include 'config.php';
$token = $_GET['token'];
$now = date('Y-m-d H:i:s');

$res = mysqli_query($conn, "SELECT * FROM users WHERE token='$token' AND token_expiry > '$now'");
if (mysqli_num_rows($res) > 0) {
    mysqli_query($conn, "UPDATE users SET status='AKTIF', token=NULL, token_expiry=NULL WHERE token='$token'");
    echo "Akun AKTIF! Silakan <a href='login.php'>Login</a>";
} else {
    echo "Token tidak valid atau sudah kedaluwarsa.";
}
?>