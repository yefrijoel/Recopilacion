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
        <div class="container">
        <section class="our_menus" id="menus">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">DESCUBRE NUESTROS MENÚS</h2>			
			<?php
    require('connect.php');
    $sql = "SELECT * FROM categorias";
    $tabla = mysqli_query($conectar, $sql);
?>

<div class="menus_tabs">
    <div class="menus_tabs_picker">
        <div class="row">
            <?php while ($fila = mysqli_fetch_array($tabla)) { ?>
                <div class="col">
                    <div class="tab_category" id="<?php echo $fila[0] ?>">
                        <?php echo $fila[1] ?>
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
        <?php $i = 0; foreach ($productos as $producto) { ?>
            <div class="menu_item tab_category_content col-lg-3 col-md-6 col-sm-12" id="<?php echo $producto['categorias_idcategorias'] ?>" style="display: none;">
                <div class="row py-4">
                    <div class="col-12">
                        <div class="thumbnail" style="cursor:pointer">
                            <div class="menu-image">
                                <div class="image-preview" style="background-image: url(<?php echo $producto['imagen'] ?>);"></div>
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
            <?php if (++$i % 2 == 0) { echo '<hr class="d-md-none d-sm-block"/>'; } ?>
        <?php } ?>
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
    });
</script>			 										
 </div>								
	</section>
        </div>


        <!-- Bootstrap JavaScript Libraries -->
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
