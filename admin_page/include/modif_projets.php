<?php
$dossier = __DIR__;
$fichier = '/header/header_projets.php';
if (file_exists($dossier . $fichier)) {
    require_once($dossier . $fichier);
} else {
    echo "Le fichier $fichier n'a pas été trouvé pas";
}
?>
<br>
<br>
<?php
$query = "SELECT id, titre, description, img FROM projets";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$projects = $result->fetch_all(MYSQLI_ASSOC);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = cleanInput($_POST["id"]);
        $titre = cleanInput($_POST["titre"]);
        $description = cleanInput($_POST["description"]);
        $img = cleanInput($_POST["img"]);
        $id = mysqli_real_escape_string($db, $_POST["id"]);
        $titre = mysqli_real_escape_string($db, $_POST["titre"]);
        $description = mysqli_real_escape_string($db, $_POST["description"]);
        $img = mysqli_real_escape_string($db, $_POST["img"]);
        $query = "UPDATE projets SET titre = ?, description = ?, img = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssi', $titre, $description, $img, $id);
        $stmt->execute();
    }
}

?>
<?php foreach ($projects as $project) : ?>
    <h1>Modifier le projet: <?= $project['titre'] ?></h1>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $project['id'] ?>">
        <div class="mb-3">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?= $project['titre'] ?>">
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="<?= $project['description'] ?>">
        </div>
        <div class="mb-3">
            <label for="img">Image</label>
            <input type="text" name="img" id="img" value="<?= $project['img'] ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-10">Modifier Projet</button>
    </form>
    <hr>
<?php endforeach; ?>