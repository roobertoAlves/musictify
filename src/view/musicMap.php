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
  <title>Musictify — Mapa Musical</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="/src/css/map.css"/>
  <link rel="stylesheet" href="/src/css/custom.css"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <div class="container mt-5">
      <h2 class="text-light mb-4">Mapa Musical Interativo</h2>
      <?php include_once __DIR__ . '/../includes/music-map.php'; ?>
      <div class="card card-custom p-3 mt-4">
        <ul class="nav nav-tabs" id="mapTabs" role="tablist">
          <li class="nav-item"><a class="nav-link active" id="radios-tab" data-toggle="tab" href="#radios" role="tab">Rádios</a></li>
          <li class="nav-item"><a class="nav-link" id="playlists-tab" data-toggle="tab" href="#playlists" role="tab">Playlists</a></li>
          <li class="nav-item"><a class="nav-link" id="artists-tab" data-toggle="tab" href="#artists" role="tab">Artistas</a></li>
        </ul>
        <div class="tab-content" id="mapTabsContent">
          <div class="tab-pane fade show active" id="radios" role="tabpanel">Rádios em alta...</div>
          <div class="tab-pane fade" id="playlists" role="tabpanel">Playlists culturais...</div>
          <div class="tab-pane fade" id="artists" role="tabpanel">Artistas emergentes...</div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
