<?php
include("../../conexion.php");
$sqlProve="SELECT * FROM temp";
$pro=mysqli_query($conn,$sqlProve);
if(mysqli_num_rows($pro)>0){
    while($fila1=mysqli_fetch_array($pro)){
        $nombre=$fila1["cliente"];
    }
}
$pago=$_GET['pago'];
$total=$_GET['total'];
$cambio=$pago-$total;
$usuario=$_GET['usuario'];
$fecha=date('Y-m-d');
$query= "INSERT INTO ventas (fecha,usuario,cliente,total,pago,cambio) VALUES ('$fecha','$usuario','$nombre','$total','$pago','$cambio')";

//$sql= "INSERT INTO compras (fecha, usuario, provedor, total, codigoprodu, producto, categoria, medida) VALUES ('$fecha','$usuario','$nombre','$subtotal','$id2','$nombre2','$categoria','$medida')";
//if(mysqli_query($conn,$query)){
    //echo "Los datos se han insertado correctamente";
    //header("Location: ../nuevacompra.php");
    if(mysqli_query($conn,$query)){
        $ultimo=$conn->insert_id;
        echo "el ultimo ID insertado es: ". $ultimo;
        $sql= "SELECT * FROM temp";
        $resultado=mysqli_query($conn,$sql);
        if(mysqli_num_rows($resultado)>0){
            while($fila=mysqli_fetch_array($resultado)){
                $producto=$fila["producto"];
                $cantidad=$fila["cantidad"];
                
                $venta=$fila["venta"];
                $sub=$fila["sub"];
                $proveedor=["cliente"];
                $sqln="INSERT INTO detallesV (id, producto, cantidad,venta,sub,cliente) VALUES ('$ultimo','$producto','$cantidad','$venta','$sub','$proveedor')";
                if(mysqli_query($conn,$sqln)){
                    $stock= "SELECT * FROM productos WHERE nombre= '$producto'";
                    $res=mysqli_query($conn,$stock);
                    if(mysqli_num_rows($res)>0){
                        while($f=mysqli_fetch_array($res)){
                            $antiguo=$f["stock"];
                        }
                    }
                    $cantidad=$antiguo-$cantidad;
                    $sqlP="UPDATE productos set stock=$cantidad WHERE nombre='$producto'"; 
                    if(mysqli_query($conn,$sqlP)){
                    echo "Siuuuu";
                    $eliminar="DELETE FROM temp";
                    $eli=mysqli_query($conn,$eliminar);
                    if($eli){
                        header("Location: ../nuevaventa.php");
                    }
                    }else{
                        echo "Error";
                    }
                }
            }
        }
       
    }else{
        echo "error al insertar el registro:";
    }
    
//}
mysqli_close($conn);
?>