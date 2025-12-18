<?php
include 'config.php';
header_web("Reset Password Baru");

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE token = '$token'");
    $user = mysqli_fetch_assoc($query);

    if (!$user) { die("<div class='container mt-5 alert alert-danger text-center'>Token tidak valid!</div>"); }

    if (isset($_POST['update_password'])) {
        $new_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password = '$new_pass', token = NULL WHERE token = '$token'");
        echo "<script>alert('Password berhasil diupdate!'); window.location='login.php';</script>";
        exit();
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h4 class="fw-bold text-center mb-4">Buat Password Baru</h4>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" placeholder="Ulangi password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="update_password" class="btn btn-success py-2 fw-bold">Simpan Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php footer_web(); ?>