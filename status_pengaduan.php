<?php
session_start();
include '../includes/koneksi.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM pengaduan WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>
<h1>Status Pengaduan</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>" . $no++ . "</td>
                <td>" . $row['judul_pengaduan'] . "</td>
                <td>" . $row['status'] . "</td>
                <td>" . $row['created_at'] . "</td>
            </tr>";
        }
        ?>
    </tbody>
</table>
