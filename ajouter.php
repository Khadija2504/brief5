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
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ajouter des données de membre
    if (
        isset(
            $_POST['idMember'],
            $_POST['nomMembre'],
            $_POST['prenomMembre'],
            $_POST['emailMembre'],
            $_POST['telephoneMembre'],
            $_POST['roleMembre'],
            $_POST['equipeMembre'],
            $_POST['statutMembre']
        )
    ) {
        $idMembre = $_POST['idMember'];
        $nomMembre = $_POST['nomMembre'];
        $prenomMembre = $_POST['prenomMembre'];
        $emailMembre = $_POST['emailMembre'];
        $telephoneMembre = $_POST['telephoneMembre'];
        $roleMembre = $_POST['roleMembre'];
        $equipeMembre = $_POST['equipeMembre'];
        $statutMembre = $_POST['statutMembre'];

        // Effectuer la logique d'ajout dans la base de données
        $requete = $connexion->prepare(
            "INSERT INTO membre (Id, Nom, Prenom, Email, Telephone, Role, ID_Equipe, Statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $requete->execute([$idMembre, $nomMembre, $prenomMembre, $emailMembre, $telephoneMembre, $roleMembre, $equipeMembre, $statutMembre]);

        // Rediriger ou afficher un message de confirmation
        header('Location: index.php');
        echo 'Membre ajouté avec succès!';
    }

    // Ajouter des données d'équipe
    if (isset($_POST['nomEquipe'], $_POST['idEquipe'], $_POST['dateCreation'])) {
        $nomEquipe = $_POST['nomEquipe'];
        $idEquipe = $_POST['idEquipe'];
        $dateCreation = $_POST['dateCreation'];

        // Effectuer la logique d'ajout dans la base de données pour les équipes
        $requete = $connexion->prepare("INSERT INTO equipe (ID_Equipe, Nom_Equipe, Date_Creation) VALUES (?, ?, ?)");
        $requete->execute([$idEquipe, $nomEquipe, $dateCreation]);

        // Rediriger ou afficher un message de confirmation
        header('Location: index.php');
        echo 'Équipe ajoutée avec succès!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Membre ou Équipe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-row items-center justify-center">

<div class="bg-white p-6 rounded-md shadow-md my-4 mx-auto max-w-2xl">
        <h2 class="text-xl font-semibold mb-4">Ajouter Membre</h2>

        <form action="ajouter.php" method="post" class="space-y-4">
        <label for="idMembre" class="block text-sm font-medium text-gray-700">Id :</label>
            <input type="text" id="idMembre" name="idMembre" class="w-full border p-2 rounded-md">

            <label for="nomMembre" class="block text-sm font-medium text-gray-700">Nom :</label>
            <input type="text" id="nomMembre" name="nomMembre" class="w-full border p-2 rounded-md">

            <label for="prenomMembre" class="block text-sm font-medium text-gray-700">Prénom :</label>
            <input type="text" id="prenomMembre" name="prenomMembre" class="w-full border p-2 rounded-md">

            <label for="emailMembre" class="block text-sm font-medium text-gray-700">Email :</label>
            <input type="email" id="emailMembre" name="emailMembre" class="w-full border p-2 rounded-md">

            <label for="telephoneMembre" class="block text-sm font-medium text-gray-700">Téléphone :</label>
            <input type="tel" id="telephoneMembre" name="telephoneMembre" class="w-full border p-2 rounded-md">

            <label for="roleMembre" class="block text-sm font-medium text-gray-700">Rôle :</label>
            <input type="text" id="roleMembre" name="roleMembre" class="w-full border p-2 rounded-md">

            <label for="equipeMembre" class="block text-sm font-medium text-gray-700">ID Équipe :</label>
            <input type="text" id="equipeMembre" name="equipeMembre" class="w-full border p-2 rounded-md">

            <label for="statutMembre" class="block text-sm font-medium text-gray-700">Statut :</label>
            <input type="text" id="statutMembre" name="statutMembre" class="w-full border p-2 rounded-md">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ajouter Membre</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-md shadow-md my-4 mx-auto max-w-2xl">
        <h2 class="text-xl font-semibold mb-4">Ajouter Équipe</h2>

        <form action="ajouter.php" method="post" class="space-y-4">
            <label for="nomEquipe" class="block text-sm font-medium text-gray-700">Nom Équipe :</label>
            <input type="text" id="nomEquipe" name="nomEquipe" class="w-full border p-2 rounded-md">

            <label for="idEquipe" class="block text-sm font-medium text-gray-700">ID Équipe :</label>
            <input type="text" id="idEquipe" name="idEquipe" class="w-full border p-2 rounded-md">

            <label for="dateCreation" class="block text-sm font-medium text-gray-700">Date de Création :</label>
            <input type="date" id="dateCreation" name="dateCreation" class="w-full border p-2 rounded-md">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ajouter Équipe</button>
        </form>
    </div>

    <script src="app.js"></script>
</body>

</html>
