<?php
function connection() {
    $host = "127.0.0.1";
    $user = "root";
    $pass = "admin";
    $bd = "users_crud_php"; 

    $connect = mysqli_connect($host, $user, $pass, $bd);

    if (!$connect) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    return $connect;
}
?>