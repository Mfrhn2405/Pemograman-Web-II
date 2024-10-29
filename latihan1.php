<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    
<?php 
class mahasiswa {

    var $nama;
    var $jenis_kelamin;

    function set_nama($nama){
        $this->nama = $nama;
    }
    function get_nama(){
        return $this->nama;
    }
    function set_jenis_kelamin($jenis_kelamin){
        $this->jenis_kelamin = $jenis_kelamin;
    }
    function get_jenis_kelamin(){
        return $this->jenis_kelamin;
    }

}

$farhan = new mahasiswa();
$riko = new mahasiswa();

$farhan->set_nama("Muhammad Farhan");
$riko->set_nama("Hendra Agus Loriko");

$farhan->set_jenis_kelamin("Laki-laki");

$riko->set_jenis_kelamin("Laki-laki");

echo $farhan->get_nama(). " : ". $farhan->get_jenis_kelamin();
echo "<br>";
echo $riko->get_nama(). " : ". $riko->get_jenis_kelamin();

?>


</body>
</html>
