<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .alert {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulario de contacto</h1>
        <form class="form-horizontal" action="enviar_contacto.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" placeholder="Correo" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
        <?php
        if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['mensaje'])) {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $mensaje = $_POST['mensaje'];
            $para = 'reyesluis789@gmail.com';
            $asunto = 'Formulario de contacto';
            $mensaje = 'Nombre: ' . $nombre . ' Correo: ' . $correo . ' Mensaje: ' . $mensaje;
            mail($para, $asunto, $mensaje);
            echo '<div class="alert">Mensaje enviado</div>';
        }
        ?>
    </div>
</body>
</html>

