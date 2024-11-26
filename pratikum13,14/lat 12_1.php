<?php
include "koneksi.php";

$q = mysqli_query($conn, "SELECT * FROM Petugas");

echo "<table border=\"1\">
        <th>ID Petugas</th>
        <th>Nama Petugas</th>
        <th>Alamat Petugas</th>
        <th>No Telepon</th>
        <th>Aksi</th>";

while ($hasil = mysqli_fetch_array($q)) {
    echo "<tr>
            <td>$hasil[id_petugas]</td>
            <td>$hasil[nama_petugas]</td>
            <td>$hasil[alamat_petugas]</td>
            <td>$hasil[no_telepon]</td>
            <td><a href=\"edit_petugas.php?id_petugas=$hasil[id_petugas]\">Edit</a> | 
                <a href=\"hapus_petugas.php?id_petugas=$hasil[id_petugas]\">Hapus</a></td>
          </tr>";
}
echo "</table>";
echo "<br>";

echo "<form action=\"tambah_petugas.php\" method=\"POST\">
        <input type=\"submit\" value=\"Tambah Petugas\" />
      </form>";

?>
