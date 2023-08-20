<?php
    $id =$_GET['id'];
    $nombre=$_GET['nombre'];
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
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Generador de códigos de barras</title>
</head>
<body class="container-fluid">
    <div class="container-fluid text-center mt-5">
<div class="row">
            <div class="col-md">
            <img alt="" src="../assets/tpv.png" width="50"/>
            </div>
            <div class="col-md">
                <h1>Punto de Venta</h1>
                <h2>Modulo Productos</h2>
            </div>
            <div class="col-md">
            <a href="#"><img alt="informacion" src="../assets/informacion.png" width="50"/></a>
            <a href="../logout.php"><img alt="cerrar sesion" src="../assets/verificar.png" width="50"/></a>
            </div>
        </div>
        <div class="row text-bg-primary p-1 m-1">
            <div class="col-md">
            <p>Nombre Usuario: <?php echo $username; ?></p>
            </div>
            <div class="col-md">
            <p>Fecha / Hora de Ingreso: <?php echo $login_time_formatted; ?></p>
            </div>
        </div>
        <div class="row mt-5">
            
            <div class="col-6">
                <a href="../dashboard.php"><img alt="" src="../assets/cerrar.png" width="70"/></a>
                <p>Cerrar</p>
            </div>
        </div>
    
    <div class="row">
        
        <div class="col-md-5">
        <form method="post" >
        <h4>Etiqueta</h4>
        
        <p>Codigo <input type="text" name="codigo" id="codigo" value= <?php echo $id?>> <a href="generadorcodigo.php"><i class="bi bi-search"></i></a></p>
        
        <p>Descripcion <input type="text" name="descrip" id="descrip" value= <?php echo $nombre?>></p>
        <p>Numero de etiquetas <input type="number" min=1 name="rep"></p>
        
    
        </div>
        <div class="col-md-5">
           <h4>Configuracion</h4> 
           <p>Tipo de codigo <select name="tipo" id="tipo" class="form-select-sm">
            <option value="Barcode">Barcode</option>
            <option value="Barcode125">Barcode125</option>
            <option value="BarcodeEAN">BarcodeEAN</option>
            <option value="BarcodeMSI">BarcodeMSI</option>
            <option value="Code11">Code11</option>
            <option value="Code39">Code39</option>
            <option value="Code128" selected>Code128</option>
            <option value="Codabar">Codabar</option>
            <option value="BarcodeDatamatrix">BarcodeDatamatrix</option></select></p>
            <p>Orientacion <select name="orientacion" id="orientacion" class="form-select-sm">
                <option value="vertical">Vertical</option>
                <option value="horizontal" selected>Horizontal</option>
            </select></p>
            
        </div>
        <div class="col-md-2">
        <button type="submit" class="btn btn-primary d-flex flex-column align-items-center">
            <i class="bi bi-upc"></i>
            Generar Documento
            </button>
            <button type="submit" class="btn btn-primary d-flex flex-column align-items-center mt-3">
            <i class="bi bi-card-image"></i>
            Generar Imagen
            </button>
            </form>
        </div>
    </div>
    <?php
    if($_POST){
        $texto=$_POST['codigo'];
        $descripcion=$_POST['descrip'];
        $tipo=$_POST['tipo'];
        $orientacion=$_POST['orientacion'];
        echo '<div class="row">';
        echo '<div class="col mt-3">';
        echo '<img src="barcode.php?text=' .$texto. '&size=50&orientation=' .$orientacion. '&codetype=' .$tipo. '&print=true"/>';
        echo '<a href="barcode.php?text=' .$texto. '&size=50&orientation=' .$orientacion. '&codetype=' .$tipo. '&print=true" download>Descargar</a>';
        echo '</div>';
        echo '</div>';

    }
    ?>

    
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>


