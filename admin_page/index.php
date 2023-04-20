<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CDN BOOSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>Page_Admin</title>

</head>

<body>
  <?php
  $dossier = __DIR__;
  $fichier = '/include/header/header_index.php';
  if (file_exists($dossier . $fichier)) {
    require_once($dossier . $fichier);
  } else {
    echo "Le fichier $fichier n'a pas été trouvé pas";
  }
  ?>
  <br>
  <br>
  <h1>Admin</h1>
  <a href="logout.php" class="btn btn-danger">Déconnexion</a>
  <?php
  $dossier = __DIR__;
  $fichier = '/include/footer.php';
  if (file_exists($dossier . $fichier)) {
    require_once($dossier . $fichier);
  } else {
    echo "Le fichier $fichier n'a pas été trouvé pas";
  }
  ?>
  <!-- CDN BOOSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

</body>

</html>