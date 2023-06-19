<?php
// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

// Conectarse a la base de datos
$conexion = mysqli_connect('localhost', 'root', 'adminadmin', 'eq6rentas');

// Verificar la conexión
if (!$conexion) {
  die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Escapar los datos para evitar inyección de SQL
$nombre = mysqli_real_escape_string($conexion, $nombre);
$email = mysqli_real_escape_string($conexion, $email);
$mensaje = mysqli_real_escape_string($conexion, $mensaje);

// Insertar los datos en la base de datos
$consulta = "INSERT INTO `Cliente-Mensaje` (nombre, email, mensaje) VALUES ('$nombre', '$email', '$mensaje')";
if (mysqli_query($conexion, $consulta)) {
  //echo "Los datos se han guardado correctamente.";
  // Redirecting to contacto.html
  header("Location: ../contacto.html");
  exit();
} else {
  //echo "Error al guardar los datos: " . mysqli_error($conexion);
  http_response_code(500); // Enviar código de error HTTP 500
}

// Cerrar la conexión
mysqli_close($conexion);
?>