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
  <title>Musictify — Home</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <link rel="stylesheet" href="/src/css/custom.css"/>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid mb-4">
        <?php include_once __DIR__ . '/../includes/mood-selector.php'; ?>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-custom mb-3 p-3">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">Recomendações para você</h5>
                <div>
                  <button class="btn btn-sm btn-outline-light" id="rec-prev"><i class="fa fa-chevron-left"></i></button>
                  <button class="btn btn-sm btn-outline-light" id="rec-next"><i class="fa fa-chevron-right"></i></button>
                </div>
              </div>
              <div class="swiper-container" id="rec-swiper">
                <div class="swiper-wrapper">
                  <?php include_once __DIR__ . '/../includes/card-playlist.php'; ?>
                  <?php include_once __DIR__ . '/../includes/card-playlist.php'; ?>
                  <?php include_once __DIR__ . '/../includes/card-playlist.php'; ?>
                </div>
              </div>
            </div>
            <?php include_once __DIR__ . '/../includes/social-feed.php'; ?>
            <?php include_once __DIR__ . '/../includes/creator-area.php'; ?>
          </div>
          <div class="col-md-4">
            <?php include_once __DIR__ . '/../includes/assistant-ia.php'; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
