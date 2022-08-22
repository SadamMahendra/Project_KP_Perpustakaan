<?php   

include('koneksi.php');

$id               = $_GET['id_peminjam'];
$nama_anggota     = $_GET['nama_anggota'];
$judul_buku       = $_GET['judul_buku'];
$tgl_minjam       = $_GET['tgl_minjam'];
$tgl_kembali      = $_GET['tgl_kembali'];
$tmp_buku         = $_GET['tmp_buku'];


if($tmp_buku == $judul_buku){
    $query  = mysqli_query($conn,"UPDATE peminjam SET tgl_minjam='$tgl_minjam', tgl_kembali='$tgl_kembali' WHERE id_peminjam =$id ");
    echo "<script>
    window.location.href='Peminjam.php'</script>";
    exit;
}

$q2          = mysqli_query($conn,"SELECT jumlah FROM buku WHERE judul_buku = '$judul_buku'");
$q3          = mysqli_query($conn,"SELECT jumlah FROM buku WHERE judul_buku = '$tmp_buku'"); 
$buku        = mysqli_fetch_assoc($q2);
$buku2       = mysqli_fetch_assoc($q3);
$total       = (int)$buku ['jumlah'];
$total2      = (int)$buku2 ['jumlah'];
$total--;
$total2++;
if ($total <= -1 || $total2 <= -1){
    echo "<script>
    alert('Buku yang ingin ditukar tidak tersedia')
    window.location.href='Peminjam.php'</script>";
}else {
    mysqli_query($conn,"UPDATE buku SET jumlah = $total WHERE judul_buku = '$judul_buku'");
    mysqli_query($conn,"UPDATE buku SET jumlah = $total2 WHERE judul_buku = '$tmp_buku'");
    $query  = mysqli_query($conn,"UPDATE peminjam SET nama_anggota='$nama_anggota', judul_buku='$judul_buku' , tgl_minjam='$tgl_minjam' , tgl_kembali='$tgl_kembali' WHERE id_peminjam =$id ");
}

if ($query) {
    header("location:Peminjam.php"); 
}else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);
}
?>