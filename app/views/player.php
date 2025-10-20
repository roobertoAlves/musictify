<?php
include '../includes/header.php';
?>
<header>MusicPlata - Player Completo</header>
<main>
	<section class="album-cover" aria-label="Capa do álbum">
		<img id="album-art" src="https://picsum.photos/seed/album/320/320" alt="Capa do Álbum" />
		<div class="album-mood" id="album-mood">Animado</div>
	</section>
	<section class="player-info" aria-label="Informações e controles da música">
		<div class="title-artist">
			<h2 id="track-title">Nome da Música</h2>
			<div class="artist" id="track-artist">Nome do Artista</div>
			<div class="release-date" id="track-date">2025</div>
			<div class="genre" id="track-genre">Pop</div>
		</div>
		<div class="controls" role="group" aria-label="Controles de reprodução">
			<button class="btn-control" id="btn-prev" aria-label="Música anterior"><i class="fa fa-backward"></i></button>
			<button class="btn-control large" id="btn-play" aria-label="Play/Pause"><i class="fa fa-play"></i></button>
			<button class="btn-control" id="btn-next" aria-label="Próxima música"><i class="fa fa-forward"></i></button>
			<button class="btn-control" id="btn-like" aria-label="Curtir"><i class="fa fa-heart"></i></button>
			<button class="btn-control" id="btn-fav" aria-label="Favoritar"><i class="fa fa-star"></i></button>
			<button class="btn-control" id="btn-download" aria-label="Baixar música"><i class="fa fa-download"></i></button>
		</div>
		<div class="progress-container">
			<input type="range" id="progress-bar" class="progress-bar" min="0" max="100" value="0" step="0.1" aria-label="Barra de progresso da música" />
			<div class="time-labels">
				<span id="current-time">0:00</span>
				<span id="total-time">0:00</span>
			</div>
		</div>
		<div class="tabs" role="tabpanel">
			<div class="tab-buttons" role="tablist">
				<button class="tab-button active" role="tab" aria-selected="true" aria-controls="tab-lyrics" id="tab-btn-lyrics">Letra</button>
				<button class="tab-button" role="tab" aria-selected="false" aria-controls="tab-info" id="tab-btn-info">Informações do Artista</button>
				<button class="tab-button" role="tab" aria-selected="false" aria-controls="tab-stats" id="tab-btn-stats">Estatísticas</button>
			</div>
			<div id="tab-lyrics" class="tab-content" role="tabpanel" aria-labelledby="tab-btn-lyrics">
				<pre class="lyrics" id="lyrics-text">Carregando letra...</pre>
			</div>
			<div id="tab-info" class="tab-content" role="tabpanel" aria-labelledby="tab-btn-info" hidden>
				<p id="artist-bio">Carregando informações do artista...</p>
			</div>
			<div id="tab-stats" class="tab-content" role="tabpanel" aria-labelledby="tab-btn-stats" hidden>
				<ul class="stats-list">
					<li id="stat-plays">Reproduções: 0</li>
					<li id="stat-likes">Curtidas: 0</li>
					<li id="stat-rank">Posição no ranking: -</li>
				</ul>
			</div>
		</div>
		<h3 style="margin-top:1rem; font-weight:600; user-select:none;">Músicas Relacionadas</h3>
		<div class="related" aria-label="Músicas relacionadas">
			<!-- cards serão inseridos dinamicamente -->
		</div>
	</section>
</main>
<!-- Modo Festa -->
<div class="party-mode" id="party-mode" aria-label="Modo Festa">
	<h3>Chat do Modo Festa</h3>
	<textarea id="chat-text" placeholder="Digite uma mensagem..." rows="6"></textarea>
	<button class="send-btn" id="send-chat-btn">Enviar</button>
</div>
<footer>
	<button id="toggle-party-btn" aria-pressed="false" aria-label="Ativar Modo Festa">Modo Festa</button>
	<div>MusicPlata © 2025</div>
</footer>
<?php
include '../includes/footer.php';
?>
