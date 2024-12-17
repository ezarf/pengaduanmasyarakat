<?php
require_once('connection.php');

function register($request) {
    global $conn;
    $name   = trim($request['name']);
    $email  = filter_var(strtolower(trim($request['email'])), FILTER_SANITIZE_EMAIL);
    $pw = mysqli_real_escape_string($conn, $request['pw']);
    $pw2 = mysqli_real_escape_string($conn, $request['pw2']);

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [
            'error' => true,
            'errorEmail' => true,
            'messageEmail' => 'Email tidak valid.'
        ];
    }

    $fetchUser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if( mysqli_num_rows($fetchUser) > 0 ) {
        return [
            'error' => true,
            'errorEmail' => true,
            'messageEmail' => 'Email sudah digunakan. Coba email lain'
        ];
    }

    if ($pw !== $pw2) {
        return [
            'error' => true,
            'errorPw' => true, 
            'messagePw' => 'Password tidak cocok.'
        ];
    }

    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $pw2 = password_hash($pw2, PASSWORD_DEFAULT);

    $result = mysqli_query($conn, "INSERT INTO users (id, name, email, password) VALUES('', '$name', '$email', '$pw')");
    
    if($result) {
        return [
            'error' => false, 
            'message' => 'Berhasil melakukan registrasi. Silakan menuju ke halaman login.'
        ];
    } else {
        return [
            'error' => true, 
            'message' => 'Terjadi kesalahan saat menyimpan data.'
        ];
    }
}

