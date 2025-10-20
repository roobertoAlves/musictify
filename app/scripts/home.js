
// Carrosséis mockados de YouTube/Spotify
const MOCK_YOUTUBE = [
  {
    title: 'Shape of You',
    artist: 'Ed Sheeran',
    cover: 'https://i.ytimg.com/vi/JGwWNGJdvx8/hqdefault.jpg',
    url: 'https://www.youtube.com/watch?v=JGwWNGJdvx8'
  },
  {
    title: 'Blinding Lights',
    artist: 'The Weeknd',
    cover: 'https://i.ytimg.com/vi/4NRXx6U8ABQ/hqdefault.jpg',
    url: 'https://www.youtube.com/watch?v=4NRXx6U8ABQ'
  },
  {
    title: 'Levitating',
    artist: 'Dua Lipa',
    cover: 'https://i.ytimg.com/vi/TUVcZfQe-Kw/hqdefault.jpg',
    url: 'https://www.youtube.com/watch?v=TUVcZfQe-Kw'
  },
  {
    title: 'Peaches',
    artist: 'Justin Bieber',
    cover: 'https://i.ytimg.com/vi/tQ0yjYUFKAE/hqdefault.jpg',
    url: 'https://www.youtube.com/watch?v=tQ0yjYUFKAE'
  },
  {
    title: 'drivers license',
    artist: 'Olivia Rodrigo',
    cover: 'https://i.ytimg.com/vi/ZmDBbnmKpqQ/hqdefault.jpg',
    url: 'https://www.youtube.com/watch?v=ZmDBbnmKpqQ'
  }
];

const MOCK_SPOTIFY = [
  {
    title: 'Top Hits Brasil',
    artist: 'Spotify',
    cover: 'https://i.scdn.co/image/ab67706f00000002c4e3e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6',
    url: 'https://open.spotify.com/playlist/37i9dQZF1DXcBWIGoYBM5M'
  },
  {
    title: 'Pop Up',
    artist: 'Spotify',
    cover: 'https://i.scdn.co/image/ab67706f00000002b4e3e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6',
    url: 'https://open.spotify.com/playlist/37i9dQZF1DX1lVhptIYRda'
  },
  {
    title: 'Viral Hits',
    artist: 'Spotify',
    cover: 'https://i.scdn.co/image/ab67706f00000002a4e3e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6',
    url: 'https://open.spotify.com/playlist/37i9dQZF1DXcZDD7cfEKhW'
  }
];

document.addEventListener('DOMContentLoaded', function() {
  loadRecomendacoes();
  loadAmigos();
  loadArtistaDestaque();
});

function loadRecomendacoes() {
  const wrapper = document.querySelector('#swiper-recomendacoes .swiper-wrapper');
  if (!wrapper) return;
  wrapper.innerHTML = MOCK_YOUTUBE.map(music => `
    <div class="swiper-slide">
      <div class="card card-music">
        <img src="${music.cover}" class="card-img-top" alt="${escapeHtml(music.title)}">
        <div class="card-body">
          <h6 class="card-title">${escapeHtml(music.title)}</h6>
          <p class="card-text small-muted">${escapeHtml(music.artist)}</p>
          <a href="${music.url}" target="_blank" class="btn btn-success btn-sm">YouTube</a>
        </div>
      </div>
    </div>
  `).join('');
}

function loadAmigos() {
  const wrapper = document.querySelector('#swiper-amigos .swiper-wrapper');
  if (!wrapper) return;
  wrapper.innerHTML = MOCK_SPOTIFY.map(music => `
    <div class="swiper-slide">
      <div class="card card-music">
        <img src="${music.cover}" class="card-img-top" alt="${escapeHtml(music.title)}">
        <div class="card-body">
          <h6 class="card-title">${escapeHtml(music.title)}</h6>
          <p class="card-text small-muted">${escapeHtml(music.artist)}</p>
          <a href="${music.url}" target="_blank" class="btn btn-success btn-sm">Spotify</a>
        </div>
      </div>
    </div>
  `).join('');
}

function loadArtistaDestaque() {
  const el = document.getElementById('artista-destaque');
  if (el) {
    el.innerHTML = `
      <img src="https://i.ytimg.com/vi/JGwWNGJdvx8/hqdefault.jpg" class="mb-2" style="width:100px;height:100px;border-radius:50%"><br>
      <b>Ed Sheeran</b><br>
      <span class="small-muted">Shape of You</span>
    `;
  }
  function loadArtistaDestaque() {
    const el = document.getElementById('artista-destaque');
    if (el) {
      el.innerHTML = `
        <div class="music-card" style="width:100%;max-width:220px;margin:auto;cursor:pointer;">
          <img src="https://i.ytimg.com/vi/JGwWNGJdvx8/hqdefault.jpg" class="card-img-top" alt="Ed Sheeran">
          <div class="card-body">
            <h6 class="card-title">Shape of You</h6>
            <p class="card-text small-muted">Ed Sheeran</p>
            <button class="btn btn-success btn-sm btn-play-artista">Tocar</button>
          </div>
        </div>
      `;
      el.querySelector('.btn-play-artista').addEventListener('click', function(e) {
        e.preventDefault();
        playInFooter({
          title: 'Shape of You',
          artist: 'Ed Sheeran',
          art: 'https://i.ytimg.com/vi/JGwWNGJdvx8/hqdefault.jpg',
          src: 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3'
        });
      });
    }
  }
}

function escapeHtml(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }