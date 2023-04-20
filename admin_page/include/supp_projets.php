<?php

// Include header
$dossier = __DIR__;
$fichier = '/header/header_projets.php';
if (file_exists($dossier . $fichier)) {
    require_once($dossier . $fichier);
} else {
    echo "Le fichier $fichier n'a pas été trouvé pas";
}
$query = "SELECT id, titre, description FROM projets";
$result = $db->query($query);


echo "<br><br>";
echo "<h1>Supprimer projet</h1>";

if ($result) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $title = $row['titre'];
        $description = $row['description'];

        echo "<li>";
        echo "<h3>id = $id</h3>";
        echo "<h4>titre = $title</h3>";
        echo "<p>descrption = $description</p>";
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='project_id' value='$id'>";
        echo "<button type='submit' name='delete_project'>Supprimer</button>";
        echo "</form>";

        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucun projet trouvé";
}

if (isset($_POST['delete_project']) && isset($_POST['project_id'])) {
    $db = new mysqli('localhost', 'root', '', 'portfolio');
    if ($db->connect_errno) {
        echo "Failed to connect to MySQL: " . $db->connect_error;
        exit();
    }

    $project_id = $_POST['project_id'];
    echo "projets_id = $project_id";
    $query = "DELETE FROM projets WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $project_id);
    $result = $stmt->execute();
    exit();
}
