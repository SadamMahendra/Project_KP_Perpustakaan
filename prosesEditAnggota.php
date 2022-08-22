<?php
include('koneksi.php');

$id_anggota = $_GET['id_anggota'];
$nama_anggota = $_GET['nama_anggota'];
$kelas = $_GET['kelas'];
$no_telp = $_GET['no_telp'];
$username = $_GET['username'];
$password = $_GET['password'];

$query = mysqli_query($conn,"UPDATE anggota SET nama_anggota='$nama_anggota' , kelas='$kelas', no_telp='$no_telp', username='$username', password='$password' WHERE id_anggota ='$id_anggota' ");

if ($query) {
    header("location:Anggota.php"); 
}else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);
}

?>