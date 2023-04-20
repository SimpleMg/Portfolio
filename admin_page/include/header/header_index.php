<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
    exit();
}
?>
<?php
function cleanInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

$db = new mysqli('localhost', 'root', '', 'portfolio');
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./include/modif_titre.php">titre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./include/modif_video.php">video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./include/add_projets.php">projets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./include/modif_cv.php">cv</a>
                </li>
            </ul>
        </div>
    </div>
</nav>