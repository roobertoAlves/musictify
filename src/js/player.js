// Swiper.js para músicas relacionadas
const relatedSwiper = new Swiper('#related-swiper', {
  slidesPerView: 3,
  spaceBetween: 16,
  loop: true,
});

// VanillaTilt para cards
VanillaTilt.init(document.querySelectorAll('[data-tilt]'), {
  max: 12,
  speed: 400,
  glare: true,
  'max-glare': 0.2
});

// OverlayScrollbars para abas e letras
OverlayScrollbars(document.querySelectorAll('.tab-content'), {});

// GSAP animações de entrada
gsap.from('.album-art', {opacity:0, scale:0.8, duration:1});
gsap.from('.player-controls button', {opacity:0, y:20, duration:0.8, stagger:0.1});

// Controles do player (exemplo)
$('.btn-play').on('click', function(){
  $(this).toggleClass('playing');
  // Integrar lógica de reprodução
});
// Abas interativas
$('#playerTabs a').on('click', function(e){
  e.preventDefault();
  $(this).tab('show');
});