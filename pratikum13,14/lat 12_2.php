<?php
include 'koneksi.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['nama_petugas']) && isset($_POST['alamat_petugas']) && isset($_POST['no_telepon'])) {
        $nama_petugas = $_POST['nama_petugas'];
        $alamat_petugas = $_POST['alamat_petugas'];
        $no_telepon = $_POST['no_telepon'];

        $query = "INSERT INTO Petugas (nama_petugas, alamat_petugas, no_telepon) 
                  VALUES ('$nama_petugas', '$alamat_petugas', '$no_telepon')";
        
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Semua data harus diisi!";
    }
}

?>

<h2>Tambah Petugas</h2>
<form method="POST" action="tambah_petugas.php">
    <table border="1">
        <tr>
            <td>Nama Petugas</td>
            <td><label for="nama_petugas"></label>
            <input type="text" name="nama_petugas" required></td>
        </tr>
        <tr>
            <td>Alamat Petugas</td>
            <td><label for="alamat_petugas"></label>
            <input type="text" name="alamat_petugas" required></td>
        </tr>
        <tr>
            <td>No Telepon</td>
            <td><label for="no_telepon"></label>
            <input type="text" name="no_telepon" required></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Tambah Petugas" /></td>
        </tr>
    </table>
</form>
