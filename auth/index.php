<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:../auth2/login.php');
    exit;
}
include 'includes/koneksi.php';

// Ambil data dari database
$query = "SELECT * FROM pengaduan ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
   <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <h1>Pengaduan Masyarakat</h1>

        <!-- Form Pengaduan -->
        <form action="proses.php" method="POST">
            <input type="hidden" name="action" value="create">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="judul_pengaduan">Judul Pengaduan:</label>
            <input type="text" id="judul_pengaduan" name="judul_pengaduan" required>

            <label for="isi_pengaduan">Isi Pengaduan:</label>
            <textarea id="isi_pengaduan" name="isi_pengaduan" rows="4" required></textarea>

            <button type="submit">Kirim Pengaduan</button>
        </form>

        <!-- Daftar Pengaduan -->
        <h2>Daftar Pengaduan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Pengaduan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . $no++ . "</td>
                            <td>" . $row['nama'] . "</td>
                            <td>" . $row['judul_pengaduan'] . "</td>
                            <td>" . $row['isi_pengaduan'] . "</td>
                            <td>
                                <a href='proses.php?action=edit&id=" . $row['id'] . "' class='btn-edit'>Edit</a>
                                <a href='proses.php?action=delete&id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Hapus laporan ini?\")'>Hapus</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Belum ada pengaduan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <form action="../auth2/logout.php" method="post">
            <button type="submit">logout</button>
        </form>
    </div>
</body>
</html>
