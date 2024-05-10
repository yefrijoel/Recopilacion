<!doctype html>
<html lang="en">
    <head>
        <title>categoria</title>
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
<div class="row">
    <div class="col">  
       
    <div class="container col-5">
    <h2>categoria de producto</h2>
      <div class="card card-login mx-auto mt-5">
        <div class="card-body">
          <form id="" action1="categoria.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="" name="idcate" class="form-control" placeholder="ID" required="required"  >
            
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="text" id="" name="nombre" class="form-control" placeholder="Nombre" required="required" >
                 
              </div>
            </div>
            <div class="form-group">
                <div id="warningbox">
                </div>
            <input type="submit" class="btn btn-primary btn-block" name="action1" value="Agregar" />
          </form>
        </div>
      </div>
      </div>
    </div>   
    <div class="col">
        
    <div class="container col-5">
    <h2>estado de mesas</h2>
      <div class="card card-login mx-auto mt-5">
        <div class="card-body">
          <form id="" action2="categoria.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="" name="idesta" class="form-control" placeholder="ID" required="required"  >
            
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="text" id="" name="nombres" class="form-control" placeholder="Nombre" required="required" >
                 
              </div>
            </div>
            <div class="form-group">
                <div id="warningbox">
                </div>
            <input type="submit" class="btn btn-primary btn-block"  name="action2" value="Agregar" />
          </form>
        </div>
      </div>
    </div>   
    </div>
    </div>
    <div class="row">
        <div class="col">
       
    
    <div class="container col-5">
    <h2>estado de pedido</h2>
      <div class="card card-login mx-auto mt-5">
        <div class="card-body">
          <form id="" action3="categoria.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="" name="idestado" class="form-control" placeholder="ID" required="required"  >
            
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="text" id="" name="nombr" class="form-control" placeholder="Nombre" required="required" >
                 
              </div>
            </div>
            <div class="form-group">
                <div id="warningbox">
                </div>
            <input type="submit" class="btn btn-primary btn-block" name="action3" value="Agregar" />
          </form>
        </div>
      </div>
    </div>   
    </div>
    <div class="col">

    <div class="container col-5">
    <h2>metodo de pago</h2>
      <div class="card card-login mx-auto mt-5">
        <div class="card-body">
          <form id="" action4="categoria.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="" name="idmeto" class="form-control" placeholder="ID" required="required"  >
            
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="text" id="" name="nomb" class="form-control" placeholder="Nombre" required="required" >
                 
              </div>
            </div>
            <div class="form-group">
                <div id="warningbox">
                </div>
            <input type="submit" class="btn btn-primary btn-block" name="action4" value="Agregar" />
          </form>
        </div>
      </div>
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
<?php
if (isset($_POST['action1'])) {
    require ('connect.php');
    $idcate = $_POST['idcate'];
    $nombre = $_POST['nombre'];
    $sql="INSERT INTO categorias values ('$idcate','$nombre')";
    $resutado=mysqli_query($conectar,$sql);
    if ($resutado==1) {
       echo "Guardar";
    }else{
        echo "No guardo";
    }
}
?>
<?php
if (isset($_POST['action2'])) {
    require ('connect.php');
    $idesta = $_POST['idesta'];
    $nombres = $_POST['nombres'];
    $sql="INSERT INTO estado_mesas values ('$idesta','$nombres')";
    $resutado=mysqli_query($conectar,$sql);
    if ($resutado==1) {
       echo "Guardar";
    }else{
        echo "No guardo";
    }
}
?>
<?php
if (isset($_POST['action3'])) {
    require ('connect.php');
    $idestado = $_POST['idestado'];
    $nombr = $_POST['nombr'];
    $sql="INSERT INTO estado_pedido values ('$idestado','$nombr')";
    $resutado=mysqli_query($conectar,$sql);
    if ($resutado==1) {
       echo "Guardar";
    }else{
        echo "No guardo";
    }
}
?>
<?php
if (isset($_POST['action4'])) {
    require ('connect.php');
    $idmeto = $_POST['idmeto'];
    $nomb = $_POST['nomb'];
    $sql="INSERT INTO medio_pago values ('$idmeto','$nomb')";
    $resutado=mysqli_query($conectar,$sql);
    if ($resutado==1) {
       echo "Guardar";
    }else{
        echo "No guardo";
    }
}
?>