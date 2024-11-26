<?php
$namahost = "localhost";  
$username = "root";      
$password = "";      
$database = "bendi_car";  

$conn = mysqli_connect($namahost, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil ke database '$database'.";
?>
