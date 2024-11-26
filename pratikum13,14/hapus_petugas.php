<?php

include "koneksi.php";  

$id_petugas = $_GET['id_petugas'];  


if (!empty($id_petugas)) {
    $query = "DELETE FROM Petugas WHERE id_petugas = '$id_petugas'";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID petugas tidak ditemukan!";
}

mysqli_close($conn);
?>
