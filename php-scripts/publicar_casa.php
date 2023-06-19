<?php
// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$locacion = $_POST['locacion'];
$estado = $_POST['estado'];
$contacto = $_POST['contacto'];
$direccion = $_POST['direccion'];

// Limpiando las comas del precio
$precio = str_replace(',', '', $precio);

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "adminadmin";
$dbname = "eq6rentas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Obtener el nombre de la imagen subida
$imagenNombre = $_FILES['imagen']['name'];

// Ruta de la carpeta donde se guardarán las imágenes
$carpetaImagenes = '../casas_img/';

// Ruta completa del archivo de imagen
$rutaImagen = $carpetaImagenes . $imagenNombre;

// Verificar si se ha subido una imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Obtener el nombre de la imagen subida
    $imagenNombre = $_FILES['imagen']['name'];

    // Ruta de la carpeta donde se guardarán las imágenes
    $carpetaImagenes = '../casas_img/';

    // Ruta completa del archivo de imagen
    $rutaImagen = $carpetaImagenes . $imagenNombre;

    // Mover la imagen subida a la carpeta destino
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        echo "La imagen se ha guardado correctamente en la carpeta.";

        // Establecer permisos de lectura para todos los usuarios (0644)
        chmod($rutaImagen, 0644);
    } else {
        echo "Error al guardar la imagen en la carpeta.";
    }
} else {
    // En caso de que no se haya subido una imagen, puedes asignar un valor predeterminado o mostrar un mensaje de error.
    $imagenNombre = ""; // Valor predeterminado o establecer como NULL según tus necesidades.
    // Opcional: mostrar un mensaje de error
    echo "No se ha seleccionado una imagen.";
}


// Crear una sentencia preparada
$stmt = $conn->prepare("INSERT INTO `Casas-Oferta` (Nombre, Precio, Locacion, Estado, Contacto, Direccion, Imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Vincular los parámetros
$stmt->bind_param("sdsssss", $nombre, $precio, $locacion, $estado, $contacto, $direccion, $imagenNombre);

// Ejecutar la sentencia preparada
if ($stmt->execute()) {
    echo "Los datos se han guardado correctamente en la base de datos.";
} else {
    echo "Error al guardar los datos: " . $stmt->error;
}

// Cerrar la sentencia preparada y la conexión a la base de datos
$stmt->close();
$conn->close();
?>
