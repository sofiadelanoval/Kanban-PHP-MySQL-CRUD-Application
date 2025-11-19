<?php
include('db.php');

if (isset($_POST['save_task'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $tag = $_POST['tag'];

    $query = "INSERT INTO to_do(nombre_tarea, descripcion_tarea, estado, tag) VALUES ('$nombre', '$descripcion', 'To Do', '$tag')";
    $result = mysqli_query($conn, $query);

    if(!$result) {
        die("Query Failed.");
    }

    header("Location: index.php");
}
?>