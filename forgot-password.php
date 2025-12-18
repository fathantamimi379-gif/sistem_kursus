<?php
include 'config.php';
header_web("Lupa Password - Sistem Kursus");

if (isset($_POST['request_reset'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$email'");
    
    if (mysqli_num_rows($query) > 0) {
        $token = bin2hex(random_bytes(16));
        mysqli_query($conn, "UPDATE users SET token = '$token' WHERE username = '$email'");
        $msg = "Link reset telah dibuat!<br><a href='reset-password.php?token=$token' class='btn btn-sm btn-outline-success mt-2'>KLIK DI SINI UNTUK RESET</a>";
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<style>
    body { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; display: flex; align-items: center; }
    .forgot-card { border-radius: 20px; border: none; }
    .icon-box { width: 80px; height: 80px; background: #e7f0ff; color: #0d6efd; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 30px; }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card forgot-card shadow p-4">
                <div class="card-body text-center">
                    <div class="icon-box">🔑</div>
                    <h3 class="fw-bold">Lupa Password?</h3>
                    <p class="text-muted">Jangan khawatir! Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
                    
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger py-2 small"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if(isset($msg)): ?>
                        <div class="alert alert-info py-2 small text-start"><?= $msg ?></div>
                    <?php endif; ?>

                    <form method="POST" class="text-start mt-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Email</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@kampus.com" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="request_reset" class="btn btn-primary py-2 fw-bold">Kirim Link Reset</button>
                        </div>
                    </form>
                    
                    <div class="mt-4">
                        <a href="login.php" class="text-decoration-none small">← Kembali ke Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php footer_web(); ?>