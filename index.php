<?php 
include('db.php'); 

$query = "SELECT * FROM to_do ORDER BY pendiente_creado DESC";
$result_tasks = mysqli_query($conn, $query);
$tasks = [];
while($row = mysqli_fetch_assoc($result_tasks)) {
    $tasks[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&family=Patrick+Hand&family=Lora:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Mi Lista To-Do</h1>

    <div class="input-card">
        <form action="save_task.php" method="POST" style="display:flex; width:100%; gap:10px; flex-wrap:wrap;">
            <input type="text" name="nombre" placeholder="Nueva tarea..." required style="flex-grow:1;">
            <input type="text" name="descripcion" placeholder="Detalles..." style="flex-grow:2;">
            
            <select name="tag">
                <option value="Planning">Planeaci&oacute;n</option>
                <option value="Design">Dise&ntilde;o</option>
                <option value="Development">Desarrollo</option>
                <option value="Testing">Pruebas</option>
                <option value="Launch">Lanzamiento</option>
                <option value="Maintenance">Mantenimiento</option>
            </select>

            <button type="submit" name="save_task" class="btn-add">
                <span class="material-symbols-outlined">add</span>Crear
            </button>
        </form>
    </div>

    <div class="kanban-board">
        
        <div class="column">
            <div class="column-title">Por hacer</div>
            <?php renderColumn($tasks, 'To Do'); ?>
        </div>

        <div class="column">
            <div class="column-title">Haciendo</div>
            <?php renderColumn($tasks, 'Doing'); ?>
        </div>

        <div class="column">
            <div class="column-title">En Revisi&oacute;n</div>
            <?php renderColumn($tasks, 'In Review'); ?>
        </div>

        <div class="column">
            <div class="column-title">Finalizado</div>
            <?php renderColumn($tasks, 'Done'); ?>
        </div>

    </div>
</div>

<?php
function renderColumn($tasks, $status) {
    foreach($tasks as $task) {
        if($task['estado'] == $status) {
            $tagClass = 'bg-' . strtolower($task['tag']);
            ?>
            
            <div class="post-it <?php echo $tagClass; ?>">
                <div class="meta">
                    <span>#<?php echo $task['tag']; ?></span>
                    <small><?php echo date('d/m', strtotime($task['pendiente_creado'])); ?></small>
                </div>
                
                <h4><?php echo $task['nombre_tarea']; ?></h4>
                <p><?php echo $task['descripcion_tarea']; ?></p>
                
                <div class="actions">
                    <a href="edit.php?id=<?php echo $task['id']?>" class="btn-icon" title="Editar">
                        <span class="material-symbols-outlined">edit_note</span>
                    </a>
                    <a href="delete_task.php?id=<?php echo $task['id']?>" class="btn-icon" title="Eliminar" onclick="return confirm('¿Borrar nota?');">
                        <span class="material-symbols-outlined">delete</span>
                    </a>
                </div>
            </div>

            <?php
        }
    }
}
?>

</body>
</html>