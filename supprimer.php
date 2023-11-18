<?php

$serveur = "localhost";
$nomUtilisateur = "root";
$motDePasse = "";
$nomBaseDeDonnees = "dataware";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['idMembre'])) {
        $idMembre = $_POST['idMembre'];
        $query = $connexion->prepare("DELETE FROM membre WHERE ID_Membre = :idMembre");
        $query->bindParam(':idMembre', $idMembre);
    } elseif (isset($_POST['idEquipe'])) {
        $idEquipe = $_POST['idEquipe'];
        $query = $connexion->prepare("DELETE FROM equipe WHERE ID_Equipe = :idEquipe");
        $query->bindParam(':idEquipe', $idEquipe);
    }

    $query->execute();

    header("Location: index.php"); // Redirect to your main page after deletion
} catch (PDOException $e) {
    echo "Erreur de suppression : " . $e->getMessage();
}
?>
