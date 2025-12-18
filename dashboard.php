<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$uid = $_SESSION['user_id'];

// PROSES CRUD MATA KULIAH
if (isset($_POST['simpan_makul'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $desk = $_POST['deskripsi'];
    $sks  = $_POST['sks'];
    mysqli_query($conn, "INSERT INTO mata_kuliah (kode_makul, nama_makul, deskripsi, sks, user_id) VALUES ('$kode', '$nama', '$desk', '$sks', '$uid')");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM mata_kuliah WHERE id = $id AND user_id = $uid");
}

// PROSES UBAH PASSWORD
if (isset($_POST['ubah_pass'])) {
    $new_pass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET password = '$new_pass' WHERE id = $uid");
    $msg_pass = "Password berhasil diubah!";
}

$makul_data = mysqli_query($conn, "SELECT * FROM mata_kuliah WHERE user_id = $uid");
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h1>Dashboard Kelola Mata Kuliah</h1>
    <p>Halo, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Logout</a></p>

    <hr>
    <h3>Ubah Password</h3>
    <?php if(isset($msg_pass)) echo "<p style='color:green'>$msg_pass</p>"; ?>
    <form method="POST">
        <input type="password" name="new_password" placeholder="Password Baru" required>
        <button type="submit" name="ubah_pass">Update Password</button>
    </form>

    <hr>
    <h3>Tambah Mata Kuliah</h3>
    <form method="POST">
        <input type="text" name="kode" placeholder="Kode Makul" required>
        <input type="text" name="nama" placeholder="Nama Makul" required>
        <input type="text" name="deskripsi" placeholder="Deskripsi">
        <input type="number" name="sks" placeholder="SKS" required>
        <button type="submit" name="simpan_makul">Tambah</button>
    </form>

    <h3>Daftar Mata Kuliah</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($makul_data)): ?>
        <tr>
            <td><?php echo $row['kode_makul']; ?></td>
            <td><?php echo $row['nama_makul']; ?></td>
            <td><?php echo $row['deskripsi']; ?></td>
            <td><?php echo $row['sks']; ?></td>
            <td><a href="?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>