<div id="music-map" style="height:500px;border-radius:16px;overflow:hidden;">
  <!-- Leaflet.js será inicializado aqui -->
</div>
<script>
  // Exemplo de inicialização do mapa Leaflet
  document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('music-map').setView([-14.2350, -51.9253], 4); // Brasil
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data © OpenStreetMap contributors',
      maxZoom: 18,
    }).addTo(map);
    // Exemplo: adicionar seleção de estados
    // (Para produção, usar GeoJSON dos estados e eventos de clique)
  });
</script>
