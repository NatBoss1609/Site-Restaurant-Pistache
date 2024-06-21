<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nombrePersonnes = $_POST["nombre_personnes"];
    $heureArrivee = $_POST["heure_arrivee"];
    $intolerances = $_POST["intolerances"];

    // Adresse e-mail de destination
    $destinataire = "nathanprofessionnel1609@gmail.com";

    // Sujet de l'e-mail
    $sujet = "Nouvelle réservation";

    // Construction du message
    $message = "Nombre de personnes : " . $nombrePersonnes . "\n";
    $message .= "Heure d'arrivée : " . $heureArrivee . "\n";
    $message .= "Intolérances alimentaires : " . $intolerances;

    // Envoi de l'e-mail
    if (mail($destinataire, $sujet, $message)) {
        // Message de succès si l'e-mail est envoyé avec succès
        echo "Merci ! Votre réservation a été envoyée.";
    } else {
        // Message d'erreur si l'e-mail n'est pas envoyé
        echo "Désolé, une erreur s'est produite. Veuillez réessayer plus tard.";
    }
} else {
    // Redirection si le formulaire n'est pas soumis par la méthode POST
    header("Location: index.php");
}
?>