<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataWare</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media (max-width: 1075px) {
            table {
                overflow-x: auto;
                display: block;
            }

            th, td {
                min-width: 120px;
            }
        }
    </style>
</head>

<body class="bg-gray-100 h-2000">

    <header class="bg-blue-500 text-white p-4">
        <h1 class="text-2xl font-bold">DataWare Application</h1>
        <?php
            $serveur = "localhost";
            $nomUtilisateur = "root";
            $motDePasse = "";
            $nomBaseDeDonnees = "dataware";

            try {
                $connexion = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connexion réussie";
            } catch (PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }
        ?>
    </header>

    <div id="btn" class="w-10 h-10 bg-blue-500 cursor-pointer fixed bottom-10 right-10 rounded-full items-center justify-center hidden">
        <span class="text-white font-bold">^</span>
    </div>

    <div class="bg-white p-6 rounded-md shadow-md">
        <h2 class="text-xl font-semibold mb-4">Liste des Membres</h2>

        <button id="afficherMembres" class="bg-blue-500 text-white px-4 py-2 mb-4">Afficher Membres</button>

        <div id="listeMembres" class="hidden">
            <?php
            $queryMembre = $connexion->query("SELECT * FROM membre");
            $membres = $queryMembre->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($membres)) {
            ?>
                <table class="min-w-full border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">ID Membre</th>
                            <th class="border border-gray-300 px-4 py-2">Nom</th>
                            <th class="border border-gray-300 px-4 py-2">Prénom</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Téléphone</th>
                            <th class="border border-gray-300 px-4 py-2">Rôle</th>
                            <th class="border border-gray-300 px-4 py-2">ID Équipe</th>
                            <th class="border border-gray-300 px-4 py-2">Statut</th>
                            <th class="border border-gray-300 px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($membres as $membre) { ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $membre['ID_Membre']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $membre['Nom']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $membre['Prenom']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $membre['Email']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $membre['Telephone']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $membre['Role']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $membre['ID_Equipe']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $membre['Statut']; ?></td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <form onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');" action="supprimer.php" method="post">
                                        <input type="hidden" name="idMembre" value="<?php echo $membre['ID_Membre']; ?>">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else {
                echo "<p>Aucun membre trouvé.</p>";
            }
            ?>
        </div>
    </div>

    <div class="bg-white p-6 rounded-md shadow-md">
        <h2 class="text-xl font-semibold mb-4">Liste des Équipes</h2>

        <button id="afficherEquipes" class="bg-blue-500 text-white px-4 py-2 mb-4">Afficher Équipes</button>

        <div id="listeEquipes" class="hidden">
            <?php
            $queryEquipes = $connexion->query("SELECT * FROM equipe");
            $equipes = $queryEquipes->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($equipes)) {
            ?>
                <table class="min-w-full border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">ID Équipe</th>
                            <th class="border border-gray-300 px-4 py-2">Nom Équipe</th>
                            <th class="border border-gray-300 px-4 py-2">Date de Création</th>
                            <th class="border border-gray-300 px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($equipes as $equipe) { ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $equipe['ID_Equipe']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $equipe['Nom_Equipe']; ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo $equipe['Date_Creation']; ?></td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <form onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette équipe ?');" action="supprimer.php" method="post">
                                        <input type="hidden" name="idEquipe" value="<?php echo $equipe['ID_Equipe']; ?>">
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else {
                echo "<p>Aucune équipe trouvée.</p>";
            }
            ?>
        </div>
    </div>

    <div class="container mx-auto mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-md shadow-md">
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

            </div>
            <div class="bg-white p-6 rounded-md shadow-md">
                <!-- Formulaire d'ajout de membre -->

                <!-- Formulaire d'ajout d'équipe -->
                <div class="bg-white p-6 rounded-md shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Ajout d'Équipe et des membres</h2>

                    <form action="ajouter.php" method="post">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Ajouter</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="app.js"></script>

</body>

</html>
