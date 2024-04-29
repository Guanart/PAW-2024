<?php
namespace Paw\App\Validators;

class ImageValidator
{
    static public function validateImage($file)
    {
        // Validar el tamaño de la imagen
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            return 'El tamaño de la imagen excede el límite permitido.';
        }

        // Validar que el archivo sea una imagen
        $allowedFormats = ['png', 'jpeg', 'jpg', 'gif'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $file['tmp_name']);
        finfo_close($fileInfo);

        if (!in_array($mimeType, $allowedFormats)) {
            return 'El archivo subido no es una imagen válida.';
        }

        // Validar el número mágico de la imagen
        $magicNumbers = [
            'png' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A",
            'jpeg' => "\xFF\xD8\xFF",
            'jpg' => "\xFF\xD8\xFF",
            'gif' => "GIF"
        ];

        $fileHandle = fopen($file['tmp_name'], 'rb');
        $magicNumber = fread($fileHandle, 8);
        fclose($fileHandle);

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($magicNumbers[$fileExtension] !== $magicNumber) {
            return 'El archivo subido no es una imagen válida.';
        }

        // Si todas las validaciones pasan, la imagen es válida
        return true;
    }
}