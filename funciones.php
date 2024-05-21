<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        
    <section class="our_menus" id="menus">
        <div class="container" style="width: auto;">
            <h2 style="text-align: center;margin-bottom: 30px">DESCUBRE NUESTROS MENÚS</h2>
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
                                    <div class="thumbnail" style="cursor:pointer ">
                                        <div class="menu-image">
                                            <img style="width: 150px; height: 150px" class="image-preview" src="<?php echo $producto['imagen'] ?>" alt="">
                                        </div>
                                        <div class="caption">
                                            <h5><?php echo $producto['nombre'] ?></h5>
                                            <p><?php echo $producto['descripcion'] ?></p>
                                            <span class="menu_price"><?php echo $producto['precio'] ?></span>
                                            <br>                                          
                                            <button type="button" name="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carritoModal" onclick="agregarAlCarrito(<?php echo $producto['idproductos'] ?>)">Anadir al carrito</button>
                                           
                                        
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
            </script>
        </div>       
    </section>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carritoModal">Ver carrito</button>

    <script>
        var carrito = JSON.parse(localStorage.getItem('carrito') || '[]');

        function agregarAlCarrito(idProducto, nombre, precio, imagen) {
            var productoEnCarrito = carrito.find(p => p.idproductos == idProducto);
            if (!productoEnCarrito) {
                carrito.push({ idproductos: idProducto, nombre: nombre, precio: precio, imagen: imagen });
                localStorage.setItem('carrito', JSON.stringify(carrito));
            }
            mostrarCarrito();
        }

        function mostrarCarrito() {
            var carritoHTML = '';
            carrito.forEach(producto => {
                carritoHTML += `
                    <div class="row">
                        <div class="col-4">
                            <img style="width: 100px; height: 100px" src="${producto.imagen}" alt="${producto.nombre}">
                        </div>
                        <div class="col-8">
                            <h5>${producto.nombre}</h5>
                            <span class="menu_price">${producto.precio}</span>
                        </div>
                    </div>
                    <hr>
                `;
            });
            var modalBody = document.querySelector('#carritoModal .modal-body');
            modalBody.innerHTML = carritoHTML;
        }
    </script>

<div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carritoModalLabel">Carrito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Continuar comprando</button>
                    <button type="button" class="btn btn-danger">Finalizar compra</button>
                </div>
            </div>
        </div>
    </div>
    

    
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

