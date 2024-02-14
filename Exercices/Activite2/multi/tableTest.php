<?php
include 'function.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Table Test</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <div class="div-table">
            <h2>Table de multiplication de 5 jusqu'à 15</h2>
            <?= tableMult(5, 15) ?>
        </div>
    </body>
</html>
