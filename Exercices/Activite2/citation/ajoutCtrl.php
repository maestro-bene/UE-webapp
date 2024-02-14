<?php
// Initialize error variables
$loginError = $citationError = $dateError = $auteurError = '';

// Validate form data on submission
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
                    <th><label for="auteur">Auteur</label></th>
                    <td><input name="auteur" maxlength="128" size="64" value="<?php echo isset($_POST['auteur']) ? htmlspecialchars($_POST['auteur']) : ''; ?>"></td>
                    <td><?php echo isset($auteurError) ? $auteurError : ''; ?></td>
                </tr>
                <tr>
                    <th><label for="date">Date</label></th>
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
</main>
</body>
</html>
