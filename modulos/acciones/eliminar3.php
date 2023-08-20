<?php
    $id=$_GET['id'];
        
   include("../../conexion.php");
   // Preparar la consulta SQL
$query = "DELETE FROM productos WHERE id = $id";

// Ejecutar la consulta SQL
$resultado = mysqli_query($conn, $query);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
    header("Location: ../ListaProductos.php");
} else {
  echo "Ocurrió un error al eliminar el registro.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>