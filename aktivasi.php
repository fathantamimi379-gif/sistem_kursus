<?php
include 'config.php';
header_web("Aktivasi Akun - Sistem Kursus");

$status_aktivasi = ""; // Variabel untuk menentukan tampilan

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $now = date('Y-m-d H:i:s');

    // Cari user dengan token yang belum expired
    $query = "SELECT * FROM users WHERE token = '$token' AND token_expiry > '$now'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        mysqli_query($conn, "UPDATE users SET status = 'AKTIF', token = NULL, token_expiry = NULL WHERE token = '$token'");
        $status_aktivasi = "sukses";
    } else {
        $status_aktivasi = "gagal";
    }
} else {
    header("Location: login.php");
    exit();
}
?>

<style>
    body {
        background: #f0f2f5;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .activation-card {
        max-width: 450px;
        width: 100%;
        border: none;
        border-radius: 20px;
        text-align: center;
        padding: 40px 30px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }
    .icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        margin: 0 auto 20px;
    }
    .bg-success-light { background-color: #d1e7dd; color: #0f5132; }
    .bg-danger-light { background-color: #f8d7da; color: #842029; }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="card activation-card bg-white">
                
                <?php if ($status_aktivasi == "sukses"): ?>
                    <div class="icon-circle bg-success-light">
                        ✓
                    </div>
                    <h3 class="fw-bold text-dark">Aktivasi Berhasil!</h3>
                    <p class="text-muted">Selamat! Akun Anda telah aktif. Sekarang Anda dapat mengakses dashboard dan mengelola kursus Anda.</p>
                    <div class="d-grid mt-4">
                        <a href="login.php" class="btn btn-primary py-2 fw-bold shadow-sm">Login Sekarang</a>
                    </div>

                <?php else: ?>
                    <div class="icon-circle bg-danger-light">
                        ✕
                    </div>
                    <h3 class="fw-bold text-dark">Aktivasi Gagal!</h3>
                    <p class="text-muted">Token tidak valid atau sudah kedaluwarsa (lebih dari 24 jam). Silakan lakukan registrasi ulang.</p>
                    <div class="d-grid mt-4">
                        <a href="register.php" class="btn btn-danger py-2 fw-bold shadow-sm">Kembali ke Registrasi</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php footer_web(); ?>