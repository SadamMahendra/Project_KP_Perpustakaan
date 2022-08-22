<?php
include('koneksi.php');

$id = $_POST['id_booking'];
$status_booking = $_POST['status_booking'];
$judul_buku   = $_POST['judul_buku'];

$sid        = mysqli_query($conn,"SELECT * FROM buku WHERE judul_buku = '$judul_buku'");
$ibuku      = mysqli_fetch_assoc($sid);
$jumlah_buku = $ibuku['jumlah'];
$jumlah_buku++;
//query update
if  ($status_booking === 'dibooking'){
    $q2     = mysqli_query($conn,"UPDATE buku SET jumlah = $jumlah_buku WHERE judul_buku = '$judul_buku'");
    $query = mysqli_query($conn,"DELETE FROM `booking` WHERE id_booking = '$id'");
}else if ($status_booking === 'batal booking'){
    $query = mysqli_query($conn,"DELETE FROM `booking` WHERE id_booking = '$id'");
}else if ($status_booking === 'berhasil booking'){
    $query = mysqli_query($conn,"DELETE FROM `booking` WHERE id_booking = '$id'");
}
if ($query) {
 # credirect ke page index
 header("location:booking.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($conn);
}