<?php
namespace Paw\App\Validators;

use Paw\Core\Exceptions\InvalidImageException;

class ImageValidator
{
    static public function validateImage($file)
    {
        // Validar el tamaño de la imagen
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            throw new InvalidImageException('El tamaño de la imagen excede el límite permitido. Solo se permite hasta 1 MB'); 
        }

        // Validar que la extension del archivo sea una imagen
        $allowedFormats = ['png', 'jpeg', 'jpg', 'gif'];        
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $file['tmp_name']);
        finfo_close($fileInfo);

        if (!in_array($mimeType, $allowedFormats)) {
            throw new InvalidImageException('El archivo subido no tiene un formato de imagen aceptado. Solo se permite PNG Y JPEG.');
        }

        // Validar el número mágico de la imagen
        $magicNumbers = [
            'png' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A",
            'jpeg' => "\xFF\xD8\xFF",
            'jpg' => "\xFF\xD8\xFF",
        ];

        $fileHandle = fopen($file['tmp_name'], 'rb');
        $magicNumber = fread($fileHandle, 8);
        fclose($fileHandle);

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($magicNumbers[$fileExtension] !== $magicNumber) {
            throw new InvalidImageException('El archivo subido no tiene un formato de imagen aceptado. Solo se permite PNG Y JPEG.');
        }

        // Si todas las validaciones pasan, la imagen es válida
        return true;
    }
}


/* LO QUE ME DIÓ CHAT GPT:
<?php
// Verificar si se ha enviado un archivo
if (isset($_FILES['imagen'])) {
    $imagen = $_FILES['imagen'];

    // Validar el tipo de archivo (PNG o JPEG)
    $tipos_permitidos = array('image/jpeg', 'image/png');
    if (!in_array($imagen['type'], $tipos_permitidos)) {
        die("Error: Solo se permiten archivos PNG o JPEG.");
    }

    // Validar el tamaño del archivo (1 MB máximo)
    if ($imagen['size'] > 1024 * 1024) {
        die("Error: El tamaño máximo permitido es de 1 MB.");
    }

    // Directorio donde se guardará la imagen
    $directorio_destino = 'uploads/';
    
    // Crear el directorio si no existe
    if (!file_exists($directorio_destino)) {
        mkdir($directorio_destino, 0777, true);
    }

    // Generar un nombre único para la imagen
    $nombre_archivo = uniqid('plato_') . '_' . $imagen['name'];

    // Mover la imagen al directorio de destino
    $ruta_archivo = $directorio_destino . $nombre_archivo;
    if (move_uploaded_file($imagen['tmp_name'], $ruta_archivo)) {
        echo "La imagen se ha cargado exitosamente.";
    } else {
        echo "Error al cargar la imagen.";
    }
} else {
    echo "Error: No se ha seleccionado ninguna imagen.";
}
?>
*/

/* ESTO LO ENCOTNRÉ EN INTERNET:
<?php
//Si se quiere subir una imagen
if (isset($_POST['subir'])) {
    //Recogemos el archivo enviado por el formulario
    $archivo = $_FILES['archivo']['name'];
    //Si el archivo contiene algo y es diferente de vacio
    if (isset($archivo) && $archivo != "") {
        //Obtenemos algunos datos necesarios sobre el archivo
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
            - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        }
        else {
            //Si la imagen es correcta en tamaño y tipo
            //Se intenta subir al servidor
            if (move_uploaded_file($temp, 'images/'.$archivo)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('images/'.$archivo, 0777);
                //Mostramos el mensaje de que se ha subido co éxito
                echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                //Mostramos la imagen subida
                echo '<p><img src="images/'.$archivo.'"></p>';
            }
            else {
            //Si no se ha podido subir la imagen, mostramos un mensaje de error
            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
            }
        }
    }
}
?>
*/