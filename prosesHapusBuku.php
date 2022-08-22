<?php
include('koneksi.php');

$id = $_GET['id_buku'];

//query update
$query = mysqli_query($conn,"DELETE FROM `buku` WHERE id_buku = '$id'");

if ($query) {
 # credirect ke page index
 header("location:buku.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($conn);
}