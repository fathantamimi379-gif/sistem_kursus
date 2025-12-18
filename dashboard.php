<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
header_web("Dashboard Dosen");
$uid = $_SESSION['user_id'];

// Logika Tambah & Hapus tetap sama, hanya tampilannya yang berubah
if (isset($_POST['simpan_makul'])) {
    $kode = $_POST['kode']; $nama = $_POST['nama']; $sks = $_POST['sks'];
    mysqli_query($conn, "INSERT INTO mata_kuliah (kode_makul, nama_makul, sks, user_id) VALUES ('$kode', '$nama', '$sks', '$uid')");
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM mata_kuliah WHERE id = $id AND user_id = $uid");
}
$data = mysqli_query($conn, "SELECT * FROM mata_kuliah WHERE user_id = $uid");
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 rounded shadow">
    <div class="container-fluid">
        <span class="navbar-brand">Sistem Kursus</span>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">Halo, <?= $_SESSION['username'] ?></span>
            <a href="logout.php" class="btn btn-light btn-sm">Keluar</a>
        </div>
    </div>
</nav>

<div class="row">
    <div class="col-md-4">
        <div class="card p-4 mb-4">
            <h5>Tambah Mata Kuliah</h5>
            <form method="POST">
                <input type="text" name="kode" class="form-control mb-2" placeholder="Kode" required>
                <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Makul" required>
                <input type="number" name="sks" class="form-control mb-2" placeholder="SKS" required>
                <button type="submit" name="simpan_makul" class="btn btn-success w-100">Simpan</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card p-4">
            <h5>Mata Kuliah Diampu</h5>
            <table class="table table-hover mt-3">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= $row['kode_makul'] ?></td>
                        <td><?= $row['nama_makul'] ?></td>
                        <td><?= $row['sks'] ?></td>
                        <td><a href="?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php footer_web(); ?>