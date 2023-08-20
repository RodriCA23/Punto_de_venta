<?php
    $server = "sql112.epizy.com";
    $user = "epiz_33182536";
    $pass = "1q8INidLodHlPQQ";
    $bd = "epiz_33182536_prueba";

    $conn = mysqli_connect($server, $user, $pass, $bd);

    if(!$conn){
        echo "Error de conexion";
    }
?>