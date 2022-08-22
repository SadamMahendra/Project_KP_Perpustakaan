<?php
include "koneksi.php";

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM peminjam
                WHERE status='dipinjam' AND nama_anggota LIKE '%$keyword%'OR
                status='dipinjam' AND kelas LIKE '%$keyword%'OR
                status='dipinjam' AND judul_buku LIKE '%$keyword%'OR
                status='dipinjam' AND tgl_minjam LIKE '%$keyword%'OR
                status='dipinjam' AND tgl_kembali LIKE '%$keyword%'
                ";
    $result = mysqli_query($conn, $query);
    return $result;
}
