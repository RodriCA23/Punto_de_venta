<?php
include("../../conexion.php");
// Iniciar sesión
session_start();

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: index.php");
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
            <img alt="" src="../../assets/tpv.png" width="70"/>
            </div>
            <div class="col-md">
                <h1>Punto de Venta</h1>
                
            </div>
            <div class="col-md">
            <a href="#"><img alt="informacion" src="../../assets/informacion.png" width="70"/></a>
            <a href="../../logout.php"><img alt="cerrar sesion" src="../../assets/verificar.png" width="70"/></a>
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
        <form method="post">
            <h2>Formulario de Registro a Usuario</h2>
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                        <h4>Usuario</h4>
                        <input type="text" class="form-control" value="" name="user" />
                        <h4>Nombre completo</h4>
                        <input type="text" class="form-control" value="" name="nombre" />
                        <h4>Rol</h4>
                        <select name="rol" id="rol">
                            <option value="Administrador">Administrador</option>
                            <option value="Empleado">Empleado</option>
                        </select>
                        <h4>Contraseña</h4>
                        <input type="text" class="form-control" value="" name="contra" />
                    </div>
                    <div class="col-md-3">                    </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                        <button type="submit" class="btn btn-primary" name="Agrega" value="Agregar"><i class="bi bi-save-fill"></i> Guardar</button>
                        <a href="../usuarios.php" class="btn btn-danger"><i class="bi bi-x"></i>Cerrar</a>
                        </div>
                        <div class="col-md-1"></div>
                        
                    </div>
                    
                
            </div>
        </form> 
        <?php
        if($_POST){
        
        $nombre = $_POST['nombre'];
        $usuario=$_POST['user'];
        $rol=$_POST['rol'];
        
        $contra=$_POST['contra'];
        $hashcontra=password_hash($contra, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (user, pass, nombre, rol ) VALUES ('$usuario','$hashcontra', '$nombre', '$rol')";

        if (mysqli_query($conn, $sql)) {
        echo "Los datos se han insertado correctamente";
        } else {
        echo "Error al insertar los datos: " . mysqli_error($conn);
        }
        // Cerrar la conexión
        mysqli_close($conn);
            }

        ?>       
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>