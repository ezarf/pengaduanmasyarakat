<?php
session_start();
include '../includes/koneksi.php';
if ($_SESSION['role'] != 'user') {
    header('Location: auth2/login.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $judul_pengaduan = $_POST['judul_pengaduan'];
    $isi_pengaduan = $_POST['isi_pengaduan'];

    $query = "INSERT INTO pengaduan (user_id, judul_pengaduan, isi_pengaduan) 
              VALUES ('$user_id', '$judul_pengaduan', '$isi_pengaduan')";
    if (mysqli_query($conn, $query)) {
        echo "Pengaduan berhasil dikirim.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<form method="POST" action="">
    <label>Judul Pengaduan:</label>
    <input type="text" name="judul_pengaduan" required>
    <label>Isi Pengaduan:</label>
    <textarea name="isi_pengaduan" required></textarea>
    <button type="submit">Kirim</button>
</form>
