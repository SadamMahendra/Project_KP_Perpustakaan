<?php
include('koneksi.php');

$id = $_GET['id_anggota'];

//query update
$query = mysqli_query($conn,"DELETE FROM `anggota` WHERE id_anggota = '$id'");

if ($query) {
 # credirect ke page index
 header("location:Anggota.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($conn);
}