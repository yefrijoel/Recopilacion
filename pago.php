<?php 
include 'connect.php';
include 'pedidos.php';
include 'templec/cabecera.php';

// Iniciar sesión
//session_start();
?>
<div class="container">
<?php
if ($_POST) {
    $tota = 0;
    $sid = session_id();
    
    // Verifica si el carrito está configurado correctamente
    if (!isset($_SESSION['CARRITO']) || empty($_SESSION['CARRITO'])) {
        echo "<h3>Error: El carrito está vacío.</h3>";
        exit;
    }

    foreach ($_SESSION['CARRITO'] as $indice => $product) {
        $tota += $product['precio'] * $product['cantidad'];
    }

    // Verifica si el total calculado es válido
    if ($tota <= 0) {
        echo "<h3>Error: El total del pedido no es válido.</h3>";
        exit;
    }

    // Preparar la consulta SQL con marcadores de posición
    $sql = "INSERT INTO `pedidocrt` (`idpe`, `clevetransa`, `fecha`, `total`, `status`) 
            VALUES (NULL, ?, NOW(), ?, 'pendiente')";

    // Preparar la declaración
    if ($stmt = mysqli_prepare($conectar, $sql)) {
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, 'sd', $sid, $tota);

        // Ejecutar la declaración
        if (mysqli_stmt_execute($stmt)) {
            // Obtener el ID de la venta insertada
            $idventa = mysqli_insert_id($conectar);

            // Cerrar la declaración después de la inserción
            mysqli_stmt_close($stmt);

            // Insertar detalles del pedido
            $detalleSql = "INSERT INTO `detalle_pedidos` (`iddetalle_pedidos`, `pedidocrt_idpe`, `productos_idproductos`, `cantidad`, `preciounitario`, `estado`) 
                           VALUES (NULL, ?, ?, ?, ?,'1')";

            // Preparar la declaración para los detalles del pedido
            if ($detalleStmt = mysqli_prepare($conectar, $detalleSql)) {
                foreach ($_SESSION['CARRITO'] as $indice => $product) {
                    // Vincular parámetros
                    mysqli_stmt_bind_param($detalleStmt, 'iiid', $idventa, $product['id'], $product['cantidad'], $product['precio']);
                    
                    // Ejecutar la declaración
                    if (!mysqli_stmt_execute($detalleStmt)) {
                        echo "<h3>Error al insertar detalle del pedido: " . mysqli_error($conectar) . "</h3>";
                        mysqli_stmt_close($detalleStmt);
                        exit;
                    }
                }

                // Cerrar la declaración después de todas las inserciones
                mysqli_stmt_close($detalleStmt);
            } else {
                echo "<h3>Error al preparar la declaración para los detalles del pedido: " . mysqli_error($conectar) . "</h3>";
                exit;
            }

            // Verificar si la inserción del pedido fue exitosa
            if ($idventa > 0) {
                unset($_SESSION['CARRITO']);
                header("Location: mesa.php");
                exit;
            } else {
                echo "<h3>Error: No se pudo insertar el pedido</h3>";
            }
        } else {
            echo "<h3>Error al ejecutar la declaración de pedido: " . mysqli_stmt_error($stmt) . "</h3>";
        }
    } else {
        echo "<h3>Error al preparar la declaración de pedido: " . mysqli_error($conectar) . "</h3>";
    }
}
?>


</div>
<?php include 'templec/piec.php'; ?>
