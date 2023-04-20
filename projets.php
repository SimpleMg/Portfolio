<style>
  .carousel img {
    width: 45%;
    height: auto;
    object-fit: cover;
    border-radius: 15px;
  }

  .carousel-item {
    position: relative;
  }

  .carousel-caption {
    position: absolute;
    top: 90%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 45%;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    padding: 15px;
  }

  .carousel-caption h5 {
    font-size: 24px;
    font-weight: bold;
  }

  .carousel-caption p {
    font-size: 18px;
  }
</style>
</head>

<body>
  <?php
  $db = new mysqli('localhost', 'root', '', 'portfolio');
  if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
  }
  ?>
  <?php
  $query = "SELECT * FROM projets";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result();
  $projects = $result->fetch_all(MYSQLI_ASSOC);
  ?>
  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
      <?php foreach ($projects as $index => $project) : ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $index ?>" <?= $index == 0 ? 'class="active" aria-current="true"' : '' ?> aria-label="Slide <?= $index + 1 ?>"></button>
      <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
      <?php foreach ($projects as $index => $project) : ?>
        <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
          <img src="<?= $project["img"] ?>" class="d-block mx-auto" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5><?= $project["titre"] ?></h5>
            <p><?= $project["description"] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
