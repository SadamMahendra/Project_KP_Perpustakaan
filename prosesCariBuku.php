<?php
include "koneksi.php";

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM buku
        WHERE
        kode Like '%$keyword%'OR
        judul_buku LIKE '%$keyword%'OR
        pengarang LIKE '%$keyword%'OR
        penerbit LIKE '%$keyword%'OR
        tahun_penerbit LIKE '%$keyword%'OR
        jumlah LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);
    return $result;
}
