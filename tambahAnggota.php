<?php
include('koneksi.php');

$nama_anggota = $_GET['nama_anggota'];
$kelas = $_GET['kelas'];
$no_telp = $_GET['no_telp'];
$username = $_GET['username'];
$password = $_GET['password'];

//query update
$query = mysqli_query($conn,"INSERT INTO `anggota` (`nama_anggota`,`kelas`,`no_telp`,`username`,`password`) VALUES ('$nama_anggota','$kelas','$no_telp','$username','$password')");

if ($query) {
 # credirect ke page index
 header("location:Anggota.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($conn);
}

//mysql_close($host);
