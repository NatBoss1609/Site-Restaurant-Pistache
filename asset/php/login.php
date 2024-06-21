<?php
session_start(); // Démarrage de la session (si ce n'est pas déjà fait)

// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$basededonnees = "restaurant_pistache";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération des données du formulaire
$email = $_POST['email'];
$mdp = $_POST['mdp'];

// Vérification spécifique pour l'adresse email et le mot de passe
if ($email === 'nathan.decraye@apprenant.ifapme.be' && $mdp === '16Dechno@Code09') {
    // Authentification réussie
    $_SESSION['logged_in'] = true; // Marquer l'utilisateur comme connecté
    // Redirection vers la page de gestion du menu (exemple : gestion_menu.php)
    header("Location: gestion_menu.php");
    exit();
} else {
    // Authentification échouée
    echo "Email ou mot de passe incorrect.";
}

$connexion->close();
?>