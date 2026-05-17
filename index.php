<?php
// Incluye el archivo de conexión a la base de datos
include("conection.php");
// Establece la conexión
$con = connection();

// Consulta SQL para seleccionar todos los usuarios de la tabla 'users'
$sql = "SELECT * FROM users";
// Ejecuta la consulta
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link href="css/style.css" rel="stylesheet">
    <!-- Enlace al archivo CSS para estilos -->
</head>
<body>
    <!-- Sección para el formulario de creación de usuarios -->
    <div class="users-form">
        <h1>Crear usuario</h1>
        <!-- Formulario que envía datos a 'insert_user.php' mediante POST -->
        <form action="insert_user.php" method="POST">
            <!-- Campos de entrada para los datos del usuario -->
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="text" name="lastname" placeholder="Apellidos" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email" required>
            <!-- Botón para enviar el formulario -->
            <input type="submit" value="Agregar">
        </form>
    </div>

    <!-- Sección para la tabla de usuarios registrados -->
    <div class="users-table">
        <h2>Usuarios registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <!-- Cuerpo de la tabla donde se mostrarán los datos de los usuarios -->
            <tbody>
                <!-- Itera sobre cada fila de resultados de la consulta -->
                <?php while ($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <!-- Muestra el ID del usuario -->
                    <td><?= $row['id'] ?></td>
                    <!-- Muestra el nombre, apellido, username y email, escapando caracteres HTML para seguridad -->
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['lastname']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <!-- Enlace para editar el usuario, pasando el ID en la URL -->
                    <td><a href="update_user.php?id=<?= $row['id'] ?>">Editar</a></td>
                    <!-- Enlace para eliminar el usuario, con una confirmación JavaScript -->
                    <td><a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>