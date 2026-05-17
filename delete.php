<?php 
include("conection.php"); // Corregida la ruta del archivo include
$con = connection(); 

$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

// Usar sentencias preparadas para prevenir inyecciones SQL
$sql = "DELETE FROM users WHERE id=?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    // 'i' indica que el parámetro es un entero
    mysqli_stmt_bind_param($stmt, "i", $id);
    $query_success = mysqli_stmt_execute($stmt);

    if ($query_success) {
        header("Location: index.php"); // Usar header() en minúsculas
        exit(); // Siempre salir después de una redirección de cabecera
    } else {
        // Manejar el error
        error_log("Error al eliminar usuario: " . mysqli_stmt_error($stmt));
        echo "Error al eliminar usuario. Por favor, inténtelo de nuevo.";
    }
    mysqli_stmt_close($stmt);
}else{ 
    // Manejar el error al preparar la sentencia
    error_log("Error al preparar la consulta: " . mysqli_error($con));
    echo "Error interno del servidor. Por favor, inténtelo de nuevo más tarde.";
} 
?>