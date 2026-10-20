const apiUrl =
"http://localhost/laboratorio_fs2/interfaz/servicios_web.php";
function buscarVideos() {
 fetch(apiUrl)
 .then(response => response.json())
 .then(resultado => {
 const contenedor = document.getElementById("contenedor");
 const boton = document.getElementById("btn-buscar-videos");
 boton.style.display = "none";
 contenedor.style.display = "block";
 contenedor.innerHTML = "";
 if (!resultado.ok) {
 contenedor.innerHTML = "<p class='error'>No se pudieron obtener los datos.</p>";
 return;
 }
 if (resultado.data.length === 0) {
 contenedor.innerHTML = "<p>No hay videos cargados.</p>";
 return;
 }
 resultado.data.forEach(video => {
 const card = document.createElement("div");
 card.className = "video-card";
 card.innerHTML = `
 <h3>${video.titulo}</h3>

 <span><strong>URL original:</strong></span>
 <span class="url">${video.url}</span>
 <br>
 <span><strong>URL embebed:</strong></span>
 <span class="url">${video.url_embed}</span>

 <br>
 ${
 video.url_embed
 ? `<iframe src="${video.url_embed}"
allowfullscreen></iframe>`
 : `<p class="error">La URL no pudo convertirse a
formato embebible.</p>`
 }
 `;
 contenedor.appendChild(card);
 });
 })
 .catch(error => {
 console.error("Error:", error);
 contenedor.style.display = "block";
 document.getElementById("contenedor").innerHTML =
 "<p class='error'>Ocurrió un error al conectar con la API.</p>";
 });
}