<?php
session_start();
// Destruye todas las variables de sesión
session_destroy();
// Redirige al formulario de inicio de sesión
header("Location: index.php");
exit();
?>
