<?php include 'header.html';
require_once './config/dbFunctions.php'; // Include your database functions file
require_once './config/DbCitationTrait.php';

(new class () {
    use DbCitationTrait;
})->main();

// Define the time range (5 days ago until now) and the sort order
date_default_timezone_set('Europe/Paris');
$startDate = date('Y-m-d H:i:s', strtotime('-5 days'));
$endDate = date('Y-m-d H:i:s');

$orderBy = 'creation_date ASC'; // Ascending order by creation date

$citations = getCitationsByTimeRange($startDate, $endDate, $orderBy);

if ($citations->rowCount() > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Citation</th>
                    <th>Date de citation</th>
                    <th>Date d'enregistrement</th>
                    <th>Lire</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = $citations->fetch()) {
        $author = findAuthorById($row["author_id"]);
        $authorName = $author['first_name'] . ' ' . $author['last_name'];
        echo "<tr>
                <td>" . $authorName . "</td>
                <td>" . $row["text"] . "</td>
                <td>" . $row["date"] . "</td>
                <td>" . $row["creation_date"] . "</td>
                <td><a href='viewOneCitation.php'>Lire</a></td>
            </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 results";
}
?>

