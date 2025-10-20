<?php
include 'app/includes/header.php';
?>
<div class="wrapper">
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-dark">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
			<li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Início</a></li>
		</ul>
		<form class="form-inline ml-3 w-50">
			<div class="input-group input-group-sm w-100">
				<input class="form-control form-control-navbar bg-dark" type="search" placeholder="Buscar música, artista, playlist..." aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-navbar btn-dark" type="submit"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</form>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="#" id="btn-notifs"><i class="far fa-bell"></i><span class="badge badge-danger navbar-badge" id="notif-count">3</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#"><i class="fas fa-user-circle"></i></a>
			</li>
		</ul>
	</nav>
	<!-- Sidebar -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<a href="#" class="brand-link">
			<i class="fas fa-headphones-alt ml-3"></i>
			<span class="brand-text font-weight-light ml-2">Musictify</span>
		</a>
		<div class="sidebar">
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
					  <li class="nav-item"><a href="index.php" class="nav-link active"><i class="nav-icon fas fa-home"></i><p>Home</p></a></li>
					  <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-search"></i><p>Explorar</p></a></li>
					  <li class="nav-item"><a href="app/views/musicMap.php" class="nav-link"><i class="nav-icon fas fa-globe"></i><p>Mapa Musical</p></a></li>
					  <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-compact-disc"></i><p>Minhas Músicas</p></a></li>
					  <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-wallet"></i><p>Renda / Pagamentos</p></a></li>
				</ul>
			</nav>
		</div>
	</aside>
	<!-- Content Wrapper -->
	<div class="content-wrapper">
		<div class="content">
					<!-- Top: Mood Selector -->
					<div class="container-fluid mb-4">
						<div class="card card-custom p-3">
							<div class="d-flex justify-content-between align-items-center">
								<div>
									<h4 class="mb-1">Selecione seu Mood</h4>
									<p class="muted mb-0">Escolha seu estado emocional para personalizar recomendações e o visual da Home.</p>
								</div>
								<div id="mood-selector">
									<button class="mood-btn" data-mood="feliz"><i class="fa-solid fa-face-smile mr-2"></i> Feliz</button>
									<button class="mood-btn" data-mood="triste"><i class="fa-solid fa-face-sad-tear mr-2"></i> Triste</button>
									<button class="mood-btn" data-mood="raiva"><i class="fa-solid fa-face-angry mr-2"></i> Raiva</button>
									<button class="mood-btn" data-mood="reflexivo"><i class="fa-solid fa-face-meh mr-2"></i> Reflexivo</button>
									<button class="mood-btn" data-mood="animado"><i class="fa-solid fa-face-grin-hearts mr-2"></i> Animado</button>
									<button class="mood-btn" data-mood="tedio"><i class="fa-solid fa-face-rolling-eyes mr-2"></i> Tédio</button>
									<button class="mood-btn" id="btn-voice" title="Modo por voz"><i class="fa-solid fa-microphone"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Carrossel de Recomendações -->
					<div class="container-fluid px-2">
						<div class="row">
							<div class="col-lg-8 col-md-12">
								<div class="card card-custom mb-4">
									<h5 class="p-3">Recomendações para você</h5>
									<div class="swiper-container" id="swiper-recomendacoes">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<div class="music-card">
													<img src="https://i.ytimg.com/vi/JGwWNGJdvx8/hqdefault.jpg" class="card-img-top" alt="Shape of You">
													<div class="card-body">
														<h6 class="card-title">Shape of You</h6>
														<p class="card-text small-muted">Ed Sheeran</p>
														<button class="btn btn-success btn-sm btn-play-music">Tocar</button>
													</div>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="music-card">
													<img src="https://i.ytimg.com/vi/4NRXx6U8ABQ/hqdefault.jpg" class="card-img-top" alt="Blinding Lights">
													<div class="card-body">
														<h6 class="card-title">Blinding Lights</h6>
														<p class="card-text small-muted">The Weeknd</p>
														<button class="btn btn-success btn-sm btn-play-music">Tocar</button>
													</div>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="music-card">
													<img src="https://i.ytimg.com/vi/TUVcZfQe-Kw/hqdefault.jpg" class="card-img-top" alt="Levitating">
													<div class="card-body">
														<h6 class="card-title">Levitating</h6>
														<p class="card-text small-muted">Dua Lipa</p>
														<button class="btn btn-success btn-sm btn-play-music">Tocar</button>
													</div>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="music-card">
													<img src="https://i.ytimg.com/vi/tQ0yjYUFKAE/hqdefault.jpg" class="card-img-top" alt="Peaches">
													<div class="card-body">
														<h6 class="card-title">Peaches</h6>
														<p class="card-text small-muted">Justin Bieber</p>
														<button class="btn btn-success btn-sm btn-play-music">Tocar</button>
													</div>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="music-card">
													<img src="https://i.ytimg.com/vi/ZmDBbnmKpqQ/hqdefault.jpg" class="card-img-top" alt="drivers license">
													<div class="card-body">
														<h6 class="card-title">drivers license</h6>
														<p class="card-text small-muted">Olivia Rodrigo</p>
														<button class="btn btn-success btn-sm btn-play-music">Tocar</button>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-button-next"></div>
										<div class="swiper-button-prev"></div>
									</div>
								</div>
								<div class="card card-custom mb-4">
									<h5 class="p-3">O que seus amigos estão ouvindo</h5>
									<div class="swiper-container" id="swiper-amigos">
										<div class="swiper-wrapper">
											<div class="swiper-slide">
												<div class="music-card">
													<img src="https://i.scdn.co/image/ab67706f00000002c4e3e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6" class="card-img-top" alt="Top Hits Brasil">
													<div class="card-body">
														<h6 class="card-title">Top Hits Brasil</h6>
														<p class="card-text small-muted">Spotify</p>
														<button class="btn btn-success btn-sm btn-play-music-spotify">Tocar</button>
													</div>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="music-card">
													<img src="https://i.scdn.co/image/ab67706f00000002b4e3e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6" class="card-img-top" alt="Pop Up">
													<div class="card-body">
														<h6 class="card-title">Pop Up</h6>
														<p class="card-text small-muted">Spotify</p>
														<button class="btn btn-success btn-sm btn-play-music-spotify">Tocar</button>
													</div>
												</div>
											</div>
											<div class="swiper-slide">
												<div class="music-card">
													<img src="https://i.scdn.co/image/ab67706f00000002a4e3e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6e7e6e8e6" class="card-img-top" alt="Viral Hits">
													<div class="card-body">
														<h6 class="card-title">Viral Hits</h6>
														<p class="card-text small-muted">Spotify</p>
														<button class="btn btn-success btn-sm btn-play-music-spotify">Tocar</button>
													</div>
												</div>
											</div>
										</div>
										<div class="swiper-button-next"></div>
										<div class="swiper-button-prev"></div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-12">
								<div class="card card-custom mb-4">
									<h5 class="p-3">Artista em Destaque</h5>
									<div class="p-3" id="artista-destaque">
										<!-- Dados do artista -->
									</div>
								</div>
								<div class="card card-custom mb-4">
									<h5 class="p-3">Assistente IA</h5>
									<div class="p-3">
										<div id="ia-msg">Olá! Escolha um mood para eu recomendar músicas — ou me pergunte algo.</div>
										<input type="text" class="form-control mt-2" id="ia-input" placeholder="Pergunte ao assistente (ex: 'Sugira algo calmo')">
										<button class="btn btn-primary mt-2" id="ia-enviar">Enviar</button>
									</div>
								</div>
								<div class="card card-custom mb-4">
									<h5 class="p-3">Party Mode</h5>
									<div class="p-3">
										Junte-se a amigos e sincronize
										<button class="btn btn-danger mt-2">Entrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Player fixo -->
					<div class="player-footer">
						<div class="player-left">
							<img src="https://picsum.photos/seed/album/48/48" alt="Capa" style="border-radius:8px;width:48px;height:48px;">
							<div>
								<div id="player-musica">Música Feliz 1</div>
								<div id="player-artista" class="small-muted">Artista A</div>
								<a href="https://www.youtube.com/watch?v=4bf0GW5KQnE&list=RD4bf0GW5KQnE&start_radio=1" target="_blank" class="muted small" style="display:block;margin-top:2px;">YouTube Placeholder</a>
							</div>
						</div>
						<div class="player-cent">
							<button class="btn btn-circle btn-play" id="player-play"><i class="fa fa-play"></i></button>
							<span id="player-current">0:00</span> / <span id="player-total">0:00</span>
						</div>
						<div class="player-right">
							<button class="btn btn-outline-light">Letra</button>
							<button class="btn btn-outline-light"><i class="fa fa-download"></i></button>
						</div>
					</div>
		</div>
	</div>
</div>
<?php
include 'app/includes/footer.php';
?>
