<?php  
$_GET['id'] = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); // Sanitizar la entrada del ID

include("conection.php"); // Corregida la ruta del archivo include
$con=connection(); 

$id=$_GET['id']; 

// Usar sentencias preparadas para SELECT para prevenir inyecciones SQL
$sql = "SELECT * FROM users WHERE id=?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id); // 'i' para entero
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
} else {
    error_log("Error al preparar la consulta de selección: " . mysqli_error($con));
    die("Error al cargar los datos del usuario.");
}

$row=mysqli_fetch_array($query); 
?> 

<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link href="css/style.css" rel="stylesheet"> 
        <title>Editar usuarios</title> 
    </head> 
    <body> 
        <div class="users-form"> 
            <form action="edit_user.php" method="POST"> 
                <input type="hidden" name="id" value="<?= $row['id']?>">
                <input type="text" name="name" placeholder="Nombre" value="<?= htmlspecialchars($row['name'])?>">
                <input type="text" name="lastname" placeholder="Apellidos" value="<?= htmlspecialchars($row['lastname'])?>">
                <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($row['username'])?>">
                <p><small>La contraseña está encriptada y no se muestra por seguridad.</small></p>
                <input type="text" name="email" placeholder="Email" value="<?= htmlspecialchars($row['email'])?>">
                <input type="submit" value="Actualizar"> 
            </form> 
        </div> 
    </body> 
</html>