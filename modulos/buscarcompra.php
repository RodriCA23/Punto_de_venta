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
if($_POST){
    $id=$_POST['doc'];
    $sql="SELECT * FROM compras where id=$id";
    $resultado=mysqli_query($conn,$sql);
    if(mysqli_num_rows($resultado)>0){
        while($fila=mysqli_fetch_array($resultado)){
            $usu=$fila["usuario"];
            $fecha=$fila["fecha"];
            $pro=$fila["provedor"];
            $total=$fila["total"];
        }
    }
    $sqlp="SELECT * FROM provedores where nombre= '$pro'";
    $res=mysqli_query($conn,$sqlp);
    if(mysqli_num_rows($res)>0){
        while($fi=mysqli_fetch_array($res)){
            $idpro=$fi["id"];
            
        }
    }
   
}
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
                <h2>Buscar Compra</h2>
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
            
            <div class="col-md">
                <form method="post">
                <p>Numero de documento <input type="text" name="doc" id="doc"> <button type="submit" value="Buscar" name="boton"><i class="bi bi-search">Buscar</i></button> <button  type="text" name="borrar" id="borrar"><i class="bi bi-eraser-fill"></i>Limpiar</button></p>
                
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4"></div>
            <div class="col-md">
                <h1>Detalle Compra</h1>
            </div>
            <div class="col-md-4">
                <p>Numero documento: <input type="text" value=<?php echo $id?>></p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">

            </div>
            <div class="col-md">
             <P>Usuario Registro <input type="text" value=<?php echo $usu?>></p>
            </div>
            <div class="col-md">
               <p>Fecha Registro <input type="text" value=<?php echo $fecha?>></p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md">
                <p>Doc. Proveedor <input type="text" value=<?php echo $idpro?>></p>
            </div>
            <div class="col-md">
            <p>Nombre Proveedor <input type="text" value=<?php echo $pro?>></p>
            </form>
            </div>
        </div>

       <?php
       if($_POST){
        $sqlC="SELECT * FROM detallesC where id=$id";
        $resul=mysqli_query($conn,$sqlC);
        if(mysqli_num_rows($resul)>0){
            echo '<div class="table-responsive">';
            echo '<table class="table">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th>Producto</th>';
            echo '<th>Cantidad</th>';
            echo '<th>Precio compra</th>';
            echo '<th>Subtotal</th>';
            echo '<th></th>';
    
             echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while($f=mysqli_fetch_array($resul)){
                echo '<tr>';
                echo '<td>' . $f["producto"] . '</td>';
                echo '<td>' . $f["cantidad"] . '</td>';
                echo '<td>' . $f["compra"] . '</td>';
                echo '<td>' . $f["sub"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
       }
       ?>
       <div class="row">
        <div class="col-md">
            <p style="text-align:left;">Total :<input type="text" value=<?php echo $total?>></p>
        </div>
       </div>
       </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>

     