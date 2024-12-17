<?php
include 'includes/koneksi.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == 'create') {
    $nama = $_POST['nama'];
    $judul_pengaduan = $_POST['judul_pengaduan'];
    $isi_pengaduan = $_POST['isi_pengaduan'];

    $query = "INSERT INTO pengaduan (nama, judul_pengaduan, isi_pengaduan) VALUES ('$nama', '$judul_pengaduan', '$isi_pengaduan')";
    mysqli_query($conn, $query);
    header('Location: index.php');
    exit;
} elseif ($action === 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM pengaduan WHERE id = $id";
    mysqli_query($conn, $query);
    header('Location: index.php');
    exit;
} elseif ($action === 'edit') {
    $id = $_GET['id'];
    $query = "SELECT * FROM pengaduan WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Pengaduan</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Edit Pengaduan</h1>
            <form action="proses.php" method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?= $data['nama'] ?>" required>

                <label for="judul_pengaduan">Judul Pengaduan:</label>
                <input type="text" id="judul_pengaduan" name="judul_pengaduan" value="<?= $data['judul_pengaduan'] ?>" required>

                <label for="isi_pengaduan">Isi Pengaduan:</label>
                <textarea id="isi_pengaduan" name="isi_pengaduan" rows="4" required><?= $data['isi_pengaduan'] ?></textarea>

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
} elseif ($action === 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $judul_pengaduan = $_POST['judul_pengaduan'];
    $isi_pengaduan = $_POST['isi_pengaduan'];

    $query = "UPDATE pengaduan SET nama = '$nama', judul_pengaduan = '$judul_pengaduan', isi_pengaduan = '$isi_pengaduan' WHERE id = $id";
    mysqli_query($conn, $query);
    header('Location: index.php');
    exit;
}
?>
