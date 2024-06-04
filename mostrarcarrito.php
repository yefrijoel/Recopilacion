<?php 
include 'connect.php';
include 'pedidos.php';
include 'templec/cabecera.php';
?>
<div class="container">
    <h3>Lista de carrito</h3>
    <table class="table table-light table-bordered">
        <tbody>
            <tr>
                <th width="40%">Descripcion</th>
                <th width="15%" class="text-center">Cantidad</th>
                <th width="20%" class="text-center">Precio</th>
                <th width="20%" class="text-center">Total</th>
                <th width="5%">--</th> 
            </tr>
            <?php $total = 0; ?>
            <?php if (isset($_SESSION['CARRITO'])) { ?>
                <?php foreach ($_SESSION['CARRITO'] as $indice => $product) { ?>
                    <tr>
                        <td width="40%"> <?php echo $product['nombre']; ?></td>
                        <td width="15%" class="text-center"> <?php echo $product['cantidad']; ?></td>
                        <td width="20%" class="text-center"> <?php echo $product['precio']; ?></td>
                        <td width="20%" class="text-center"> <?php echo number_format($product['precio'] * $product['cantidad'], 2); ?></td>
                        <form action="" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($product['id'], COD, KEY); ?>">
                            <td width="5%"> <button type="submit" name="btnAction" value="eliminar" class="btn btn-danger">Eliminar</button></td>
                        </form>
                    </tr>
                    <?php $total += $product['precio'] * $product['cantidad']; ?>
                <?php } ?>
                <tr>
                    <td colspan="3" align="right"> <h3>Total</h3></td>
                    <td align="right"><h3><?php echo number_format($total, 2); ?></h3></td>
                    <td></td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td colspan="5" class="text-center">No hay productos en el carrito</td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="5">
                    <form action="pago.php" method="post">
                        <button type="submit" name="btnAction" value="vaciar" class="btn btn-info"> Enviar pedido </button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php include 'templec/piec.php'; ?>
