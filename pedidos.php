
    <!-- OUR MENUS SECTION -->

    <?php
// Verificar si se ha recibido datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el JSON enviado desde el cliente
    $datosJSON = file_get_contents("php://input");
    
    // Decodificar el JSON a un array de PHP
    $carrito = json_decode($datosJSON, true);
    
    // Verificar si la decodificación fue exitosa
    if ($carrito !== null) {
        // Aquí puedes procesar los datos del carrito como lo necesites
        // Por ejemplo, puedes guardarlos en una base de datos, enviarlos por correo electrónico, etc.
        
        // Ejemplo de cómo imprimir los datos del carrito
        echo "Datos recibidos del carrito:\n";
        print_r($carrito);
        
        // Además, puedes procesar los datos adicionales de productos aquí
        require('connect.php');
        $sql = "SELECT * FROM designdb.productos";
        $tabla = mysqli_query($conectar, $sql);
        $productos = mysqli_fetch_all($tabla, MYSQLI_ASSOC);
        
        foreach ($productos as $producto) {
            // Procesar los datos del producto aquí
            // Por ejemplo, puedes guardarlos en una base de datos o realizar cualquier otra acción necesaria
            echo "Producto: " . $producto['nombre'] . ", Descripción: " . $producto['descripcion'] . ", Precio: " . $producto['precio'] . "\n";
        }
    } else {
        // Error al decodificar el JSON
        http_response_code(400); // Bad Request
        echo "Error: No se pudieron decodificar los datos JSON.";
    }
} else {
    // Si no se recibieron datos mediante POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo "Error: Método no permitido. Se esperaba una solicitud POST.";
}
?>
