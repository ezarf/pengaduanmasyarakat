<?php
session_start();

if ( isset($_SESSION['login'])  ) {
    header('Location: ../crud/index.php');
    exit;
}

require('../crud/includes/koneksi.php');

if ($_POST["register"]){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["pw"];

    $cekemail = mysqli_query($conn,"SELECT * from users where email ='$email");
    if (mysqli_num_rows($cekemail) > 0) {
        echo "
        <script>
        alert('email sudah digunakan');
          </script>
        ";
        exit;
    }
    $result =mysqli_query($conn,"INSERT INTO users ('','$name','$email','$password')");
    if ($result){
        echo "
         <script>
         allret('proses pendaftaran berhasil');
        window.location.replace('login.php');
          </script>
        ";
    
    }else {
        echo "<script>
         allret('proses pendaftaran gagal');
       
          </script>";
}
}
?>

<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Login</title>
        <link rel="stylesheet" href="../../style/auth.css">
    </head>
    <body>
        <main>
            <div class="auth-card">
                <h1>Selamat Datang!</h1>
                <form action="" method="post">
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" name="name" id="nama" placeholder="Stephen Jhon" required>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="stephen@email.com" required>
                        
                    </div>
                    <div>
                        <label for="pw">Password</label>
                        <input type="password" name="pw" id="pw" required>
                      
                    </div>
                    <div>
                        <label for="pw2">Konfimasi Password</label>
                        <input type="password" name="pw2" id="pw2" required>
                        
                    </div>
                    <div>
                        <button class="button1" type="submit" name="register">Daftar</button>
                    </div>
                </form>
                <p class="regis-offer">Sudah memiliki akun? <a href="login.php">Masuk</a></p>
            </div>
        </main>
    </body>
</html>