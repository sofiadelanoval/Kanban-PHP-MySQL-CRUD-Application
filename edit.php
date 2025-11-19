<?php
include('db.php');

$nombre = '';
$descripcion = '';
$estado = '';
$tag = '';

// Eso es para obtener los datos actuales para mostrar en el form
if  (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM to_do WHERE id=$id";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre_tarea'];
        $descripcion = $row['descripcion_tarea'];
        $estado = $row['estado'];
        $tag = $row['tag'];
    }
}

// Y este es para actualizar los datos cuando se envía el form :)
if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $tag = $_POST['tag'];

    $query = "UPDATE to_do set nombre_tarea = '$nombre', descripcion_tarea = '$descripcion', estado = '$estado', tag = '$tag' WHERE id=$id";
    mysqli_query($conn, $query);
    
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&family=Patrick+Hand&family=Lora:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>

<div class="container">
    <h1>Editar Tarea</h1>

    <div class="input-card">
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST" style="display:flex; width:100%; gap:10px; flex-wrap:wrap;">
            
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required style="flex-grow:1;">
            <textarea name="descripcion" placeholder="Descripción de la tarea" style="flex-grow:2;"><?php echo htmlspecialchars($descripcion); ?></textarea>
            
            <label for="estado-select">Estado:</label>
            <select name="estado" id="estado-select">
                <option value="To Do" <?php if($estado=='To Do') echo 'selected'; ?>>To Do</option>
                <option value="Doing" <?php if($estado=='Doing') echo 'selected'; ?>>Doing</option>
                <option value="In Review" <?php if($estado=='In Review') echo 'selected'; ?>>In Review</option>
                <option value="Done" <?php if($estado=='Done') echo 'selected'; ?>>Done</option>
            </select>

            <label for="tag-select">Tag:</label>
            <select name="tag" id="tag-select">
                <option value="Planning" <?php if($tag=='Planning') echo 'selected'; ?>>Planning</option>
                <option value="Design" <?php if($tag=='Design') echo 'selected'; ?>>Design</option>
                <option value="Development" <?php if($tag=='Development') echo 'selected'; ?>>Dev</option>
                <option value="Testing" <?php if($tag=='Testing') echo 'selected'; ?>>Testing</option>
                <option value="Launch" <?php if($tag=='Launch') echo 'selected'; ?>>Launch</option>
                <option value="Maintenance" <?php if($tag=='Maintenance') echo 'selected'; ?>>Maint</option>
            </select>

            <button type="submit" name="update" class="btn-add">
                <span class="material-symbols-outlined">save</span> Actualizar
            </button>
            <a href="index.php" class="btn-cancel">
                <span class="material-symbols-outlined">cancel</span> Cancelar
            </a>
        </form>
    </div>
</div>

</body>
</html>