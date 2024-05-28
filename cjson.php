<?php
// Función para guardar el JSON del carrito en la base de datos
function guardarCarritoEnDB($json) {
    // Decodificar el JSON
    $data = json_decode($json, true);
    
    // Extraer la información del carrito
    $orden = $json; // Cambiado para adaptarse a la estructura real del JSON
    $precioTotal = 0; // Establecer el precio total en 0, ya que no está presente en el JSON
    
    // Validar la información (opcional)
    if (!is_array($orden)) {
        return false; // Si la estructura del JSON no es la esperada, devuelve false
    }
    require ('connect.php');

    // Insertar la información en la tabla de la base de datos
    $sql = "INSERT INTO nped (orden, pre) VALUES ('$orden', '$precioTotal')";

    if ($conectar->query($sql) === TRUE) {
        echo "El carrito se ha guardado correctamente en la base de datos.";
    } else {
        echo "Error al guardar el carrito en la base de datos: " . $conectar->error;
    }

    // Cerrar conexión
    $conectar->close();
}

// Ejemplo de uso
$json = file_get_contents('php://input');
guardarCarritoEnDB($json);
?>
