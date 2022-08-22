<?php
include('koneksi.php');


$judul_buku     = $_POST['judul_buku'];
$pengarang      = $_POST['pengarang'];
$penerbit       = $_POST['penerbit'];
$tahun_penerbit = $_POST['tahun_penerbit'];
$jumlah         = $_POST['jumlah'];
$deskripsi      = $_POST['deskripsi'];
$jumlah_halaman = $_POST['jumlah_halaman'];
$isbn           = $_POST['isbn'];
$bahasa_buku    = $_POST['bahasa_buku'];
$lokasi         = $_POST['lokasi'];
$rak            = $_POST['rak'];
$kode           = $_POST['kode'];

$ekstensi_diperbolehkan = array('png','jpg');
$nama = $_FILES["file"]['name'];
$x = explode('.',$nama);
$ekstensi = strtolower(end($x));
$ukuran	= $_FILES["file"]['size'];
$file_tmp = $_FILES["file"]['tmp_name'];

//query update
if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    if($ukuran < 3000000){			
        move_uploaded_file($file_tmp, 'gambar/'.$nama);
        // var_dump($xx);
        // die;
        $query = mysqli_query($conn,"INSERT INTO `buku` (judul_buku,pengarang,penerbit,tahun_penerbit,jumlah,deskripsi,jumlah_halaman,isbn,bahasa_buku,gambar,lokasi,rak,kode) 
        VALUES ('$judul_buku','$pengarang','$penerbit','$tahun_penerbit', $jumlah,'$deskripsi','$jumlah_halaman','$isbn','$bahasa_buku','$nama','$lokasi','$rak','$kode')");
    }else{
        echo "<script>
        alert('UKURAN GAMBAR TERLALU BESAR')
        window.location.href='Buku.php'</script>";
    }
}else{
    // echo "<script>
    //     alert('EKSTENSI GAMBAR YANG DI UPLOAD TIDAK DI PERBOLEHKAN')
    //     window.location.href='Buku.php'</script>";
    $query = mysqli_query($conn,"INSERT INTO `buku` (judul_buku,pengarang,penerbit,tahun_penerbit,jumlah,deskripsi,jumlah_halaman,isbn,bahasa_buku,lokasi,rak,kode) 
    VALUES ('$judul_buku','$pengarang','$penerbit','$tahun_penerbit', $jumlah,'$deskripsi','$jumlah_halaman','$isbn','$bahasa_buku','$lokasi','$rak','$kode')");
}

if ($query) {
# credirect ke page index
header("location:Buku.php"); 
}
else{
echo "ERROR, data gagal diupdate". mysqli_error($conn);
}

//mysql_close($host);
