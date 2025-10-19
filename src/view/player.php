<?php
include_once __DIR__ . '/../includes/header.php';
include_once __DIR__ . '/../includes/navbar.php';
include_once __DIR__ . '/../includes/sidebar.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Musictify — Player</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="/src/css/player.css"/>
  <link rel="stylesheet" href="/src/css/custom.css"/>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-8">
          <div class="card card-custom p-4 mb-4">
            <div class="d-flex flex-column align-items-center">
              <div class="album-art mb-3" style="width:180px;height:180px;background:#3a2d5c;border-radius:16px;"></div>
              <h3 class="track-title text-light">Nome da Música</h3>
              <span class="track-artist text-muted">Artista</span>
              <span class="track-date text-muted">Data de lançamento</span>
              <span class="track-genre text-muted">Gênero/Estilo</span>
              <div class="player-controls mt-3">
                <button class="btn btn-circle btn-play"><i class="fa fa-play"></i></button>
                <button class="btn btn-circle"><i class="fa fa-step-backward"></i></button>
                <button class="btn btn-circle"><i class="fa fa-step-forward"></i></button>
                <button class="btn btn-circle"><i class="fa fa-heart"></i></button>
                <button class="btn btn-circle"><i class="fa fa-download"></i></button>
              </div>
              <div class="progress mt-3" style="width:100%"><div id="progress-bar" style="width:0%"></div></div>
              <div class="d-flex justify-content-between muted small"><span id="time-cur">0:00</span><span id="time-total">0:00</span></div>
            </div>
          </div>
          <div class="card card-custom p-3 mb-4">
            <ul class="nav nav-tabs" id="playerTabs" role="tablist">
              <li class="nav-item"><a class="nav-link active" id="lyrics-tab" data-toggle="tab" href="#lyrics" role="tab">Letra</a></li>
              <li class="nav-item"><a class="nav-link" id="artist-tab" data-toggle="tab" href="#artist" role="tab">Artista</a></li>
              <li class="nav-item"><a class="nav-link" id="stats-tab" data-toggle="tab" href="#stats" role="tab">Estatísticas</a></li>
            </ul>
            <div class="tab-content" id="playerTabsContent">
              <div class="tab-pane fade show active" id="lyrics" role="tabpanel">Letra da música...</div>
              <div class="tab-pane fade" id="artist" role="tabpanel">Biografia resumida do artista...</div>
              <div class="tab-pane fade" id="stats" role="tabpanel">Nº de reproduções, curtidas, ranking...</div>
            </div>
          </div>
          <div class="card card-custom p-3 mb-4">
            <h5>Músicas Relacionadas</h5>
            <div class="swiper-container" id="related-swiper">
              <div class="swiper-wrapper">
                <?php include_once __DIR__ . '/../includes/card-music.php'; ?>
                <?php include_once __DIR__ . '/../includes/card-music.php'; ?>
                <?php include_once __DIR__ . '/../includes/card-music.php'; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-custom p-3 mb-4">
            <h5>Modo Festa</h5>
            <button class="btn btn-outline-light" id="party-mode">Ativar Modo Festa</button>
            <!-- Chat lateral e animações serão integrados -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
