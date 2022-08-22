<?php
include('koneksi.php');

$id_booking = $_POST['id_booking'];
$batas_booking = $_POST['tgl_batas'];

    $query  = mysqli_query($conn,"UPDATE booking set tgl_batas = '$batas_booking' where id_booking = '$id_booking'");

if ($query) {
#balek ke halaman pinjem
    header('location:booking.php');
}
else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);

}