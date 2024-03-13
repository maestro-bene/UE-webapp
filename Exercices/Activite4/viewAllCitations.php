<?php
declare(strict_types=1);
/**
 * Displays all citations and their authors in a table format.
 *
 * Fetches citation data from the database and displays it in a table, escaping all output to protect against XSS attacks.
 *
 * @package YourProjectName\Display
 */

error_reporting(E_ALL);

include 'header.html';
require_once 'Entity/Author.class.php';
require_once 'Entity/Citation.class.php';
require_once 'Entity/CitationTrait.php';


$citations = (new class () {
    use CitationTrait;
})->main(); // Fetch existing citations

/**
 * A protection to escape html injection.
 *
 * @param $string The string to escape
 *
 * @return escapedString The string to escape
 */
function escape($string): string
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Citations</title>
</head>

<body>
    <h1>All Citations</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Citation</th>
                <th>Author</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($citations as $citation) : ?>
                <tr>
                    <td><?php echo escape($citation->getAuthor()->getFullName()); ?></td>
                    <td><?php echo escape($citation->getText()); ?></td>
                    <td><?php echo escape($citation->getDate()); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>

