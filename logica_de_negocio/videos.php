<?php
require_once __DIR__ . "/conexion_bd.php";
/**
* Convierte una URL de YouTube normal en una URL embebible.
* Ej:
* https://www.youtube.com/watch?v=abc123
* ->
* https://www.youtube.com/embed/abc123
*/
function convertirAEmbedUrl($url) {
 $videoId = null;
 // Caso 1: youtube.com/watch?v=VIDEO_ID
 if (preg_match('/[?&]v=([^&]+)/', $url, $matches)) {
 $videoId = $matches[1];
 }
 // Caso 2: youtu.be/VIDEO_ID
 if (!$videoId && preg_match('#youtu\.be/([^?&]+)#', $url, $matches))
{
 $videoId = $matches[1];
 }
 if ($videoId) {
 return "https://www.youtube.com/embed/" . $videoId;
 }
 return null;
}
/**
* Obtiene todos los videos de la base.
*/
function obtenerVideos() {
 global $conn;
 $sql = "SELECT id, titulo, url FROM videos";
 $resultado = $conn->query($sql);
 $videos = [];
 if ($resultado && $resultado->num_rows > 0) {
 while ($fila = $resultado->fetch_assoc()) {
 $fila["url_embed"] = convertirAEmbedUrl($fila["url"]);
 $videos[] = $fila;
 }
 }
 return $videos;
}