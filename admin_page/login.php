<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CDN BOOSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>login_admin</title>
</head>

<body>
  <?php
  session_start();

  function cleanInput($input)
  {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  }

  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
  $csrf_token = $_SESSION['csrf_token'];

  const ERROR_REQUIRED = 'Le champ %s est requis';
  const ERROR_LENGTH_NAME = 'Votre nom doit faire entre 2 et 10 caractères';
  const ERROR_INVALID_CSRF_TOKEN = 'Token CSRF invalide';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
      $errors['csrf_token'] = ERROR_INVALID_CSRF_TOKEN;
    } else {
      $username = $_POST['username'] ?? null;
      $password = $_POST['password'] ?? null;
      $username = cleanInput($username);
      $password = cleanInput($password);
      $errors = [];
      if (empty($username)) {
        $errors['username'] = ERROR_REQUIRED;
      } elseif (strlen($username) < 2 || strlen($username) > 10) {
        $errors['username'] = ERROR_LENGTH_NAME;
      }
      if (empty($password)) {
        $errors['password'] = ERROR_REQUIRED;
      }
      if (empty($errors)) {
        $dossier = __DIR__;
        $db = new mysqli('localhost', 'root', '', 'portfolio');
        if ($db->connect_errno) {
          echo "Failed to connect to MySQL: " . $db->connect_error;
          exit();
        }
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $query = "SELECT * FROM admin WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user && password_verify($password, $user['passwordH'])) {
          $_SESSION['login'] = true;
          $_SESSION['user'] = $user;
          header('Location: index.php');
          exit();
        } else {
          $errors['password'] = 'Nom d\'utilisateur ou mot de passe incorrect';
        }
        $db->close();
      }
    }
  }

  ?>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-primary text-white text-center">
            <h3>Connexion Admin</h3>
          </div>
          <div class="card-body">
            <form action="login.php" method="POST">
              <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
              <?= !empty($errors['csrf_token']) ? "<span style='color: red;'>" . $errors['csrf_token'] . "</span>" : "" ?>
              <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" required>
                <?= !empty($errors['username']) ? "<span style='color: red;'>" . $errors['username'] . "</span>" : "" ?>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <?= !empty($errors['password']) ? "<span style='color: red;'>" . $errors['password'] . "</span>" : "" ?>
              </div>
              <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CDN BOOSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

</body>

</html>