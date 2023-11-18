document.addEventListener("DOMContentLoaded", function () {
    const afficherMembresBtn = document.getElementById("afficherMembres");
    const listeMembres = document.getElementById("listeMembres");

    const afficherEquipesBtn = document.getElementById("afficherEquipes");
    const listeEquipes = document.getElementById("listeEquipes");

    afficherMembresBtn.addEventListener("click", function () {
        listeMembres.classList.toggle("hidden");
    });

    afficherEquipesBtn.addEventListener("click", function () {
        listeEquipes.classList.toggle("hidden");
    });
});

function modifierMembre(idMembre) {
    window.location.href = "modifier.php?id=" + idMembre;
}

let btn = document.getElementById('btn')
window.onscroll=function(){
    if (scrollY>200){
        btn.style.display='flex';
    } else{
        btn.style.display='none';
    }
}
btn.onclick = function(){
    scroll({
        left: 0,
        top: 0,
        behavior: "smooth"
    })
}

function afficherDonneesMembre() {
    var idMembre = document.getElementById('idMembreModifier').value;

    // Faites une requête AJAX pour récupérer les données du membre par son ID
    // Vous pouvez utiliser JavaScript pur, jQuery, ou toute autre bibliothèque de votre choix
    // Assurez-vous que votre script PHP renvoie les données du membre en format JSON

    // Exemple avec jQuery
    $.ajax({
        type: 'POST',
        url: 'recuperer_donnees_membre.php', // Remplacez par le script PHP qui récupère les données du membre
        data: { idMembre: idMembre },
        dataType: 'json',
        success: function (data) {
            // Affichez les données récupérées dans les champs de saisie
            document.getElementById('nomMembre').value = data.nom;
            document.getElementById('prenomMembre').value = data.prenom;

            // Affichez la div contenant les données
            document.getElementById('donneesMembre').style.display = 'block';
        },
        error: function (xhr, status, error) {
            // Gérez les erreurs ici
            console.error(error);
        }
    });
}