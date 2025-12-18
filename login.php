<?php
include 'config.php';
header_web("Login Dosen - Sistem Kursus");

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM users WHERE username = '$email'");
    $user = mysqli_fetch_assoc($res);

    if ($user && password_verify($password, $user['password'])) {
        if ($user['status'] == 'AKTIF') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
        } else {
            $error = "Akun Anda belum aktif. Silakan cek link aktivasi di email Anda.";
        }
    } else {
        $error = "Email atau Password salah!";
    }
}
?>

<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        border-radius: 20px;
        overflow: hidden;
        background: #ffffff;
    }
    .login-header {
        background: #f8f9fa;
        padding: 30px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    .form-control {
        border-radius: 10px;
        padding: 12px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card shadow-lg">
                <div class="login-header">
                    <h3 class="fw-bold text-primary">Selamat Datang</h3>
                    <p class="text-muted small">Silakan masuk ke akun Dosen Anda</p>
                </div>
                <div class="card-body p-4">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger py-2 small"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@kampus.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="login" class="btn btn-primary fw-bold">Masuk</button>
                        </div>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <p class="mb-1 small text-muted">Lupa password? <a href="forgot-password.php" class="text-decoration-none">Reset di sini</a></p>
                        <p class="small text-muted">Belum punya akun? <a href="register.php" class="text-decoration-none fw-bold">Daftar</a></p>
                    </div>
                </div>
            </div>
            <p class="text-center mt-3 text-white-50 small">&copy; 2025 Sistem Manajemen Kursus Dosen</p>
        </div>
    </div>
</div>

<?php footer_web(); ?>