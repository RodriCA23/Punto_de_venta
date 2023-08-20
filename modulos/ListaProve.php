<?php
$id2=$_GET['id2'];
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Sistema de Punto de Venta</title>
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
        <div class="row mt-5">
            <h3>Lista de Proveedores</h3>
        </div>
        <div class="row">
            <div class="col-md">
                <form method="post">
                <p>Buscar por:
                <select name="filtro" class="form-select-sm">
                    <option value="1">Id</option>
                    <option value="2">Nombre</option>
                </select>
                <input type="text" class="form-control-sm" name="valor"/>
                <button type="submit" class="btn btn-primary" value="Buscar" name="boton"><i class="bi bi-search"></i></button>
                <button type="submit" class="btn btn-secondary" value="Limpiar" name="boton2"><i class="bi bi-trash"></i></button>
                </p>
                </form>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM provedores";
        if (isset($_POST['filtro'])) {
            $buscar=$_POST['valor'];
            $limpiar=$_POST['boton2'];
            $opcionSeleccionada = $_POST['filtro'];
            
            if($opcionSeleccionada==1){
                $sql="SELECT * FROM provedores where id=$buscar";
            }
            if($opcionSeleccionada==2){
                $sql="SELECT * FROM provedores where nombre like '$buscar%'";
            }
            if($limpiar=="Limpiar"){
                $sql = "SELECT * FROM provedores";
            }
          }
        // Realizar consulta a la tabla clientes
        
        $resultado = mysqli_query($conn, $sql);

        // Verificar si se obtuvieron resultados
if (mysqli_num_rows($resultado) > 0) {
    // Crear la tabla con Bootstrap
    echo '<div class="table-responsive">';
    echo '<table class="table">';
    echo '<thead class="thead-light">';
    echo '<tr>';
    echo '<th></th>';
    echo '<th>Numero de documento</th>';
    echo '<th>Nombre</th>';
   
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    // Mostrar cada fila de datos de la tabla
    while ($fila = mysqli_fetch_array($resultado)) {
        echo '<tr>';
        echo "<td><a href='nuevacompra.php?id={$fila['id']}&&nombre={$fila['nombre']}&&id2={$id2}&&nombre2={$nombre}' class='btn btn-danger'><i class='bi bi-check-circle-fill'></i></a></td>";
        echo '<td>' . $fila["id"] . '</td>';
        echo '<td>' . $fila["nombre"] . '</td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo "No se encontraron resultados";
}

        // Cerrar la conexión
        mysqli_close($conn);
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>