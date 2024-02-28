<?php
/**
 * Displays all citations and their authors.
 *
 * Fetches citation data from the database and displays it, escaping all output to protect against XSS attacks.
 *
 * @package YourProjectName\Display
 */
declare(strict_types=1);
error_reporting(E_ALL);

require_once 'Entity/Author.class.php';
require_once 'Entity/Citation.class.php';
require_once 'Entity/CitationTrait.php';

use CitationTrait;

$citations = (new class () {
    use CitationTrait;
})->main();// Fetch existing citations

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
    <ul>
        <?php foreach ($citations as $citation): ?>
            <li>
                <?php echo escape($citation->getText()); ?><br>
                    - <em><?php echo escape($citation->getAuthor()->getFullName()); ?></em>,
                <?php echo escape($citation->getDate()); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
