<?php
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'todo_list';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>