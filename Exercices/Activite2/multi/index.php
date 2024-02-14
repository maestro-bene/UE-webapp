<!DOCTYPE html>
<html>
<head>
    <title>Tables de multiplication</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Mini-site d'affichage des tables de multiplication</h1>
<a href="tablesMultiplication.php">Afficher toutes les tables de multiplication de 1 à 10</a><br><br>

<?php
for ($i = 1; $i <= 10; $i++) {
    echo "<a href='tableMultiplication.php?numero=$i&taille=10'>Table de multiplication de $i</a><br>";
}
?>

</body>
</html>
