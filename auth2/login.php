<?php
session_start();
if ( isset($_SESSION['login'])  ) {
    header('Location: ../auth/index.php');
    exit;
}
require('../auth/includes/koneksi.php');

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $pw = $_POST ['pw'];

    $cekemail = mysqli_query($conn,"SELECT * from users where email ='$email");
    $akun = mysqli_fetch_assoc($cekemail);
    if (mysqli_num_rows($cekemail) > 0) {
        if (password_verify($pw, $akun["password"])) {
        $_SESSION ["login"] = true;
        $_SESSION ["email"] =$email;
    
    } else {
        echo "
        <script>
        alert('password salah');
          </script>
        ";
        exit;
    }
} else {
    echo "
    <script>
    alert ('email tidak ditemukan');
    
    </script>";
    exit;
}

}
?>

<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Login</title>
        <link rel="stylesheet" href="../styles/auth.css">
    </head>
    <body>
        <main class="auth-card">
                <h1>Selamat Datang Kembali!</h1>
                <form action="" method="post">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="stephen@email.com" required>
                       
                    </div>
                    <div>
                        <label for="pw">Password</label>
                        <input type="password" name="pw" id="pw" required>
                      
                    </div>
                    <div>
                        <button class="button1" type="submit" name="login">Masuk</button>
                    </div>
                </form>
                <p class="regis-offer">Belum memiliki akun? <a href="register.php">Daftar Sekarang!</a></p>
        </main>
    </body>
</html>