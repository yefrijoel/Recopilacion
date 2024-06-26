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
            <form id="" action1="producto.php" method="post" enctype="multipart/form-data">
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

      <div class="col-lg-8">
        <div class="container mt-3">
          <h2>Tabla de Producto</h2>
          <div class="input-group mb-3">
            <div class="input-group col-6">
              <input type="text" class="form-control" id="inputBuscar" placeholder="Buscar producto...">
            </div>

            <!-- El scrollbar -->
            <div style="overflow-y: scroll; width: 100%; height: 600px;">
              <div style="position: relative;">
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
                 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEditarProducto"
                  data-id="' . $row['idproductos'] . '"
                  data-nombre="' . $row['nombre'] . '"
                  data-categoria="' . $row['categoria'] . '"
                  data-precio="' . $row['precio'] . '"
                  data-imagen="' . $row['imagen'] . '"
                  data-descripcion="' . $row['descripcion'] . '"
                  onclick="llenarModalEditarProducto(this)">Editar</button>
                  <button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(this, ' . $row['idproductos'] . ')">Eliminar</button>
              </td>';
                      echo '</tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

            <script>
              function eliminarProducto(event, id) {
                if (confirm('¿Estas seguro de eliminar el producto?')) {
                  fetch('eliminarProducto.php?id=' + id, {
                    method: 'post'
                  })
                    .then(response => response.json())
                    .then(data => {
                      console.log(data);
                      if (data.estado) {
                        event.target.closest('tr').remove();
                      } else {
                        alert('No se puede eliminar el producto');
                      }
                    })
                    .catch(error => console.error('Error:', error));
                }
              }

              var originalRows = [];

              window.onload = function() {
                var tbody = document.getElementById('tbodyTabla');
                var filas = Array.from(tbody.getElementsByTagName('tr'));
                originalRows = filas.map(function(fila) {
                  return fila.cloneNode(true);
                });
              };

              document.getElementById('inputBuscar').addEventListener('input', function() {
                var busqueda = document.getElementById('inputBuscar').value;
                buscarProductoEnTabla(busqueda);
              });

              function buscarProductoEnTabla(busqueda) {
                var tbody = document.getElementById('tbodyTabla');
                tbody.innerHTML = '';
                if (busqueda === '') {
                  originalRows.forEach(function(fila) {
                    tbody.appendChild(fila);
                  });
                  return;
                }
                var busquedaUpper = busqueda.toUpperCase();
                var resultado = originalRows.filter(function(fila) {
                  var nombre = fila.getElementsByTagName('td')[0].innerText.toUpperCase();
                  return nombre.includes(busquedaUpper);
                });
                resultado.forEach(function(fila) {
                  tbody.appendChild(fila);
                });
              }
            </script>
          </div>
        </div>
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
                      // Verificar si la categoría actual coincide con la categoría del producto
                      $selected = ($fila['idcategorias'] == $row['categorias_idcategorias']) ? 'selected' : '';
                      echo '<option value="' . $fila['idcategorias'] . '" ' . $selected . '>' . $fila['nombre'] . '</option>';
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
                  <img id="imagenPreview" src="" alt="Imagen del producto" width="100px" height="100px">
                </div>
                <div class="form-group">
                  <label for="descripcionProducto">Descripción</label>
                  <textarea class="form-control" id="descripcionProducto" name="DescripcionProducto" rows="3"></textarea>
                </div>
                <button type="submit" name="action5" class="btn btn-primary">Guardar cambios</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <script>
        function llenarModalEditarProducto(button) {
          var id = button.getAttribute('data-id');
          var nombre = button.getAttribute('data-nombre');
          var categoria = button.getAttribute('data-categoria');
          var precio = button.getAttribute('data-precio');
          var imagen = button.getAttribute('data-imagen');
          var descripcion = button.getAttribute('data-descripcion');

          document.getElementById('nombreProducto').value = nombre;
          document.getElementById('categoriaProducto').value = categoria;
          document.getElementById('precioProducto').value = precio;
          document.getElementById('descripcionProducto').value = descripcion;

          var imagenPreview = document.getElementById('imagenPreview');
          if (imagenPreview) {
            imagenPreview.src = '../' + imagen;
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
<?php
// Verificar si se ha enviado el formulario de edición
if (isset($_POST['action5'])) {
    require('connect.php'); // Requerir el archivo de conexión a la base de datos

    // Obtener los datos del formulario
    $idpro = $_POST['idpro'];
    $nombre = $_POST['nombreProducto'];
    $catego = $_POST['categoriaProducto'];
    $precio = $_POST['precioProducto'];
    $decri = $_POST['DescripcionProducto'];
    $image = isset($_FILES["imagenProducto"]["name"]) ? basename($_FILES["imagenProducto"]["name"]) : "";

    // Construir la consulta SQL para actualizar los datos del producto
    $sql = "UPDATE productos 
            SET nombre='$nombre', categorias_idcategorias='$catego', precio='$precio', descripcion='$decri'";

    // Verificar si se cargó una nueva imagen
    if (!empty($image)) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["imagenProducto"]["name"]);

        // Mover la imagen cargada al directorio de imágenes
        if (move_uploaded_file($_FILES["imagenProducto"]["tmp_name"], $target_file)) {
            $sql .= ", imagen='$image'"; // Actualizar el nombre de la imagen en la consulta SQL
        } else {
            echo "Error al subir la imagen.";
            exit; // Salir del script si hay un error al subir la imagen
        }
    }

    $sql .= " WHERE idpro='$idpro'"; // Agregar la condición para actualizar el producto específico

    // Ejecutar la consulta SQL
    $resultado = mysqli_query($conectar, $sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        header("Location: producto.php?msj=Editado correctamente");
        exit;
    } else {
        echo "Error al editar el producto.";
    }
}
?>
