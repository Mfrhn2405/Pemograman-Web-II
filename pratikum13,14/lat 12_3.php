<?php
include "koneksi.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $e = isset($_POST['e']) ? $_POST['e'] : ''; 

    if (empty($e)) {
        $query = "INSERT INTO user (username, password, level) 
                  VALUES ('$username', '$password', '$level')";
        
        if (mysqli_query($conn, $query)) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
    
        $query = "UPDATE user 
                  SET password = '$password', level = '$level' 
                  WHERE username = '$username'";

        if (mysqli_query($conn, $query)) {
            echo "Data berhasil diperbarui!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

header("Location: lat 12_1.php");
exit;
?>
