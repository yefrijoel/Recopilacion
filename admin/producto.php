<!DOCTYPE html>
<html lang="en">
    <head>
        <title>producto</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="stylesheet" href="assets/css/styles.css">
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
    <body id="body-pd">
        <?php
        include 'menulateral.php';
        ?>

<div class="container">
    <h2>producto</h2>
      <div class="card card-login mx-auto mt-5">
        <div class="card-body">
          <form id="" action="producto.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="" name="idpro" class="form-control" placeholder="ID" required="required"  >
            
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="text" id="" name="nombre" class="form-control" placeholder="Nombre" required="required" >                 
              </div>
            </div>
            <div class="form-group">
              <div class="form-select-group">               
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
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="number" id="" name="precio" class="form-control" placeholder="Precio" required="required" >                 
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="file" id="imege" name="image" class="form-control"  required="required" >          
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="text" id="" name="decri" class="form-control" placeholder="Descripcion" required="required" >                 
              </div>
            </div>
            <div class="form-group">
                <div id="warningbox">
                </div>
            <input type="submit" class="btn btn-primary btn-block" name="action" value="Agregar" />
          </form>
        </div>
      </div>
      </div>

        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        
        <!-- ===== MAIN JS ===== -->
        <script src="assets/js/main.js"></script>
        <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
    </body>
</html>
<?php
if (isset($_POST['action'])) {
    require ('connect.php');
    $idpro = $_POST['idpro'];
    $nombre = $_POST['nombre'];
    $catego = $_POST['catego'];
    $precio = $_POST['precio'];
    
    // Ruta de la carpeta donde se guardarán las imágenes
    $target_dir = "img/";

    // Nombre del archivo de la imagen
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Mueve el archivo cargado a la carpeta destino
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // La imagen se ha cargado correctamente, ahora guardamos el nombre del archivo en la base de datos
        $image = basename($_FILES["image"]["name"]);

        $decri = $_POST['decri'];
        $sql = "INSERT INTO productos VALUES ('$idpro','$nombre','$catego','$precio','admin/img/$image','$decri')";
        $resultado = mysqli_query($conectar, $sql);
        if ($resultado == 1) {
            echo "Guardado correctamente";
        } else {
            echo "No se pudo guardar";
        }
    } else {
        echo "Error al subir el archivo.";
    }
}
?>
