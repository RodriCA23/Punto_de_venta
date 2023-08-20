<?php
include("../../conexion.php");
$sqlProve="SELECT * FROM temporal";
$pro=mysqli_query($conn,$sqlProve);
if(mysqli_num_rows($pro)>0){
    while($fila1=mysqli_fetch_array($pro)){
        $nombre=$fila1["proveedor"];
    }
}
$total=$_GET['total'];
$usuario=$_GET['usuario'];
$fecha=date('Y-m-d');
$query= "INSERT INTO compras (fecha,usuario,provedor,total) VALUES ('$fecha','$usuario','$nombre','$total')";

//$sql= "INSERT INTO compras (fecha, usuario, provedor, total, codigoprodu, producto, categoria, medida) VALUES ('$fecha','$usuario','$nombre','$subtotal','$id2','$nombre2','$categoria','$medida')";
//if(mysqli_query($conn,$query)){
    //echo "Los datos se han insertado correctamente";
    //header("Location: ../nuevacompra.php");
    if(mysqli_query($conn,$query)){
        $ultimo=$conn->insert_id;
        echo "el ultimo ID insertado es: ". $ultimo;
        $sql= "SELECT * FROM temporal";
        $resultado=mysqli_query($conn,$sql);
        if(mysqli_num_rows($resultado)>0){
            while($fila=mysqli_fetch_array($resultado)){
                $producto=$fila["producto"];
                $cantidad=$fila["cantidad"];
                $compra=$fila["pcompra"];
                $venta=$fila["venta"];
                $sub=$fila["sub"];
                $proveedor=["proveedor"];
                $sqln="INSERT INTO detallesC (id, producto, cantidad, compra,venta,sub,proveedor) VALUES ('$ultimo','$producto','$cantidad','$compra','$venta','$sub','$proveedor')";
                if(mysqli_query($conn,$sqln)){
                    $stock= "SELECT * FROM productos WHERE nombre= '$producto'";
                    $res=mysqli_query($conn,$stock);
                    if(mysqli_num_rows($res)>0){
                        while($f=mysqli_fetch_array($res)){
                            $antiguo=$f["stock"];
                        }
                    }
                    $cantidad=$antiguo+$cantidad;
                    $sqlP="UPDATE productos set precioc= $compra, precioventa=$venta, stock=$cantidad WHERE nombre='$producto'"; 
                    if(mysqli_query($conn,$sqlP)){
                    echo "Siuuuu";
                    $eliminar="DELETE FROM temporal";
                    $eli=mysqli_query($conn,$eliminar);
                    if($eli){
                        header("Location: ../nuevacompra.php");
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