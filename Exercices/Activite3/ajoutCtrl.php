<?php
/**
 * A page to enter a citation in a form, and send it to a viewCitation page.
 */
declare(strict_types=1);
error_reporting(E_ALL);

require_once 'Entity/Author.class.php';
require_once 'Entity/Citation.class.php';
require_once 'Entity/CitationTrait.php';

use CitationTrait;

// Initialize error variables
$loginError = $citationError = $dateError = $firstNameError = $lastNameError = $birthYearError = '';
$showCitations = false; // Control display of citations section

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate login
    if (empty($_POST['login'])) {
        $loginError = 'Le champ Login est requis';
    }

    // Validate citation
    if (empty($_POST['citation'])) {
        $citationError = 'Le champ Citation est requis';
    }

    // Validate date
    if (empty($_POST['date'])) {
        $dateError = 'Le champ Date est requis';
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['date'])) {
        $dateError = 'Le format de la date est incorrect';
    }

    // Validate author's first name
    if (empty($_POST['firstName'])) {
        $firstNameError = 'Le prenom de l\'auteur est requis';
    }

    // Validate author's last name
    if (empty($_POST['lastName'])) {
        $lastNameError = 'Le nom de l\'auteur est requis';
    }

    // Validate author's birth year
    if (empty($_POST['birthYear'])) {
        $birthYearError = 'L\'annee de naissance de l\'auteur est requise';
    } elseif (!preg_match('/^\d{4}$/', $_POST['birthYear'])) {
        $birthYearError = 'Le format de l\'annee de naissance est incorrect (4 chiffres)';
    }

    // If there are no errors, proceed to create the Author and Citation objects
    if (empty($loginError) && empty($citationError) && empty($dateError) && empty($firstNameError) && empty($lastNameError) && empty($birthYearError)) {
        $author = new Author($_POST['firstName'] . ' | ' . $_POST['lastName'], (int)$_POST['birthYear']);
        $citations = (new class () {
            use CitationTrait;
        })->main();
        $citation = new Citation($_POST['citation'], $_POST['date'], $author);
        $citations[] = $citation; // Add the new citation
        $showCitations = true; // Show the citations section
    }
} else {
    $citations = (new class () {
        use CitationTrait;
    })->main();// Fetch existing citations if not a POST request
}

$existingAuthors = [];
foreach ($citations as $citation) {
    $author = $citation->getAuthor();
    $fullName = $author->getFullName(); // Assuming this returns "First Name | Last Name"
    $firstName = $author->getFirstName(); // Assuming this returns "First Name | Last Name"
    $lastName = $author->getLastName(); // Assuming this returns "First Name | Last Name"
    $birthYear = $author->getBirthYear();
    $existingAuthors[$fullName] = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'birthYear' => $birthYear
    ];
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajout de citation</title>
    <meta charset="UTF-8">
</head>
<body>
<main>
    <article>
        <header><h1>Formulaire de création de citations</h1></header>
        <form method="post" name="FrameCitation" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <table border="1" bgcolor="#ccccff" frame="above">
                <tbody>
                <tr>
                    <th><label for="login">Login</label></th>
                    <td><input name="login" maxlength="64" size="32" value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?>"></td>
                    <td><?php echo isset($loginError) ? $loginError : ''; ?></td>
                </tr>
                <tr>
                    <th><label for="citation">Citation</label></th>
                    <td><textarea cols="128" rows="5" name="citation"><?php echo isset($_POST['citation']) ? htmlspecialchars($_POST['citation']) : ''; ?></textarea></td>
                    <td><?php echo isset($citationError) ? $citationError : ''; ?></td>
                </tr>
                <tr>
                    <th><label for="existingAuthors">Auteurs existants :</label></th>
                    <td><select name="existingAuthors" id="existingAuthors" onchange="fillAuthorDetails()">
                        <option value="">Select an Author</option>
                        <?php foreach ($existingAuthors as $fullName => $details): ?>
                            <option value="<?php echo htmlspecialchars($details['firstName']. '|' . $details['lastName'] . '|' . $details['birthYear']); ?>">
                                <?php echo htmlspecialchars($fullName); ?>
                            </option>
                        <?php endforeach; ?>
                        <!-- Options will be populated here -->
                    </select></td>
                </tr>
                <tr>
                    <th><label for="firstName">Prenom de l'auteur:</label></th>
                    <td><input type="text" name="firstName" value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>"></td>
                    <td><?php echo isset($firstNameError) ? $firstNameError : '';?></td>
                </tr>
                <tr>
                    <th><label for="lastName">Nom de l'auteur:</label></th>
                    <td><input type="text" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>"></td>
                    <td><?php echo isset($lastNameError) ? $lastNameError : ''; ?></td>
                </tr>
                <tr>
                    <th><label for="birthYear">Annee de naissance de l'auteur:</label></th>
                    <td><input type="text" name="birthYear" pattern="\d{4}" value="<?php echo isset($_POST['birthYear']) ? htmlspecialchars($_POST['birthYear']) : ''; ?>"></td>
                    <td><?php echo isset($birthYearError) ? $birthYearError : ''; ?></td>
                </tr>
                <tr>
                    <th><label for="date">Date d'origine de la citation</label></th>
                    <td><input type="date" name="date" value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : date('Y-m-d'); ?>"></td>
                    <td><?php echo isset($dateError) ? $dateError : ''; ?></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input name="Envoyer" value="Enregistrer la citation" type="submit">
                        <input name="Effacer" value="Annuler" type="reset">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </article>
    <?php if ($showCitations) { ?>
        <section>
            <h2>Toutes les citations</h2>
            <ul>
                <?php foreach ($citations as $citation): ?>
                <li>
                    "<?php echo htmlspecialchars($citation->getText()); ?>"<br>
                    - <em><?php echo htmlspecialchars($citation->getAuthor()->getFullName()); ?></em>,
                    <?php echo htmlspecialchars($citation->getDate()); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
    <?php }; ?>
</main>
<script>
    function fillAuthorDetails() {
        var selectBox = document.getElementById('existingAuthors');
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if (selectedValue) {
            var details = selectedValue.split('|');
            document.getElementsByName('firstName')[0].value = details[0];
            document.getElementsByName('lastName')[0].value = details[1];
            document.getElementsByName('birthYear')[0].value = details[2];
        }
    }
</script>
</body>
</html>
