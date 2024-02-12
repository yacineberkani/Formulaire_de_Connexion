<?php
// Définit temporairement la configuration pour masquer les avertissements de dépréciation
ini_set('display_errors', 'Off');

session_start();

// Vérification de l'action à effectuer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Connexion à la base de données
    $chemin_fichier_json = 'database.json';
    $data = [];

    // Vérification du type d'action
    if ($action == "inscription") {
        // Récupération des données du formulaire
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Hachage du mot de passe
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Lecture des données existantes
        $data = file_exists($chemin_fichier_json) ? json_decode(file_get_contents($chemin_fichier_json), true) : [];

        // Vérification si l'email existe déjà
        if (isset($data[$email])) {
            echo "Erreur d'inscription : Compte déjà existant!!!";
        } else {
            // Ajout du nouvel utilisateur
            $data[$email] = $password_hash;

            // Écriture des données dans le fichier
            file_put_contents($chemin_fichier_json, json_encode($data));

            echo "Inscription réussie.";
        }
    } elseif ($action == "connexion") {
        // Récupération des données du formulaire
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Lecture des données existantes
        $data = file_exists($chemin_fichier_json) ? json_decode(file_get_contents($chemin_fichier_json), true) : [];

        // Vérification de l'utilisateur
        if (isset($data[$email]) && password_verify($password, $data[$email])) {
            // Affiche un message de connexion réussie sans afficher d'avertissement de dépréciation
            echo "Connexion établie avec succès.";
        } else {
            echo "Échec de connexion!!!";
        }
    } else {
        echo "Action non autorisée!";
    }
} else {
    echo "Méthode de requête non autorisée!";
}
?>
