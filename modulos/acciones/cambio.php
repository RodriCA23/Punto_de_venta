<?php
$pago=$_GET['pago'];

echo $pago;

header("Location: ../nuevaventa.php?pago=$pago");
?>