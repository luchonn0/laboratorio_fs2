<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
require_once __DIR__ . "/../logica_de_negocio/videos.php";
if ($_SERVER["REQUEST_METHOD"] === "GET") {
 $videos = obtenerVideos();
 echo json_encode([
 "ok" => true,
 "data" => $videos
 ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
 http_response_code(405);
 echo json_encode([
 "ok" => false,
 "mensaje" => "Método no permitido"
 ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>