<?php
// Vérification du cookie
if(isset($_COOKIE['visits'])) {
    $visits = $_COOKIE['visits'];
} else {
    // Redirection vers la page d'accueil si le cookie n'est pas défini
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <p>Vous avez visité notre site <?php echo $visits; ?> fois aujourd'hui.</p>
    <p>Vous devriez vous inscrire pour plus de fonctionnalités!</p>
</body>
</html>

