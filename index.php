<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
<div class="hero">
    <div class="form-box">
        <div id="corps">
            <form id="login" class="input-group">
                <input id="email" class="input-field" name="email" placeholder="E-mail" type="email" value="Yacine@berkani.fr" required>
                <input id="password" class="input-field" name="password"  placeholder="Mot de passe" type="password" value="aaa" required>
                <div class="button-box">
                    <button type="button" class="toggle-btn" onclick="resetForm()">Reset</button>
                    <button type="button" class="toggle-btn" onclick="signInForm()">Inscription</button>
                    <button type="button" class="toggle-btn" onclick="logInFrom()">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    resetForm();
    function resetForm() {
        document.getElementById('email').value = "";
        document.getElementById('password').value = "";
    }

    function signInForm() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'code.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Traitement de la réponse
                alert(xhr.responseText);
                resetForm();
            }
        };
        xhr.send('action=inscription&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
    }

    function logInFrom() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'code.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Traitement de la réponse
                alert(xhr.responseText);
                resetForm();
            }
        };
        xhr.send('action=connexion&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
    }
</script>
</body>
</html>
