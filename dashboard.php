<?php
include 'config.php';

// Proteksi Halaman: Cek apakah sudah login dan statusnya AKTIF
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// LOGIKA CRUD MATA KULIAH
// 1. Tambah Data
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode_makul'];
    $nama = $_POST['nama_makul'];
    $desc = $_POST['deskripsi'];
    $sks  = $_POST['sks'];
    mysqli_query($conn, "INSERT INTO mata_kuliah (kode_makul, nama_makul, deskripsi, sks, user_id) 
                        VALUES ('$kode', '$nama', '$desc', '$sks', '$user_id')");
}

// 2. Hapus Data
if (isset($_GET['hapus'])) {
    $id_makul = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM mata_kuliah WHERE id='$id_makul' AND user_id='$user_id'");
}

// Ambil data mata kuliah milik dosen ini
$result = mysqli_query($conn, "SELECT * FROM mata_kuliah WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kelola Mata Kuliah</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-add { background: green; color: white; border: none; }
        .btn-del { background: red; color: white; }
    </style>
</head>
<body>
    <h2>Selamat Datang, Dosen</h2>
    <p><a href="edit_profil.php">Ubah Password / Profil</a> | <a href="logout.php">Logout</a></p>

    <hr>

    <h3>Tambah Mata Kuliah</h3>
    <form method="POST">
        <input type="text" name="kode_makul" placeholder="Kode Makul" required>
        <input type="text" name="nama_makul" placeholder="Nama Makul" required>
        <input type="text" name="deskripsi" placeholder="Deskripsi">
        <input type="number" name="sks" placeholder="SKS" required>
        <button type="submit" name="tambah" class="btn-add">Simpan</button>
    </form>

    <h3>Daftar Mata Kuliah Anda</h3>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>Deskripsi</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['kode_makul']; ?></td>
            <td><?= $row['nama_makul']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td><?= $row['sks']; ?></td>
            <td>
                <a href="?hapus=<?= $row['id']; ?>" class="btn btn-del" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>