<?php
    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $nombre=$_GET['nombre'];
    $nombre2=$_GET['nombre2'];
    include("../conexion.php");
    $pago=$_GET['pago'];
    
    
    $datos="SELECT * FROM productos WHERE id='$id2'";
    $me=mysqli_query($conn,$datos);
    if(mysqli_num_rows($me)>0){
        while($fa=mysqli_fetch_array($me)){
            $stock=$fa["stock"];
            $vent=$fa["precioventa"];
        }
    }
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
                <h2>Nueva Venta</h2>
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
        
        <div class="col-md-6">
        <form method="post" >
        <p>Doc. Cliente<input type="text" name="codigoP" id="codigoP" value= '<?php echo $id?>'> <a href="ListaClientes.php?id2=<?php echo $id2?>&&nombre2=<?php echo $nombre2?>"><i class="bi bi-search"></i></a></p>
        <p>Cod. Producto<input type="text" name="codigoProdu" id="codigoProdu" value= '<?php echo $id2?>'> <a href="produ.php?id=<?php echo $id?>&&nombre=<?php echo $nombre?>"><i class="bi bi-search"></i></a></p>
        <p>Cantidad: <input type="number" name="cantidad" id="cantidad"  ></p>
        <p>stock <input type="number" name="venta" value=<?php echo $stock?>></p>
        
    
        </div>
        <div class="col-md-6">
           <p>Nombre cliente <input type="text" name="prove" id="prove" value='<?php echo $nombre?>'></p>
           <p>Producto <input type="text" name="produ" id="produ" value='<?php echo $nombre2?>'></p>
           <p>Precio venta <input type="number" name="compra" id="compra" value=<?php echo $vent?>></p>
            <button><i class="bi bi-plus"></i>Agregar</button>
        </form>
        </div>
       
    </div>
    
            
    <?php
    

     $sql ="SELECT * FROM temp";
     $resultado= mysqli_query($conn,$sql);
     $total=0;
     if(mysqli_num_rows($resultado)>0){
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
    while($fila=mysqli_fetch_array($resultado)){
        echo '<tr>';
        echo '<td>' . $fila["producto"] . '</td>';
        echo '<td>' . $fila["cantidad"] . '</td>';
        echo '<td>' . $fila["venta"] . '</td>';
        echo '<td>' . $fila["sub"] . '</td>';
        echo "<td><a href='acciones/eliminarventa.php?id={$fila['id']}' class='btn btn-danger'><i class='bi bi-trash3-fill'></i></a></td>";
        echo '</tr>';
        $total=$total+$fila['sub'];
    }
        echo '</tbody>';
        echo '</table>';
     }else {
        echo "No se encontraron resultados";
    }
    
            // Cerrar la conexión
            if($pago>0){
                $cambio=$pago-$total;   
            }
            
    
    ?>
    </div>
    <div class="row">
        <div class="col-md">
            <button> <a href="ventas.php"><i class="bi bi-arrow-down text-danger"></i> Cancelar</a></button>
            
            
            <button type="submit"><a href="acciones/addventa.php?id=<?php echo $id?>&&nombre=<?php echo $nombre?>&&total=<?php echo $total?>&&usuario=<?php echo $username?>&&fecha=<?php echo $fechalogin?>&&pago=<?php echo $pago?>"><i class="bi bi-tag-fill text-success"></i> Crear venta</a></button>
        </div>
        <div class="col-md">
           
            <p>Total a pagar <input type="number" name="total" id="total" value=<?php echo $total?>></p>
            <form action="acciones/cambio.php?total=<?php echo $total ?>" method="GET">
            
            <p><input type="submit" value="Calcular"> Pago con <input type="number" name="pago" id="pago" > Cambio <input type="text" value=<?php echo $cambio?>></p>
            </form>
        </div>
    </div>
    </div>
    <?php 
    
    if($_POST){
        $provedor=$_POST['prove'];
        $produ=$_POST['produ'];
        
        $cantidad=$_POST['cantidad'];
        $venta=$_POST['compra'];
        $subtotal=$cantidad*$venta;
        echo $provedor;
        echo $produ;
        echo $venta;
        echo $cantidad;
        echo $compra;
        echo $subtotal;
        $total=0;
        $sq="INSERT INTO temp (producto, cantidad, venta, sub, cliente) VALUES ('$produ','$cantidad','$venta','$subtotal','$provedor')";
        if(mysqli_query($conn, $sq)){
            header("Location: nuevaventa.php");
        }else{
            echo "Error" . mysqli_error($conn);
        }

        mysqli_close($conn); 
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>


