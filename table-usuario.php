<?php
if(isset($_POST['action'])){
    require "connect.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para buscar el usuario con el rol de 10 (admin)
    $sql = "SELECT * FROM meseros WHERE username = ? AND password = ? AND rol_idrol = 10";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result_admin = $stmt->get_result();
    // Si encontramos un usuario con rol de 10, redirigimos al panel de administrador
    if($result_admin->num_rows > 0){
        session_start();
        $_SESSION['username'] = $username;
        header("Location:admin/admin.php");
        exit; // Es importante salir del script después de la redirección
    }

    // Si no se encontró un usuario con rol de 10, buscamos el rol de 20 (mesero)
    $sql = "SELECT * FROM meseros WHERE username = ? AND password = ? AND rol_idrol = 20";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result_mesero = $stmt->get_result();

    // Si encontramos un usuario con rol de 20, redirigimos al panel de pedidos
    if($result_mesero->num_rows > 0){
        session_start();
        $_SESSION['username'] = $username;
       header("Location:mesa.php");
        exit; // Salir del script después de la redirección
    }

    // Si no se encontró un usuario con rol de 10, buscamos el rol de 20 (mesero)
    $sql = "SELECT * FROM meseros WHERE username = ? AND password = ? AND rol_idrol = 30";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result_mesero = $stmt->get_result();

    // Si encontramos un usuario con rol de 20, redirigimos al panel de pedidos
    if($result_mesero->num_rows > 0){
        session_start();
        $_SESSION['username'] = $username;
       header("Location:ver_pedido.php");
        exit; // Salir del script después de la redirección
    }

    // Si no se encuentra ningún usuario con los roles especificados, podría mostrar un mensaje de error.
    // Por ejemplo: echo "Nombre de usuario o contraseña incorrectos.";
}
?>
<!DOCTYPE html>
<html lang="en">
	
	<!-- HEAD -->

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
		<meta name="author" content="JAIRI IDRISS">
		<title>Reservación | Mis Vales</title>

		<!-- EXTERNAL CSS LINKS -->

		<link rel="stylesheet" type="text/css" href="Design/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="Design/fonts/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="Design/css/main.css">
		<link rel="stylesheet" type="text/css" href="Design/css/responsive.css">
        <link rel="stylesheet" type="text/css" href="Design/css/styusu.css">

		<!-- GOOGLE FONTS -->

		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">

	</head>

	<!-- BODY -->

	<body>
	

    
    <!-- START NAVBAR SECTION -->

    <?php include "menupt.php" ?>
<!-- START NAVBAR SECTION -->
<div class="header-height" style="height: 120px;"></div>

    <!-- END NAVBAR SECTION -->    

    <!-- START ORDER FOOD SECTION -->

    <section style="
    background: url(Design/images/food_pic.jpg);
    background-position: center bottom;
    background-repeat: no-repeat;
    background-size: cover;">
        <div class="layer">
            <div style="text-align: center;padding: 15px;">
                <h1 style="font-size: 120px; color: white;font-family: 'Roboto'; font-weight: 100;">USUARIOS</h1>
            </div>
        </div>
        
    </section>

	<section class="table_usuario_section">

        <div class="container col-5">
      <div class="card card-login mx-auto mt-5">
        <div class="card-body">
          <form id="loginform" action="table-usuario.php"  method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Usuario" required="required" autofocus="autofocus" >
            
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contraseña" required="required" >
                 
              </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" name="action" value="Ingresar" />
            </div>
          
          </form>
        </div>
      </div>
    </div>                   
    </section>

    <!-- FOOTER BOTTOM  -->
<?php include "copir.php" ?>   		
	
		<!-- INCLUDE JS SCRIPTS -->

		<script src="Design/js/jquery.min.js"></script>
		<script src="Design/js/bootstrap.min.js"></script>
		<script src="Design/js/bootstrap.bundle.min.js"></script>
		<script src="Design/js/main.js"></script>

	</body>

	<!-- END BODY TAG -->

</html>
