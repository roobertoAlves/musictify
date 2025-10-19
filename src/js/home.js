// Swiper.js para carrossel de recomendações
const recSwiper = new Swiper('#rec-swiper', {
  slidesPerView: 4,
  spaceBetween: 24,
  navigation: {
    nextEl: '#rec-next',
    prevEl: '#rec-prev',
  },
  loop: true,
});

// Swiper.js para social feed
const socialSwiper = new Swiper('#social-swiper', {
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

// OverlayScrollbars para feeds e letras
OverlayScrollbars(document.querySelectorAll('.card-custom'), {});

// GSAP animações de entrada
gsap.from('.playlist-card', {opacity:0, y:40, duration:1, stagger:0.1});
gsap.from('.music-card', {opacity:0, y:40, duration:1, stagger:0.1});

// SweetAlert2 para modais do criador
$('#open-mashup').on('click', function(){
  Swal.fire({
    title: 'Mashup Rápido',
    text: 'Combine dois trechos da biblioteca!',
    icon: 'info',
    confirmButtonColor: '#a259ec',
    background: '#23223b',
    color: '#e0e0e0'
  });
});
$('#open-record').on('click', function(){
  Swal.fire({
    title: 'Gravar Trecho',
    text: 'Grave um trecho curto!',
    icon: 'info',
    confirmButtonColor: '#a259ec',
    background: '#23223b',
    color: '#e0e0e0'
  });
});
$('#open-collab').on('click', function(){
  Swal.fire({
    title: 'Playlists Colaborativas',
    text: 'Crie playlists visuais!',
    icon: 'info',
    confirmButtonColor: '#a259ec',
    background: '#23223b',
    color: '#e0e0e0'
  });
});

// Mood selector animação
$('.mood-btn').on('click', function(){
  const mood = $(this).data('mood');
  gsap.to('body', {background: moodBg(mood), duration:1});
  // Recomendações dinâmicas podem ser integradas aqui
});
function moodBg(mood){
  switch(mood){
    case 'feliz': return 'linear-gradient(135deg,#a259ec 0%,#23223b 100%)';
    case 'triste': return 'linear-gradient(135deg,#23223b 0%,#3a2d5c 100%)';
    case 'raiva': return 'linear-gradient(135deg,#ff1744 0%,#23223b 100%)';
    case 'reflexivo': return 'linear-gradient(135deg,#23223b 0%,#6c63ff 100%)';
    case 'animado': return 'linear-gradient(135deg,#ff6f00 0%,#23223b 100%)';
    case 'tedio': return 'linear-gradient(135deg,#23223b 0%,#757575 100%)';
    default: return 'linear-gradient(135deg,#2d0036 0%,#0a0a0a 100%)';
  }
}