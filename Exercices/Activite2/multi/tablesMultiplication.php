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
    <h2>Tables de multiplication de 1 à 10 des 10 premiers chiffres</h2>
    <div class="table-container">
        <div class='row'>
            <?php
            for ($i = 1; $i <= 5; $i++) {
                ?>
                <div class="div-table">
                    <h3>Table de <?php echo "$i" ?></h3>
                    <?php tableMult($i, 10) ?>
                </div>
                <?php
            }?>
        </div>
        <div class="row">
            <?php
            for ($i = 6; $i <= 10; $i++) {
                ?>
                <div class="div-table">
                    <h3>Table de <?php echo "$i" ?></h3>
                    <?php tableMult($i, 10) ?>
                </div>
                <?php
            }?>
        </div>
    </div>
</body>
</html>
