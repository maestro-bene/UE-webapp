<?php

function tableMult($numero, $taille)
{
    $numero = filter_var($numero, FILTER_SANITIZE_NUMBER_INT);
    $taille = filter_var($taille, FILTER_SANITIZE_NUMBER_INT);
    echo "<table class='multiplication-table'>";
    for ($i = 1; $i <= $taille; $i++) {
        echo "<tr><td class='left'>$numero</td><td class='center'>x</td><td class='right'>$i</td><td>=</td><td class='result'>" . ($numero * $i) . '</td></tr>';
    }
    echo '</table>';
}
