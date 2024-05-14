<?php
if (isset($_POST['action'])) {
    require ('connect.php');
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $catego = $_POST['catego'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $descripcion = $_POST['descripcion'];
    $sql="INSERT INTO pedidos values ('$id','$nombre','$catego','$image','$descripcion' )";
    $resultado=mysqli_query($conectar,$sql);
    if ($resultado==1) {
       echo "Guardar";
    }else{
        echo "No guardo";
    }
}
?>
<form action="pedidos.php" method="post" enctype="multipart/form-data">
    <input type="number" name="id" class="form-control" placeholder="ID" required>
    <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
    <select name="catego" id="" class="form-select">
                        <?php
                        require('connect.php');
                        $sql="SELECT * FROM designdb.categorias";
                        $tabla=mysqli_query($conectar,$sql);
                        while($fila=mysqli_fetch_array($tabla)){
                            echo "<option value='$fila[0]'>";
                            echo $fila[1];
                            echo "</option>";
                        }
                        ?>
                    </select>    
    <input type="text" name="descripcion" class="form-control" placeholder="Descripcion" required>
    <input type="file" name="image">
    <input type="submit" name="action" value="Guardar">
</form>
