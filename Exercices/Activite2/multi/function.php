<?php
/**
 * A function that generates a multiplicatoin table for a given number,
 * until a give multiplier.
 *
 * @category None
 * @package  Multi
 * @author   maestro-bene <maestro-bene@GitHub.com>
 * @license  http://apache2 None
 * @link     http://localhost:8888/multi/function.php
 */

/**
 * A function that generates a multiplicatoin table for a given number,
 * until a give multiplier.
 *
 * @param int $number The numer to generate the table from.
 * @param int $taille The maximum multiplier used.
 *
 * @return N/A
 */
function tableMult(int $number, int $taille)
{
    $number = (int)filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    $taille = (int)filter_var($taille, FILTER_SANITIZE_NUMBER_INT);
    echo "<table class='multiplication-table'>";
    for ($i = 1; $i <= $taille; $i++) {
        echo "<tr><td class='left'>$number</td><td class='center'>x</td><td class='right'>$i</td><td>=</td><td class='result'>" . ($number * $i) . '</td></tr>';
    }
    echo '</table>';
}
