<?php
$servidor="localhost";
$db="designdb";
$usuario="root";
$clave="";
$conectar=mysqli_connect($servidor,$usuario,$clave,$db);
if (!$conectar) {
    echo "Error al conectar";
}else{
    echo "Conexion exitos";
}
?>