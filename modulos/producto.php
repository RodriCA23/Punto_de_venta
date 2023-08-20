<?php
include("../conexion.php");
// Iniciar sesión
session_start();

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: ../index.php");
    exit();
}

// Mostrar el nombre de usuario y la hora de inicio de sesión
$username = $_SESSION['username'];
$login_time = $_SESSION['login_time'];
date_default_timezone_set('America/Mexico_City');
$login_time_formatted = date('d-m-Y H:i:s', $login_time);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Sistema de Punto de Venta</title>
</head>
<body class="container">
    <div class="container text-center mt-5">
        <div class="row">
            <div class="col">
            <img alt="" src="../assets/tpv.png" width="70"/>
            </div>
            <div class="col">
                <h1>Sistema Terminal de Punto de Venta</h1>
                <h2>Modulo Productos</h2>
            </div>
            <div class="col">
            <a href="#"><img alt="informacion" src="../assets/informacion.png" width="70"/></a>
            <a href="../logout.php"><img alt="cerrar sesion" src="../assets/verificar.png" width="70"/></a>
            </div>
        </div>
        <div class="row text-bg-primary p-1 m-1">
            <div class="col">
            <p>Nombre Usuario: <?php echo $username?></p>
            </div>
            <div class="col">
            <p>Fecha / Hora de Ingreso: <?php echo $login_time_formatted?></p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <a href="ListaProductos.php"><img alt="" src="../assets/nuevoproducto.png" width="100"/></a>
                <p>Nuevo Producto</p>
            </div>
            <div class="col">
                <a href="cargaproducto.php"><img alt="" src="../assets/cargamasiva.png" width="100"/></a>
                <p>Carga Masiva</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <a href="codigo.php"><img alt="" src="../assets/codigobarras.png" width="100"/></a>
                <p>Código de Barras</p>
            </div>
            <div class="col">
                <a href="../dashboard.php"><img alt="" src="../assets/cerrar.png" width="100"/></a>
                <p>Cerrar</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>