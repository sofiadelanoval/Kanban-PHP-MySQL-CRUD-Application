CREATE DATABASE todo_list;
USE todo_list;

CREATE TABLE to_do(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_tarea VARCHAR(60) NOT NULL,
    descripcion_tarea VARCHAR(255),
    estado ENUM ('Por hacer', 'Haciendo', 'Bajo revisión', 'Finalizado') DEFAULT 'Por hacer',
    pendiente_creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    pendiente_actualizado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    tag ENUM ('Planeación','Diseño','Desarrollo','Pruebas','Lanzamiento','Mantenimiento')
);
