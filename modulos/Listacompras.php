<?php
    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $nombre=$_GET['nombre'];
    $nombre2=$_GET['nombre2'];
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
                <h2>Lista de Compras</h2>
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
                <a href="compras.php"><img alt="" src="../assets/cerrar.png" width="70"/></a>
                <p>Cerrar</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
            <form method="post" >
                <p style="text-align: left;">Fecha de inicio <input type="date" name="inicio" id="inicio">  Fecha fin <input type="date" name="fin" id="fin"> <button type="submit"><i class="bi bi-search"></i> Buscar</button></p>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <form method="GET">
                <p style="text-align:right">Buscar por <select name="tipo" id="tipo" class="form-select-sm">
                    <option value="1">Nro de documento</option>
                    <option value="2">Usuario Registro</option>
                </select> <input type="text" name="nombre" id="nombre"> <Button type="submit" class="btn btn-secondary" name="buscar"><i class="bi bi-search"></i></Button> <button class="btn btn-secondary"><i class="bi bi-eraser-fill"></i></button></p>
                </form>
            </div>
        </div>
    <?php
    if(isset($_GET['buscar'])){
        $nombre=$_GET['nombre'];
        $tipo=$_GET['tipo'];
        if($tipo==1){
            $sql="SELECT * FROM compras where id=$nombre";
        }
        if($tipo==2){
            $sql="SELECT * FROM compras where usuario='$nombre'";
        }
        $resul=mysqli_query($conn,$sql);
        if(mysqli_num_rows($resul)>0){
            echo '<div class="table-responsive">';
            echo '<table class="table">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th>Fecha Registro</th>';
            echo '<th>Nro de documento</th>';
            echo '<th>Usuario Registro</th>';
            echo '<th>Proveedor</th>';
            echo '<th>Monto Total</th>';
            echo '<th></th>';
             echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while($fil=mysqli_fetch_array($resul)){
                echo '<tr>';
                echo '<td>' . $fil["fecha"] . '</td>';
                echo '<td>' . $fil["id"] . '</td>';
                echo '<td>' . $fil["usuario"] . '</td>';
                echo '<td>' . $fil["provedor"] . '</td>';
                echo '<td>' . $fil["total"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }

    }
    if($_POST){
        $inicio=$_POST["inicio"];
        $fin=$_POST["fin"];
        
        $query="SELECT * FROM compras WHERE fecha BETWEEN '$inicio' AND '$fin'";
        $resultado=mysqli_query($conn,$query);
        if(mysqli_num_rows($resultado)>0){
            echo '<div class="table-responsive">';
            echo '<table class="table">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th>Fecha Registro</th>';
            echo '<th>Nro de documento</th>';
            echo '<th>Usuario Registro</th>';
            echo '<th>Proveedor</th>';
            echo '<th>Monto Total</th>';
            echo '<th></th>';
             echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while($fila=mysqli_fetch_array($resultado)){
                echo '<tr>';
                echo '<td>' . $fila["fecha"] . '</td>';
                echo '<td>' . $fila["id"] . '</td>';
                echo '<td>' . $fila["usuario"] . '</td>';
                echo '<td>' . $fila["provedor"] . '</td>';
                echo '<td>' . $fila["total"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }

    }
    ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>

