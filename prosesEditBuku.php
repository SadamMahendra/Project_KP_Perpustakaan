<?php   
include('koneksi.php');

$id             = $_POST['id_buku'];
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


$ekstensi_diperbolehkan = array('png','jpg','jpeg');
$nama = $_FILES["file"]['name'];
$x = explode('.',$nama);
$ekstensi = strtolower(end($x));
$ukuran	= $_FILES["file"]['size'];
$file_tmp = $_FILES["file"]['tmp_name'];

if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    if($ukuran < 3000000){			
        move_uploaded_file($file_tmp, 'gambar/'.$nama);

        $query = mysqli_query($conn,"UPDATE buku SET judul_buku='$judul_buku', pengarang='$pengarang', penerbit='$penerbit', tahun_penerbit='$tahun_penerbit', jumlah='$jumlah', deskripsi='$deskripsi', jumlah_halaman='$jumlah_halaman', isbn='$isbn', bahasa_buku='$bahasa_buku', gambar='$nama' , lokasi='$lokasi', rak='$rak', kode='$kode'  WHERE id_buku ='$id' ");
    }else{
        echo "<script>
        alert('UKURAN FILE TERLALU BESAR')
        window.location.href='Buku.php'</script>";
    }
}else{
    $query = mysqli_query($conn,"UPDATE buku SET judul_buku='$judul_buku', pengarang='$pengarang', penerbit='$penerbit', tahun_penerbit='$tahun_penerbit', jumlah='$jumlah', deskripsi='$deskripsi', jumlah_halaman='$jumlah_halaman', isbn='$isbn', bahasa_buku='$bahasa_buku', lokasi='$lokasi', rak='$rak' ,kode='$kode'  WHERE id_buku ='$id' ");
}

if ($query) {
    header("location:Buku.php"); 
}else{
    echo "ERROR, data gagal diupdate". mysqli_error($conn);
}

?>