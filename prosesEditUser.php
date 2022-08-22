<?php
include('koneksi.php');

$id = $_GET['id'];
$username = $_GET['username'];
$password = $_GET['password'];
$level = $_GET['level'];

$query = mysqli_query($conn,"UPDATE users SET username='$username' , password='$password', level='$level' WHERE id ='$id' ");

if ($query) {
    header("location:DataUser.php"); 
}else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);
}

?>