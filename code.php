<?php
if ($_POST) {
    $chemin_fichier_json = 'database.json';

    $email = $_POST['email'];
    $password = $_POST['password'];
// Récupérer les valeurs du formulaire
    switch ($_POST['etat']) {
        case 'inscription':

// Récupérer le contenu du fichier JSON
            $json_contenu = file_get_contents($chemin_fichier_json);
// Décoder le JSON en une structure de données PHP
            $data = json_decode($json_contenu, true);

// Vérifier si la conversion a réussi
            if ($data === null) {
                echo "Échec de la lecture du fichier JSON!!!";
            } else {
                $trouve = false;
                foreach ($data as $element) {
                    if ($element['id'] === $email) {
                        $trouve = true;
                        break;
                    }
                }
                if ($trouve) {
                    echo "Erreur d'inscription : Compte déjà existant!!!";
                } else {
                    // Ajouter une nouvelle entrée au tableau
                    $nouvelle_entree = array("id" => $email, "mdp" => $chaine_base64 = base64_encode($password));
                    array_push($data, $nouvelle_entree);

                    // Encoder le tableau mis à jour en JSON
                    $nouveau_json = json_encode($data, JSON_PRETTY_PRINT);

                    // Écrire les données mises à jour dans le fichier JSON
                    if (file_put_contents($chemin_fichier_json, $nouveau_json)) {
                        echo "Inscription réussie.";
                    } else {
                        echo "Une erreur est survenue lors de l'écriture dans le fichier!!!";
                    }
                }

            }
            break;
        case 'connexion':
            $json_contenu = file_get_contents($chemin_fichier_json);
            $data = json_decode($json_contenu, true);
// Vérifier si la conversion a réussi
            if ($data === null) {
                echo "Échec de la lecture du fichier JSON!!!!";
            } else {
                // Vérifier si l'email et le mot de passe existent déjà
                $trouve = false;
                foreach ($data as $element) {
                    if ($element['id'] === $email && base64_encode($password) === $element['mdp']) {
                        $trouve = true;
                        break;
                    }
                }
                if ($trouve) {
                    echo "Connexion établie avec succès.";
                } else {
                    echo "
                    Échec de connexion!!!";
                }
            }
            break;
    }
}
?>
