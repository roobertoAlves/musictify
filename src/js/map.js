// Inicialização do mapa Leaflet
var map = L.map('music-map').setView([-14.2350, -51.9253], 4);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: 'Map data © OpenStreetMap contributors',
  maxZoom: 18,
}).addTo(map);
// Exemplo: seleção de estados (GeoJSON pode ser integrado)
// OverlayScrollbars para abas
OverlayScrollbars(document.querySelectorAll('.tab-content'), {});
// GSAP animação de entrada
gsap.from('#music-map', {opacity:0, y:40, duration:1});
// Abas interativas
$('#mapTabs a').on('click', function(e){
  e.preventDefault();
  $(this).tab('show');
});