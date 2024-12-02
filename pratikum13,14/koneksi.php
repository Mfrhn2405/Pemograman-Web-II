<?php

$host = 'localhost';      
$username = 'root';       
$password = '';            
$database = 'bendi_car'; 

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8mb4');

function executeQuery($koneksi, $query) {
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Error query: " . mysqli_error($koneksi));
    }
    return $result;
}

function escapeInput($koneksi, $input) {
    return mysqli_real_escape_string($koneksi, $input);
}

function closeConnection($koneksi) {
    mysqli_close($koneksi);
}
?>