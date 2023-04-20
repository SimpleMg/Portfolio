<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CDN BOOSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
  <title>Portfolio</title>
</head>

<body onload="brython();">
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      brython({
        debug: 1,
        ipy_id: ["snake_game_script"]
      });
    });
  </script>
  <style>
    body {
      background-color: #0d0d0d;
      color: #32cd32;
      font-family: "Roboto", sans-serif;
      font-weight: 400;
    }

    .navbar {
      background-color: #1a1a1a;
    }

    .navbar-brand,
    .nav-link {
      color: #32cd32 !important;
    }

    .nav-link:hover {
      color: #50e050 !important;
    }

    .nav-link.active {
      font-weight: bold;
    }

    h1 {
      font-size: 3rem;
      text-shadow: 0 0 10px #32cd32, 0 0 20px #32cd32, 0 0 30px #32cd32, 0 0 40px #32cd32, 0 0 70px #32cd32, 0 0 80px #32cd32, 0 0 100px #32cd32, 0 0 150px #32cd32;
    }

    code,
    pre {
      background-color: #1e1e1e;
      color: #32cd32;
      padding: 5px;
      border-radius: 4px;
    }

    a {
      color: #32cd32;
      text-decoration: none;
      transition: color 0.3s;
    }

    a:hover {
      color: #50e050;
    }

    section {
      margin-top: 200px;
      margin-bottom: 200px;
    }

    section:not(:first-child) {
      margin-top: 0px;
    }

    @media (max-width: 767px) {
      #jeux_ref {
        display: none;
      }
    }
  </style>
  <!-- php dossier -->
  <?php
  $dossier = __DIR__;
  $db = new mysqli('localhost', 'root', '', 'portfolio');
  if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
  }
  function cleanInput($input)
  {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  }
  ?>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <?php
        $query = "SELECT * FROM titre";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $titre = $result->fetch_assoc();
        echo $titre['titre'];
        ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#acceuil_ref">acceuil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#cv_ref">cv</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#projets_ref">projets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#jeux_ref">jeux</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact_ref">contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- FIN NAVBAR -->
  <!-- Acceuil -->
  <!-- Video -->
  <?php
  $query = "SELECT * FROM video";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result();
  $titre = $result->fetch_assoc();
  ?>
  <section id="acceuil_ref">
    <div class="video-wrapper">
      <video width="100%" playsinline autoplay muted loop>
        <source src="<?= $titre['video'] ?>">Votre navigateur ne supporte pas le player vidéo
      </video>
    </div>
  </section>
  <!-- CV -->
  <section class="container-fluid" id="cv_ref">
    <?php
    $fichier = '/cv.php';
    if (file_exists($dossier . $fichier)) {
      require_once($dossier . $fichier);
    } else {
      echo "Le fichier $fichier n'a pas été trouvé pas";
    }
    ?>

  </section>
  <!-- projets -->
  <section class="container-fluid" id="projets_ref">
    <?php
    $fichier = '/projets.php';
    if (file_exists($dossier . $fichier)) {
      require_once($dossier . $fichier);
    } else {
      echo "Le fichier $fichier n'a pas été trouvé pas";
    }
    ?>
  </section>
  <!-- jeux -->
  <section class="container-fluid" id="jeux_ref">
    <?php
    $fichier = '/jeux.php';
    if (file_exists($dossier . $fichier)) {
      require_once($dossier . $fichier);
    } else {
      echo "Le fichier $fichier n'a pas été trouvé pas";
    }
    ?>
  </section>
  <!-- contact -->
  <section class="container-fluid" id="contact_ref">
    <?php
    $fichier = '/contact.php';
    if (file_exists($dossier . $fichier)) {
      require_once($dossier . $fichier);
    } else {
      echo "Le fichier $fichier n'a pas été trouvé pas";
    }
    ?>
  </section>
  <!-- CDN BOOSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Brython Js -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/brython@3.11.0/brython.min.js">
  </script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/brython@3.11.0/brython_stdlib.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
</body>
<!-- Footer -->
<footer class="bg-dark text-center text-lg-start">
  <div class="container p-4">
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">À propos</h5>
        <p>
          Pour me contacter n'hésitez pas à me laisser un message sur le formulaire de contact.
        </p>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Liens utiles</h5>
        <ul class="list-unstyled mb-0">
          <li>
            <a href="#cv_ref" class="text-light">CV</a>
          </li>
          <li>
            <a href="#projets_ref" class="text-light">Projets</a>
          </li>
          <li>
            <a href="#jeux_ref" class="text-light">Jeux</a>
          </li>
          <li>
            <a href="#contact_ref" class="text-light">Contact</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Réseaux sociaux</h5>
        <ul class="list-unstyled mb-0">
          <li>
            <a href="https://www.linkedin.com/in/sam-levy-5bb743252/" class="text-light" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
          </li>
          <li>
            <a href="https://github.com/SimpleMg" class="text-light" target="_blank"><i class="fab fa-github"></i> GitHub</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    &copy; <?= date('Y') ?> Sam Levy - Tous droits réservés.
  </div>
</footer>
<!-- Fin Footer -->

</html>