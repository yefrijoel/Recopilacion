<!doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="assets/css/styles.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <title>Restaurante</title>
    </head>

    <body id="body-pd">
 <!-- ===== menu  ===== -->

        <?php
        include 'menulateral.php';
        ?>
 <!-- ===== comienzo  ===== -->
 <div class="container">
  <div class="row">
    <div class="col-lg-4">
      <h2>rol</h2>
      <div class="card card-login mx-auto mt-4">
        <div class="card-body">
          <form id="" action1="empleado.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="" name="idrol" class="form-control" placeholder="ID" required="required">
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
      
      <h2 class="mt-5">Personal</h2>
      <div class="card card-login mx-auto mt-4">
        <div class="card-body">
          <form id="" action="empleado.php" method="post" >
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" id="" name="idper" class="form-control" placeholder="ID" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="" name="nombre" class="form-control" placeholder="Nombre" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="" name="username" class="form-control" placeholder="Username" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="" name="pass" class="form-control" placeholder="Password" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="form-select-group">
                <select name="rol" id="" class="form-select form-control">
                  <?php
                  require('connect.php');
                  $sql = "SELECT * FROM designdb.rol";
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
              <div id="warningbox"></div>
              <input type="submit" class="btn btn-primary btn-block" name="action" value="Agregar">
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
</div>


        <!-- ===== no borra ===== -->
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
if (isset($_POST['action1'])) {
    require ('connect.php');
    $idrol = $_POST['idrol'];
    $nombr = $_POST['nombr'];
    $sql="INSERT INTO rol values ('$idrol','$nombr')";
    $resutado=mysqli_query($conectar,$sql);
    if ($resutado==1) {
       echo "Guardar";
    }else{
        echo "No guardo";
    }
}
?>

<?php
if (isset($_POST['action'])) {
    require ('connect.php');
    $idper = $_POST['idper'];
    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $rol = $_POST['rol'];
    $sql="INSERT INTO meseros values ('$idper','$nombre','$username','$pass','$rol')";
    $resutado=mysqli_query($conectar,$sql);
    if ($resutado==1) {
       echo "Guardar";
    }else{
        echo "No guardo";
    }
}
?>

