<?php
include('koneksi.php');

$id = $_GET['id'];

//query update
$query = mysqli_query($conn,"DELETE FROM `users` WHERE id = '$id'");

if ($query) {
 # credirect ke page index
 header("location:DataUser.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($conn);
}