<?php
$hostname = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "cleaner_db";

// Membuat koneksi
$db=mysqli_connect($hostname, $username, $password, $dbname);

// Memeriksa koneksi
if ($db->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}else{
    // echo "Koneksi Berhasil";
}

?>
