<?php
include 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    $role = $_POST['role'];

    if ($password !== $konfirmasi_password) {
        $error = "Konfirmasi password tidak sesuai!";
    } else {
       
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if ($role == 'Penyewa') {
           
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
            $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
            $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
            $no_ktp = mysqli_real_escape_string($koneksi, $_POST['no_ktp']);

            $cek_ktp = mysqli_query($koneksi, "SELECT * FROM Penyewa WHERE no_ktp = '$no_ktp'");
            if (mysqli_num_rows($cek_ktp) > 0) {
                $error = "No. KTP sudah terdaftar!";
            } else {
              
                $query_penyewa = "INSERT INTO Penyewa (nama_penyewa, alamat_penyewa, no_telepon, no_ktp) 
                                  VALUES ('$nama', '$alamat', '$no_telepon', '$no_ktp')";
                mysqli_query($koneksi, $query_penyewa);
                $id_penyewa = mysqli_insert_id($koneksi);

                $query_user = "INSERT INTO User (username, password, role, id_penyewa) 
                               VALUES ('$username', '$hashed_password', 'Penyewa', $id_penyewa)";
                
                if (mysqli_query($koneksi, $query_user)) {
                    $success = "Registrasi Penyewa Berhasil!";
                } else {
                    $error = "Registrasi gagal: " . mysqli_error($koneksi);
                }
            }
        } elseif ($role == 'Petugas') {
          
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
            $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
            $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);

            $query_petugas = "INSERT INTO Petugas (nama_petugas, alamat_petugas, no_telepon) 
                              VALUES ('$nama', '$alamat', '$no_telepon')";
            mysqli_query($koneksi, $query_petugas);
            $id_petugas = mysqli_insert_id($koneksi);

            $query_user = "INSERT INTO User (username, password, role, id_petugas) 
                           VALUES ('$username', '$hashed_password', 'Petugas', $id_petugas)";
                
            if (mysqli_query($koneksi, $query_user)) {
                $success = "Registrasi Petugas Berhasil!";
            } else {
                $error = "Registrasi gagal: " . mysqli_error($koneksi);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi | PT. Bendi Car</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            background-color: #f4f4f4; 
            margin: 0;
            padding: 20px;
        }
        .registrasi-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <div class="registrasi-container">
        <h2 style="text-align: center;">Registrasi Akun</h2>
        
        <?php 
        if (!empty($error)) {
            echo "<p class='error'>$error</p>";
        }
        if (!empty($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>

        <form method="post">
            <select name="role" required>
                <option value="">Pilih Role</option>
                <option value="Penyewa">Penyewa</option>
                <option value="Petugas">Petugas</option>
            </select>

            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="text" name="no_telepon" placeholder="Nomor Telepon" required>
           
            <div id="penyewa-field" style="display:none;">
                <input type="text" name="no_ktp" placeholder="Nomor KTP">
            </div>

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" required>
            
            <button type="submit">Registrasi</button>
        </form>

        <p style="text-align: center; margin-top: 15px;">
            Sudah punya akun? <a href="login.php">Login</a>
        </p>
    </div>

    <script>
        document.querySelector('select[name="role"]').addEventListener('change', function() {
            const penyewaField = document.getElementById('penyewa-field');
            const ktpInput = penyevaField.querySelector('input');
            
            if (this.value === 'Penyewa') {
                penyewaField.style.display = 'block';
                ktpInput.setAttribute('required', 'required');
            } else {
                penyevaField.style.display = 'none';
                ktpInput.removeAttribute('required');
            }
        });
    </script>
</body>
</html>