<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_kursus");
if (!$conn) { die("Koneksi Gagal: " . mysqli_connect_error()); }
session_start();
?>