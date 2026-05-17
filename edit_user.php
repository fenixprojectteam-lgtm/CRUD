<?php
// Incluye el archivo de conexión a la base de datos
include("conection.php");
// Establece la conexión
$con = connection();

// Recoge los datos del formulario POST
// Sanitiza el ID para asegurar que es un entero, previniendo inyecciones SQL
$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); 
$name = $_POST['name']; // Nombre del usuario
$lastname = $_POST['lastname']; // Apellido del usuario
$username = $_POST['username']; // Nombre de usuario
$email = $_POST['email']; // Correo electrónico

// Nota: No actualizamos el password aquí para evitar sobreescribir el hash 
// a menos que se desee implementar lógica de cambio de contraseña.
// Prepara la consulta SQL para actualizar los datos del usuario
$sql = "UPDATE users SET name=?, lastname=?, username=?, email=? WHERE id=?";
// Crea una sentencia preparada para mayor seguridad
$stmt = mysqli_prepare($con, $sql);

// Verifica si la sentencia preparada se creó correctamente
if ($stmt) {
    // Vincula los parámetros a la sentencia preparada
    // 'ssssi' indica que los primeros 4 parámetros son strings y el último es un entero
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $lastname, $username, $email, $id);
    // Ejecuta la sentencia preparada
    $query_success = mysqli_stmt_execute($stmt);

    // Verifica si la ejecución de la consulta fue exitosa
    if ($query_success) {
        // Redirige al usuario a la página principal (index.php)
        header("Location: index.php");
        exit(); // Termina el script después de la redirección
    } else {
        echo "Error al actualizar."; // Muestra un mensaje de error si la actualización falla
    }
    mysqli_stmt_close($stmt); // Cierra la sentencia preparada
} else {
    echo "Error en la consulta."; // Muestra un mensaje si la preparación de la consulta falla
}
?>