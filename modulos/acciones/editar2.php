<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos</title>
</head>
<body>
    <h1>Editar datos</h1>
    <?php
        $id=$_GET['id'];
        
        include("../../conexion.php");
          $query = "SELECT * FROM clientes Where id=$id";
          
          $result = mysqli_query($conn, $query);
          echo "<form method='post'>";
          while($fila = mysqli_fetch_assoc($result)) {
            echo "<p><input type='text' name='editado' value='".$fila['nombre']."'></p>";
            echo "<p><input class='btn btn-success' type='submit'/></p>";
            
          }
          echo "</form>";
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $edit=$_POST["editado"];
            $sql = "UPDATE clientes SET nombre = '$edit' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Registro actualizado correctamente";
        header("Location: ../clientes.php");
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($conn);
    }
}
          
    ?>
</body>
</html>