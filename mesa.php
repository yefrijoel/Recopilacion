<?php 
include 'connect.php';
include 'pedidos.php';
include 'templec/cabecera.php';
?>

    <div class="container">
        <br>
        <button class=" btn btn-primary">      
        <a href="mostrarcarrito.php" class="nav-link text-white"> ver carrito (
            <?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']) ?>)</a>    
        </button>
<br>
<br>
        <div class="row ">
            <?php 
            $sql = "SELECT * FROM designdb.productos";
            $tabla = mysqli_query($conectar, $sql);
            $productos = mysqli_fetch_all($tabla, MYSQLI_ASSOC);
           
            ?>
            <?php  foreach ($productos as $producto) { ?>
          <div class="col-md-3">
            <div class="card h-100">
                    <img src="<?php echo $producto['imagen'] ?>" class="card-img-top" alt="..." height="250">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $producto['nombre'] ?></h5>
                      <p class="card-text"><?php echo $producto['descripcion'] ?></p>
                      <span class="menu_price"><?php echo $producto['precio'] ?></span>
                      <br>
                      <form action="" method="post">
                      <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['idproductos'], COD, KEY); ?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY); ?>">
                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
           
                        <button type="submit" id="btnAction" name="btnAction" value="agregar" class="btn btn-primary">Agregar al carrito        
                        </button>

                      </form>
   
                    </div>
            </div>
          </div>

        <?php } ?>
        </div>
        
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
   <?php include 'templec/piec.php' ?>
