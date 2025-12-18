<?php 
include 'config.php';
header_web("Registrasi Dosen");

if (isset($_POST['register'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(16));
    $expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<div class='alert alert-danger'>Email sudah digunakan!</div>";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password, token, token_expiry) VALUES ('$email', '$password', '$token', '$expiry')");
        echo "<div class='alert alert-success'>Registrasi Berhasil! <br> Link Aktivasi: <a href='aktivasi.php?token=$token'>Klik Disini</a></div>";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card p-4">
            <h3 class="text-center mb-4">Daftar Akun Dosen</h3>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@kampus.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="register" class="btn btn-primary w-100">Daftar Sekarang</button>
            </form>
            <div class="text-center mt-3">
                Sudah punya akun? <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</div>

<?php footer_web(); ?>