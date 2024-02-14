<?php
require_once 'function.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tables de multiplication</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="div-table">
            <?php
                $numero = filter_var(($_GET['numero'] ?? 10), FILTER_SANITIZE_NUMBER_INT);
                $taille = filter_var(($_GET['taille'] ?? 1), FILTER_SANITIZE_NUMBER_INT);
                echo "<h2>Table de $numero jusqu'à $taille</h2>";
                tableMult($numero, $taille);
            ?>
    </div>
</body>
</html>
