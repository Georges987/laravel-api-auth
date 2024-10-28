<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Inscription d'Utilisateur</title>
</head>
<body>
    <h1>Nouvelle Inscription</h1>
    <p>Un nouvel utilisateur s'est inscrit sur votre Dashboard Khalishop.</p>
    <p><strong>Nom :</strong> {{ $name }}</p>
    <p><strong>Email :</strong> {{ $email }}</p>
    <p><strong>Token d'authentification :</strong> {{ $auth_token }}</p>
    <p>Veuillez transmettre ce token à l'utilisateur de manière sécurisée pour qu'il puisse finaliser sa connexion.</p>
</body>
</html>
