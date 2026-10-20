<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "laboratorio_fs2";

$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Configurar charset
$conn->set_charset("utf8mb4");
?>