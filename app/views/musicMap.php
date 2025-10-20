<?php
include '../includes/header.php';
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<link rel="stylesheet" href="/musictify/app/css/map.css" />
<div class="wrapper">
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-dark">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
			<li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Mapa Musical</a></li>
		</ul>
		<form class="form-inline ml-3 w-50">
			<div class="input-group input-group-sm w-100">
				<input id="search-input" class="form-control form-control-navbar bg-dark text-white" type="search" placeholder="Buscar país..." aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-navbar btn-dark" type="button" id="search-btn"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</form>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item"><a class="nav-link" href="#" id="btn-home"><i class="fas fa-home"></i></a></li>
		</ul>
	</nav>
	<!-- Sidebar (minimal for map page) -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<a href="#" class="brand-link">
			<i class="fas fa-headphones-alt ml-3"></i>
			<span class="brand-text font-weight-light ml-2">MusicPlata</span>
		</a>
		<div class="sidebar">
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column">
					<li class="nav-item"><a href="#" class="nav-link active"><i class="nav-icon fas fa-globe"></i><p>Mapa</p></a></li>
					<li class="nav-item"><a href="../../index.php" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Home</p></a></li>
					<li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-search"></i><p>Explorar</p></a></li>
				</ul>
			</nav>
		</div>
	</aside>
	<!-- Content -->
	<div class="content-wrapper">
		<div class="content p-0">
			<div id="map"></div>
			<!-- side panel -->
			<div id="side-panel" aria-hidden="true">
				<div id="panel-content">
					<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
						<div>
							<h5 id="panel-title" style="margin:0">Clique em um país</h5>
							<div class="small-muted">Veja o que está tocando, rádios e playlists</div>
						</div>
						<div>
							<button class="btn btn-sm btn-outline-light" id="btn-close-panel"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<input id="country-search" class="form-control bg-dark text-white" placeholder="Pesquisar país (ex: Brazil, United States)" />
					<div id="panel-body">
						<div class="panel-card">
							<div class="muted">Nenhuma seleção</div>
							<div class="mt-2 small-muted">Clique em um país no mapa ou use a busca.</div>
						</div>
					</div> <!-- panel-body -->
				</div>
			</div>
		</div>
	</div>
	<!-- footer player (simple) -->
	<div class="player-footer">
		<div style="display:flex;align-items:center;gap:12px;">
			<img id="player-art" src="https://picsum.photos/seed/p/60/60" style="width:60px;height:60px;border-radius:6px;object-fit:cover">
			<div>
				<div id="player-title" style="font-weight:700">Nenhuma faixa selecionada</div>
				<div id="player-artist" class="muted" style="font-size:13px">—</div>
			</div>
		</div>
		<div style="flex:1;text-align:center;">
			<small class="muted">Mapa Musical — clique em um país para ver conteúdo local</small>
		</div>
		<div style="width:180px;text-align:right;">
			<button class="btn btn-sm btn-outline-light" id="btn-center-world"><i class="fa fa-globe"></i> Centralizar</button>
		</div>
	</div>
</div>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script src="/musictify/app/scripts/map.js"></script>
<?php include '../includes/footer.php'; ?>
