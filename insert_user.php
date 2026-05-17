<?php 
include("conection.php"); 
$con = connection(); 

// No es necesario definir $id ya que es AUTO_INCREMENT en la base de datos
$name = $_POST['name']; 
$lastname = $_POST['lastname']; 
$username = $_POST['username']; 
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashear la contraseña por seguridad
$email = $_POST['email']; 

// Usar sentencias preparadas para prevenir inyecciones SQL
// Se omiten la columna 'id' ya que es AUTO_INCREMENT
$sql = "INSERT INTO users (name, lastname, username, password, email) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    // 'sssss' indica que todos los parámetros son strings
    mysqli_stmt_bind_param($stmt, "sssss", $name, $lastname, $username, $password, $email);
    $query_success = mysqli_stmt_execute($stmt);

    if ($query_success) {
        header("Location: index.php"); // Usar header() en minúsculas
        exit(); // Siempre salir después de una redirección de cabecera
    } else {
        // Manejar el error, por ejemplo, registrarlo o mostrar un mensaje amigable
        error_log("Error al insertar usuario: " . mysqli_stmt_error($stmt));
        echo "Error al insertar usuario. Por favor, inténtelo de nuevo.";
    }
    mysqli_stmt_close($stmt);
}else{ 
    // Manejar el error al preparar la sentencia
    error_log("Error al preparar la consulta: " . mysqli_error($con));
    echo "Error interno del servidor. Por favor, inténtelo de nuevo más tarde.";
} 
?>