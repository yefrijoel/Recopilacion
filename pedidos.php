<?php 
session_start();
$mensaje = "";

// Definir constantes COD y KEY (asegúrate de tener las definiciones correctas en tu archivo)
//define('COD', 'aes-256-cbc'); // Ejemplo de algoritmo de encriptación, usa el que corresponda a tu aplicación
//define('KEY', 'your-secret-key'); // Reemplaza 'your-secret-key' con tu clave secreta

if (isset($_POST['btnAction'])) {
    
    switch($_POST['btnAction']) {
        case 'agregar':
            // Desencriptar los valores
            $id = openssl_decrypt($_POST['id'], COD, KEY);
            $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
            $precio = openssl_decrypt($_POST['precio'], COD, KEY);
            $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
            
            // Validar los valores desencriptados
            if (is_numeric($id)) {
                $mensaje .= " ok id corr: " . $id;  
            } else { 
                $mensaje .= "Error id";    
                break;
            }

            if (is_string($nombre)) {
                $mensaje .= " ok nombre corr: " . $nombre;  
            } else { 
                $mensaje .= "Error nombre";   
                break;
            }

            if (is_numeric($precio)) {
                $mensaje .= " ok precio corr: " . $precio;  
            } else { 
                $mensaje .= "Error precio";  
                break;
            }

            if (is_numeric($cantidad)) {
                $mensaje .= " ok cantidad corr: " . $cantidad;  
            } else { 
                $mensaje .= "Error cantidad";  
                break;
            }

            // Crear el producto a agregar al carrito
            $product = array(
                'id' => $id,
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad,
            );

            // Verificar si el carrito ya existe en la sesión
            if (!isset($_SESSION['CARRITO'])) {
                $_SESSION['CARRITO'] = array();
            }
            
            // Agregar el producto al carrito
            $_SESSION['CARRITO'][] = $product;
            $mensaje = print_r($_SESSION, true);
            ?>
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "center",
                    showConfirmButton: false,
                    timer: 5400,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Se agregó al carrito"
                });
            </script>
            <?php
            break;

        case 'eliminar':
            $id = openssl_decrypt($_POST['id'], COD, KEY);
            if (is_numeric($id)) {
                foreach ($_SESSION['CARRITO'] as $indice => $product) {
                    if ($product['id'] == $id) {
                        unset($_SESSION['CARRITO'][$indice]);
                        // Reindexar el array para evitar huecos
                        $_SESSION['CARRITO'] = array_values($_SESSION['CARRITO']);
                        $mensaje .= "Producto eliminado";
                        break;
                    }
                }
            } else {
                $mensaje .= "Error al eliminar el producto";
            }
            break;
    }
}
?>

    
