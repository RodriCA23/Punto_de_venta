<?php
// Incluye el archivo de conexión a la base de datos
include("conexion.php");
// Iniciar sesión
session_start();

// Comprobar si el usuario ya ha iniciado sesión
if (isset($_SESSION['user'])) {
    // Si el usuario ya ha iniciado sesión, redirigirlo a otra página
    header("Location: dashboard.php");
    exit();
}
// Verifica si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT pass FROM usuarios WHERE user = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->bind_result($hashcontra);
  $stmt->fetch();
  $stmt->close();
  if (password_verify($password, $hashcontra)) {
    // La contraseña es válida
    echo "Inicio de sesión exitoso";
    date_default_timezone_set('America/Mexico_City');
    $_SESSION['username'] = $username;
    $_SESSION['login_time'] = time();
    header("Location: dashboard.php");
    exit();
} else {
    // La contraseña es incorrecta
    
    $mensaje = "El nombre de usuario o la contraseña son incorrectos";
}
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Iniciar sesión</title>
</head>
<body class="container-fluid bg-secondary-subtle">
  <div class="container-fluid text-center mt-5 ">
    <div class="row">
      <div class="col-md-4">
        
      </div>
      <div class="col-md-4">
      <!--<h1><i class="bi bi-shop"></i></h1>
      <h2>Bienvenido</h2>-->
      <img src="assets/tech.png" alt="" width="300px">
<?php if (isset($mensaje)): ?>
  <p><?php echo $mensaje ?></p>
<?php endif; ?>

<form method="post">
  
 <div class="row mt-4">
  <div class="col">
    <h6 style="text-align:left;">Usuario</h6>
  <input type="text" class="form-control " id="username" name="username">
  </div>
 </div>
  
  <div class="row mt-4 ">
  <h6 style="text-align:left;">Contraseña</h6>
  <div class="col"> <input type="password" class="form-control " id="password" name="password" >
</div>
  </div>
 

  <br>

  <button type="submit" class="btn btn-primary btn-lg">Iniciar Sesion</button>
</form>
      </div>
      <div class="col-md-4">
        
      </div>
    </div>
  
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>


    
