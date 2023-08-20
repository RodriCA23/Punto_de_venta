<?php
include("../../conexion.php");
if(isset($_POST['tipo'])){
    $id=$_POST['nombre'];
    $tipo=$_POST['tipo'];
    if($tipo==1){
        $sql="SELECT * FROM compras where id=$id";
    }
    if($tipo==2){
        $sql="SELECT * FROM compras where provedor=$id";
    }
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){
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
        while($fi=mysqli_fetch_array($resultado)){
            echo '<tr>';
            echo '<td>' . $fi["fecha"] . '</td>';
            echo '<td>' . $fi["id"] . '</td>';
            echo '<td>' . $fi["usuario"] . '</td>';
            echo '<td>' . $fi["provedor"] . '</td>';
            echo '<td>' . $fi["total"] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
}
?>