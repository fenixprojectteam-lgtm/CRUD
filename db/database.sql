-- Crea la base de datos si no existe
CREATE DATABASE IF NOT EXISTS users_crud_php; 
-- Selecciona la base de datos para usarla
USE users_crud_php; 

-- Crea la tabla 'users' si no existe
CREATE TABLE IF NOT EXISTS users (
    id INT(11) NOT NULL AUTO_INCREMENT, -- Columna ID, entero, no nulo, auto-incrementable, clave primaria
    name VARCHAR(100) NOT NULL,         -- Nombre del usuario, cadena de hasta 100 caracteres, no nulo
    lastname VARCHAR(100) NOT NULL,     -- Apellido del usuario, cadena de hasta 100 caracteres, no nulo
    username VARCHAR(50) NOT NULL UNIQUE, -- Nombre de usuario, debe ser único
    password VARCHAR(255) NOT NULL,     -- Contraseña (hash), cadena de hasta 255 caracteres, no nulo
    email VARCHAR(100) NOT NULL UNIQUE,   -- Correo electrónico, debe ser único
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de última actualización
    PRIMARY KEY (id)                    -- Define 'id' como la clave primaria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; -- Usa el motor InnoDB y el conjunto de caracteres UTF8 de 4 bytes

-- Opcional: Insertar un usuario de prueba
-- Inserta un registro de ejemplo en la tabla 'users'
-- Password hash generated for 'admin123' using PASSWORD_BCRYPT
INSERT INTO users (name, lastname, username, password, email) VALUES ('Admin', 'Sistema', 'admin', '$2y$10$8K1p/v8Y2.v9.Z.v.v.v.v.v.v.v.v.v.v.v.v.v.v.v.v.v.v.', 'admin@correo.com'); 