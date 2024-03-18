<?php
// Vérification du cookie
if(isset($_COOKIE['visits'])) {
    $visits = $_COOKIE['visits'] + 1;
} else {
    $visits = 1;
}

// Définition du cookie avec le nombre de visites
setcookie('visits', $visits, time() + (86400 * 30), "/");

// Redirection vers la page d'inscription si l'utilisateur a visité le site plus de 3 fois
if($visits > 2) {
    header("Location: inscription.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <h1>Bienvenue sur notre site</h1>
    <p>Nombre de visites aujourd'hui : <?php echo $visits; ?></p>
</body>
</html>

