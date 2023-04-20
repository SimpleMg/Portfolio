<?php
$dossier = __DIR__;
$fichier = '/header/header_include.php';
if (file_exists($dossier . $fichier)) {
    require_once($dossier . $fichier);
} else {
    echo "Le fichier $fichier n'a pas été trouvé pas";
}
?>
<?php
$query = "SELECT video FROM video";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user) {
    $video = $user["video"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['submit'])) {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $video = cleanInput($_POST["video"]);
        $video = mysqli_real_escape_string($db, $_POST["video"]);
        $query = "UPDATE video SET video = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $video);
        $stmt->execute();
    }
}
?>
<h1>modif video</h1>
<form action="" method="POST">
    <div class="mb-3">
        <label for="video">video</label>
        <input type="text" name="video" id="video" value="<?= $video ?>">
    </div>
    <button type="submit" class="btn btn-primary w-10">Modifier video</button>
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