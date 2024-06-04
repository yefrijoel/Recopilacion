<?php 
include 'connect.php';
include 'templec/cabecera.php';

// Manejar la solicitud de cambio de estado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pedido_id'])) {
    $pedidoId = $_POST['pedido_id'];
    $nuevoEstado = 2; // Cambiar a un estado diferente de 1, por ejemplo, 2

    $updateSql = "UPDATE detalle_pedidos SET estado = ? WHERE pedidocrt_idpe = ?";
    if ($stmt = mysqli_prepare($conectar, $updateSql)) {
        mysqli_stmt_bind_param($stmt, 'ii', $nuevoEstado, $pedidoId);
        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='alert alert-success'>Estado del pedido actualizado correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar el estado del pedido: " . mysqli_stmt_error($stmt) . "</div>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='alert alert-danger'>Error al preparar la consulta de actualización: " . mysqli_error($conectar) . "</div>";
    }
}

// Verificar si hay detalles de pedido disponibles
$sql = "SELECT dp.iddetalle_pedidos, dp.pedidocrt_idpe, dp.productos_idproductos, dp.cantidad, dp.preciounitario, dp.estado, p.nombre
        FROM detalle_pedidos dp
        JOIN productos p ON dp.productos_idproductos = p.idproductos
        WHERE dp.estado = 1
        ORDER BY dp.pedidocrt_idpe";
$resultDetalles = mysqli_query($conectar, $sql);

// Verificar si se encontraron detalles
if (mysqli_num_rows($resultDetalles) > 0) {
?>
<div class="container">
    <h3>Detalles del Pedido</h3>
    <?php 
    $currentPedidoId = null;
    $totalPrecio = 0;
    while ($row = mysqli_fetch_assoc($resultDetalles)) :
        if ($currentPedidoId != $row['pedidocrt_idpe']) {
            if ($currentPedidoId !== null) {
                // Cerrar la tabla anterior y mostrar el total y el botón
                echo "<tr><td colspan='4'><strong>Total</strong></td><td><strong>" . number_format($totalPrecio, 2) . "</strong></td></tr>";
                echo "</tbody></table>";
                // Botón debajo del total
                echo "<form method='POST' class='mb-3'>
                        <input type='hidden' name='pedido_id' value='$currentPedidoId'>
                        <button class='btn btn-primary' type='submit'>Pedido listo</button>
                      </form>";
            }
            $currentPedidoId = $row['pedidocrt_idpe'];
            $totalPrecio = 0; // Reiniciar el total para el nuevo pedido

            // Iniciar una nueva tabla para el nuevo pedido
            echo "<h4>ID Pedido: {$currentPedidoId}</h4>";
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Pedido</th>
                            <th scope="col">Nombre del Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                        </tr>
                    </thead>
                    <tbody>';
        }

        // Acumular el precio total
        $totalPrecio += $row['preciounitario'] * $row['cantidad'];
        ?>
        <tr>
            <td><?php echo $row['iddetalle_pedidos']; ?></td>
            <td><?php echo $row['pedidocrt_idpe']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td><?php echo number_format($row['preciounitario'], 2); ?></td>
        </tr>
    <?php 
    endwhile;
    // Cerrar la última tabla y mostrar el total y el botón
    echo "<tr><td colspan='4'><strong>Total</strong></td><td><strong>" . number_format($totalPrecio, 2) . "</strong></td></tr>";
    echo "</tbody></table>";
    // Botón debajo del total
    echo "<form method='POST' class='mb-3'>
            <input type='hidden' name='pedido_id' value='$currentPedidoId'>
            <button class='btn btn-primary' type='submit'>Pedido listo</button>
          </form>";
    ?>
</div>
<?php 
} else {
    echo "<div class='container'><h3>No hay detalles de pedido disponibles.</h3></div>";
}
include 'templec/piec.php';
?>
