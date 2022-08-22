<?php
include "koneksi.php";

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM booking
                WHERE
                nama_anggota LIKE '%$keyword%'OR
                kelas LIKE '%$keyword%'OR
                judul_buku LIKE '%$keyword%' OR
                tgl_booking LIKE '%$keyword%'
                ";
    $result = mysqli_query($conn, $query);
    return $result;
}
