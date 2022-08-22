<?php
include "koneksi.php";

function cari($keyword)
{
    global $conn;
    $query = "SELECT * FROM users
                WHERE
                username LIKE '%$keyword%'OR
                level LIKE '%$keyword%'
                ";
    $result = mysqli_query($conn, $query);
    return $result;
}
