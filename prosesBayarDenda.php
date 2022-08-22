<?php
include('koneksi.php');

$id           = $_POST['id_peminjam'];
$status       = $_POST['status_denda'];

//query
$query = mysqli_query($conn,"UPDATE peminjam SET status_denda='$status' WHERE id_peminjam = '$id'");

if ($query) {
#balek ke halaman pinjem
echo "<script>
alert('Pembayaran Berhasil')
window.location.href='Peminjam.php'</script>";
}
else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);

}