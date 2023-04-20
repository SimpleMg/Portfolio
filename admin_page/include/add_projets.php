<?php
$dossier = __DIR__;
$fichier = '/header/header_projets.php';
if (file_exists($dossier . $fichier)) {
    require_once($dossier . $fichier);
} else {
    echo "Le fichier $fichier n'a pas été trouvé pas";
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $titre = cleanInput($_POST["titre"]);
        $description = cleanInput($_POST["description"]);
        $img = cleanInput($_POST["img"]);
        $titre = mysqli_real_escape_string($db, $_POST["titre"]);
        $description = mysqli_real_escape_string($db, $_POST["description"]);
        $img = mysqli_real_escape_string($db, $_POST["img"]);
        $query = "INSERT INTO projets (titre, description, img) VALUES (?,  ?,  ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sss', $titre, $description, $img);
        $stmt->execute();
    }
}
?>
<h1>ajouter un projets</h1>
<form action="" method="POST">
    <input type="hidden" name="id">
    <div class="mb-3">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div class="mb-3">
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
    </div>
    <div class="mb-3">
        <label for="img">Image</label>
        <input type="text" name="img" id="img">
    </div>
    <button type="submit" name="submit" class="btn btn-primary w-10">ajouter Projet</button>
</form>
<?php
$dossier = __DIR__;
$fichier = './footer.php';
if (file_exists($dossier . $fichier)) {
    require_once($dossier . $fichier);
} else {
    echo "Le fichier $fichier n'a pas été trouvé pas";
}
?>