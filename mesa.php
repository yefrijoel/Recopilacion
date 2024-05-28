<!-- PHP INCLUDES -->


<!DOCTYPE html>
<html lang="en">

<!-- HEAD -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0" />
    <title>Restaurant</title>

    <!-- EXTERNAL CSS LINKS -->

    <link rel="stylesheet" type="text/css" href="Design/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Design/fonts/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="Design/css/main2.css">
    <link rel="stylesheet" type="text/css" href="Design/css/navb.css">
    <link rel="stylesheet" type="text/css" href="Design/css/responsive.css">

    <!-- GOOGLE FONTS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">
    <!--<script src="https://cdn.tailwindcss.com"></script> -->

</head>

<!-- BODY -->

<body class="our_menus">
    <nav class="navbar bg-body-tertiary position-fixed end-0">
        <form class="container-fluid justify-content-end our_navbar">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carritoModal">Ver compras</button>
        </form>
    </nav>


    <section class="our_menus " id="menus">
        <div class="container" style="width: auto;">
            <h1 style="text-align: center; margin-bottom: 30px">DESCUBRE NUESTROS MENÚS</h1>
            <?php
            require('connect.php');
            $sql = "SELECT * FROM categorias";
            $tabla = mysqli_query($conectar, $sql);
            $categorias = mysqli_fetch_all($tabla, MYSQLI_ASSOC);
            $firstCategory = $categorias[0]['idcategorias'];
            ?>

            <div class="menus_tabs">
                <div class="menus_tabs_picker">
                    <div class="row">
                        <?php foreach ($categorias as $categoria) { ?>
                            <div class="col">
                                <div class="tab_category <?php echo $categoria['idcategorias'] == $firstCategory ? 'selected' : '' ?>" id="<?php echo $categoria['idcategorias'] ?>">
                                    <?php echo $categoria['nombre'] ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="menus_tab d-flex flex-wrap">
                    <?php
                    $sql = "SELECT * FROM designdb.productos";
                    $tabla = mysqli_query($conectar, $sql);
                    $productos = mysqli_fetch_all($tabla, MYSQLI_ASSOC);
                    ?>
                    <?php $i = 0;
                    foreach ($productos as $producto) { ?>
                        <div class="menu_item tab_category_content col-lg-3 col-md-6 col-sm-12" id="<?php echo $producto['categorias_idcategorias'] ?>" style="display: none;">
                            <div class="row py-4">
                                <div class="col-12">
                                    <div class="thumbnail" style="cursor: pointer;">
                                        <div class="menu-image">
                                            <img style="width: 150px; height: 150px" class="image-preview" src="<?php echo $producto['imagen'] ?>" alt="">
                                        </div>
                                        <div class="caption">
                                            <h5><?php echo $producto['nombre'] ?></h5>
                                            <p><?php echo $producto['descripcion'] ?></p>
                                            <span class="menu_price"><?php echo $producto['precio'] ?></span>
                                            <br>
                                            <input class="text-black" type="number" id="cantidad_<?php echo $producto['idproductos'] ?>" min="1" value="1" max="3" style="width: 60px;">
                                            <button type="button"  class="btn btn-primary" onclick="agregarAlCarrito(<?php echo $producto['idproductos'] ?>)">Añadir al carrito</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (++$i % 2 == 0) {
                            echo '<hr class="d-md-none d-sm-block"/>';
                        } ?>
                    <?php } ?>
                </div>
            </div>

            <style>
                .tab_category.selected {
                    text-decoration: underline;
                    cursor: pointer;
                }
            </style>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var categories = document.querySelectorAll('.tab_category');
                    categories.forEach(function(category) {
                        category.addEventListener('click', function() {
                            var categoryId = this.getAttribute('id');
                            var products = document.querySelectorAll('.tab_category_content');
                            products.forEach(function(product) {
                                if (product.getAttribute('id') === categoryId) {
                                    product.style.display = 'block';
                                } else {
                                    product.style.display = 'none';
                                }
                            });

                            // Remover clase 'selected' de todas las categorías
                            categories.forEach(function(cat) {
                                cat.classList.remove('selected');
                            });

                            // Agregar clase 'selected' a la categoría seleccionada
                            this.classList.add('selected');
                        });
                    });
                    var firstCategory = document.querySelector('.tab_category.selected');
                    if (firstCategory) {
                        firstCategory.click();
                    }
                });

                let carrito = [];

                function agregarAlCarrito(idProducto) {
                    let cantidadInput = document.getElementById('cantidad_' + idProducto);
                    let cantidad = parseInt(cantidadInput.value);

                    if (cantidad < 1 || cantidad > 30) {
                        alert('La cantidad debe ser al menos 1 y no mayor a 30.');
                        return;
                    }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "center",
                        showConfirmButton: false,
                        timer: 1400,

                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Se agrego al carrito"
                    });


                    let producto = <?php echo json_encode($productos); ?>.find(p => p.idproductos == idProducto);

                    carrito.push({
                        producto: producto,
                        cantidad: cantidad
                    });

                    actualizarCarrito();
                }

                function actualizarCarrito() {
                    const carritoItems = document.getElementById('carritoItems');
                    const totalCarrito = document.getElementById('totalCarrito');
                    carritoItems.innerHTML = '';
                    let total = 0;

                    carrito.forEach((item, index) => {
                        const producto = item.producto;
                        const cantidad = item.cantidad;
                        const subtotal = parseFloat(producto.precio) * cantidad;

                        const carritoItem = document.createElement('div');
                        carritoItem.classList.add('carrito-item');
                        carritoItem.innerHTML = `
                        <div class="row">
                            <div class="col-3">
                                <img src="${producto.imagen}" alt="${producto.nombre}" style="width: 100%;">
                            </div>
                            <div class="col-6">
                                <h5>${producto.nombre}</h5>
                                <p>${producto.descripcion}</p>
                                <span>Precio: $${producto.precio}</span><br>
                                <span>Cantidad: ${cantidad}</span><br>
                                <span>Subtotal: $${subtotal.toFixed(2)}</span>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${index})">Eliminar</button>
                            </div>
                        </div>
                        <hr>
                    `;
                        carritoItems.appendChild(carritoItem);
                        total += subtotal;
                    });

                    totalCarrito.textContent = total.toFixed(2);
                }

                function eliminarDelCarrito(index) {
                    carrito.splice(index, 1);
                    actualizarCarrito();
                }
            </script>
        </div>
    </section>

    <!-- Modal -->
    <!-- Modal -->
<div class="modal fade text-black" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carritoModalLabel">Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="mesa.php" method="post">
    <div class="modal-body">
        <div id="carritoItems" name="carritoItems">
            <!-- Los elementos del carrito se añadirán aquí -->
        </div>
        <div class="total" name="pre">
            <strong>Total: $<span id="totalCarrito">0.00</span></strong>
        </div>
        <input type="hidden" id="carritoJSON" name="carritoItems" />
        <input type="submit" name="action" id="btnEnviar" value="Confirmar" class="btn btn-primary"></input>
    </div>
</form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>
<script>
// Convertir el carrito en una cadena JSON

var carritoJSON = JSON.stringify(carrito);

// Establecer el JSON del carrito en el campo oculto
document.getElementById('carritoJSON').value = carritoJSON;

// Enviar la cadena JSON al servidor (puedes usar AJAX)
// Aquí asumiremos que envías el JSON mediante una petición POST
var xhr = new XMLHttpRequest();
xhr.open("POST", "mesa.php", true);
xhr.setRequestHeader("Content-Type", "application/json");
xhr.onreadystatechange = function() {
  if (xhr.readyState === 4 && xhr.status === 200) {
    console.log("El carrito se ha guardado correctamente en la base de datos.");
  }
};
xhr.send(carritoJSON);
</script>
<!-- INCLUDE JS SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


  </body>

<!-- END BODY TAG -->

</html>
<!-- END HTML TAG -->
<?php
// Verificar si se ha enviado el formulario y si el botón "action" tiene el valor esperado
if (isset($_POST['action']) && $_POST['action'] === 'Confirmar') {
    // Obtener el JSON enviado desde el formulario
    require 'connect.php';
    if (isset($_POST['carritoJSON'])) {
        $json = $_POST['carritoJSON'];
        
        // Incluir la función guardarCarritoEnDB
        include 'cjson.php';
        
        // Llamar a la función para guardar el carrito en la base de datos
        guardarCarritoEnDB($json);
    } else {
        echo "Error: No se recibió el JSON del carrito.";
    }
} else {
    echo "Error: Acceso no autorizado.";
}
?>
