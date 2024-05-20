<!DOCTYPE html>
<html lang="en">

<head>
  <title>producto</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/styles.css">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body id="body-pd">
  <?php
  include 'menulateral.php';
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <h2>Categoria de Producto</h2>
        <div class="card card-login mx-auto mt-4">
          <div class="card-body">
            <form id="" action1="producto.php" method="post">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="number" id="" name="idcate" class="form-control" placeholder="ID" required="required">
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="" name="nombr" class="form-control" placeholder="Nombre" required="required">
                </div>
              </div>
              <div class="form-group">
                <div id="warningbox"></div>
                <input type="submit" class="btn btn-primary btn-block" name="action1" value="Agregar">
              </div>
            </form>
          </div>
        </div>

        <h2 class="mt-4">Producto</h2>
        <div class="card card-login mx-auto mt-4">
          <div class="card-body">
            <form id="" action="producto.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="number" id="" name="idpro" class="form-control" placeholder="ID" required="required">
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="" name="nombre" class="form-control" placeholder="Nombre" required="required">
                </div>
              </div>
              <div class="form-group">
                <div class="form-select-group">
                  <select name="catego" id="" class="form-select form-control">
                    <?php
                    require('connect.php');
                    $sql = "SELECT * FROM designdb.categorias";
                    $tabla = mysqli_query($conectar, $sql);
                    while ($fila = mysqli_fetch_array($tabla)) {
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
                  <input type="number" id="" name="precio" class="form-control" placeholder="Precio" required="required">
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="file" id="imege" name="image" class="form-control" required="required">
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="" name="decri" class="form-control" placeholder="Descripcion" required="required">
                </div>
              </div>
              <div class="form-group">
                <div id="warningbox"></div>
                <input type="submit" class="btn btn-primary btn-block" name="action" value="Agregar">
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="container mt-3">
          <h2>Tabla de Producto</h2>
          <!-- Botón para abrir el modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tablaModal">
            Abrir Tabla
          </button>

          <!-- El Modal -->
          <div class="modal fade" id="tablaModal">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                  <h4 class="modal-title">Tabla de Productos</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Busqueda sensiva en la tabla -->
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"></span>
                  <input type="text" class="form-control" placeholder="Buscar" aria-label="Buscar" id="buscarProducto" onkeyup="buscarProductoEnTabla(this.value)" />
                </div>
                <!-- Cuerpo del Modal -->
                <div class="modal-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Categoría</th>
                          <th scope="col">Precio</th>
                          <th scope="col">Imagen</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody id="tbodyTabla">
                        <?php
                        require('connect.php');
                        $sql = "SELECT productos.idproductos, productos.nombre, categorias.nombre AS categoria, productos.precio, productos.imagen, productos.descripcion 
                FROM designdb.productos 
                JOIN designdb.categorias ON productos.categorias_idcategorias = categorias.idcategorias";
                        $result = mysqli_query($conectar, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                          echo '<tr>';
                          echo '<th scope="row">' . $row['idproductos'] . '</th>';
                          echo '<td>' . $row['nombre'] . '</td>';
                          echo '<td>' . $row['categoria'] . '</td>';
                          echo '<td>' . $row['precio'] . '</td>';
                          echo '<td><img src="../' . $row['imagen'] . '" width="100px" height="100px" alt="' . $row['nombre'] . '"></td>';
                          echo '<td>' . $row['descripcion'] . '</td>';
                          echo '<td>
                   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditarProducto" onclick="llenarModalEditarProducto(' . $row['idproductos'] . ')">Editar</button>
                   <button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(' . $row['idproductos'] . ')">Eliminar</button>
                 </td>';
                          echo '</tr>';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <script>
                  function buscarProductoEnTabla(busqueda) {
                    var tbody = document.getElementById('tbodyTabla');
                    var filas = tbody.getElementsByTagName('tr');
                    var resultado = [];
                    for (var i = 0; i < filas.length; i++) {
                      var fila = filas[i];
                      var nombre = fila.getElementsByTagName('td')[0].innerText;
                      if (nombre.toUpperCase().includes(busqueda.toUpperCase())) {
                        resultado.push(fila);
                      }
                    }
                    // Limpiar la tabla
                    while (tbody.firstChild) {
                      tbody.removeChild(tbody.firstChild);
                    }
                    // Añadir las filas encontradas
                    for (var i = 0; i < resultado.length; i++) {
                      tbody.appendChild(resultado[i]);
                    }
                  }
                </script>


                <!-- Pie del Modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>

                <!-- Modal para editar producto -->
                <div class="modal fade" id="modalEditarProducto">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Editar producto</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group">
                            <label for="nombreProducto">Nombre</label>
                            <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" aria-describedby="nombreProducto">
                          </div>
                          <div class="form-group">
                            <label for="categoriaProducto">Categoría</label>
                            <select class="form-control" id="categoriaProducto" name="categoriaProducto">
                              <option value="">Seleccione una opción</option>
                              <?php
                              require('connect.php');
                              $sql = "SELECT * FROM categorias";
                              $resultado = mysqli_query($conectar, $sql);
                              while ($fila = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $fila['idcategorias'] . '">' . $fila['nombre'] . '</option>';
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="precioProducto">Precio</label>
                            <input type="number" class="form-control" id="precioProducto" name="precioProducto" aria-describedby="precioProducto">
                          </div>
                          <div class="form-group">
                            <label for="imagenProducto">Imagen</label>
                            <input type="file" class="form-control-file" id="imagenProducto" name="imagenProducto">
                          </div>
                          <div class="form-group">
                            <label for="descripcionProducto">Descripción</label>
                            <textarea class="form-control" id="descripcionProducto" name="DescripcionProducto" rows="3"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>

        <script>
          function buscarProductoEnTabla / buscaProductoEnTabla() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscarProducto");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablaProducto");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td");
              for (var j = 0; j < td.length; j++) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                } else {
                  tr[i].style.display = "none";
                }
              }
            }
          }
        </script>

      </div>
    </div>

    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- ===== MAIN JS ===== -->
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
<?php
// Verifica si se ha pasado un ID de producto válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];

  // Aquí puedes implementar la lógica para recuperar y mostrar el formulario de edición del producto con el ID dado
  echo "Editar producto con ID: " . $id;
} else {
  // Si no se proporciona un ID válido, redirige a alguna página de error o de lista de productos
  header("Location: lista_productos.php");
  exit;
}
?>
<?php
// Verifica si se ha pasado un ID de producto válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $id = $_GET['id'];

  // Aquí puedes implementar la lógica para eliminar el producto con el ID dado
  // Por ejemplo:
  // $sql = "DELETE FROM productos WHERE idproductos = $id";
  // mysqli_query($conectar, $sql);
  echo "Eliminar producto con ID: " . $id;
} else {
  // Si no se proporciona un ID válido, redirige a alguna página de error o de lista de productos
  header("Location: lista_productos.php");
  exit;
}
?>

<?php
if (isset($_POST['action1'])) {
  require('connect.php');
  $idcate = $_POST['idcate'];
  $nombr = $_POST['nombr'];
  $sql = "INSERT INTO categorias values ('$idcate','$nombr')";
  $resutado = mysqli_query($conectar, $sql);
  if ($resutado == 1) {
    echo "Guardar";
  } else {
    echo "No guardo";
  }
}
?>
<?php
if (isset($_POST['action'])) {
  require('connect.php');
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