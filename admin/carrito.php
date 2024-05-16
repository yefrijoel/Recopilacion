<?php
require('connect.php');
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

if (isset($_POST['id']) && isset($_POST['cantidad'])) {
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    if (array_key_exists($id, $_SESSION['carrito'])) {
        $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$id] = array('nombre' => '', 'precio' => 0, 'cantidad' => $cantidad);
    }
}

if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $_SESSION['carrito'][$id] = array('nombre' => $nombre, 'precio' => $precio, 'cantidad' => 1);
}

$carrito = $_SESSION['carrito'];

?>

<h2>Carrito de compra</h2>
<table class="table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($carrito as $id => $producto) { ?>
        <tr>
            <td><?php echo $producto['nombre']; ?></td>
            <td><?php echo $producto['cantidad']; ?></td>
            <td><?php echo $producto['precio']; ?></td>
            <td><?php echo $producto['precio'] * $producto['cantidad']; ?></td>
            <td>
                <a href="carrito.php?eliminar=<?php echo $id; ?>" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php if (count($carrito) > 0) { ?>
    <a href="pago.php" class="btn btn-success">Finalizar compra</a>
<?php } ?>
