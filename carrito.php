<!-- PHP INCLUDES -->


<!DOCTYPE html>
<html lang="en">

<!-- HEAD -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0" />
    <meta name="author" content="JAIRI IDRISS">
    <title>Restaurant</title>

    <!-- EXTERNAL CSS LINKS -->

    <link rel="stylesheet" type="text/css" href="Design/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Design/fonts/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="Design/css/main.css">
    <link rel="stylesheet" type="text/css" href="Design/css/responsive.css">

    <!-- GOOGLE FONTS -->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">

</head>

<!-- BODY -->

<body>
    <!-- OUR MENUS SECTION -->

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
    <!-- INCLUDE JS SCRIPTS -->

    <script src="Design/js/jquery.min.js"></script>
    <script src="Design/js/bootstrap.min.js"></script>
    <script src="Design/js/bootstrap.bundle.min.js"></script>
    <script src="Design/js/main.js"></script>
    <script src="Design/js/sjava.js"></script>

</body>

<!-- END BODY TAG -->

</html>

<!-- END HTML TAG -->