<?php
$serveur = "localhost";
$nomUtilisateur = "root";
$motDePasse = "";
$nomBaseDeDonnees = "dataware";

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Vérifiez si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérez les données du formulaire
    $idMembre = $_POST["idMembreModifier"];
    $nouveauNom = $_POST["nomMembre"];
    $nouveauPrenom = $_POST["prenomMembre"];
    // Ajoutez d'autres champs selon votre structure

    // Mettez à jour la base de données
    $requete = "UPDATE membre SET Nom = :nom, Prenom = :prenom WHERE ID_Membre = :idMembre";
    $statement = $connexion->prepare($requete);
    $statement->bindParam(":nom", $nouveauNom);
    $statement->bindParam(":prenom", $nouveauPrenom);
    $statement->bindParam(":idMembre", $idMembre);

    try {
        $statement->execute();
        echo "Modification réussie.";
    } catch (PDOException $e) {
        echo "Erreur de modification : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="bg-white p-6 rounded-md shadow-md">
        <h2 class="text-xl font-semibold mb-4">Modification des Membres</h2>

        <form id="formModifierMembre" action="modifier.php" method="post">
            <label for="idMembreModifier">ID Membre :</label>
            <input type="text" id="idMembreModifier" name="idMembreModifier" class="mb-2">
            <button type="button" onclick="afficherDonneesMembre()">Afficher Données</button>

            <!-- La div suivante affichera les données du membre -->
            <div id="donneesMembre" style="display: none;">
                <label for="nomMembre">Nom :</label>
                <input type="text" id="nomMembre" name="nomMembre" class="mb-2">

                <label for="prenomMembre">Prénom :</label>
                <input type="text" id="prenomMembre" name="prenomMembre" class="mb-2">

                <!-- Ajoutez d'autres champs de données du membre selon votre structure -->

                <button type="submit" class="bg-green-500 text-white px-4 py-2">Modifier Membre</button>
            </div>
        </form>
    </div>
    <script src="app.js"></script>

</body>
</html>