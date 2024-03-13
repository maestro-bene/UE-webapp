<?php include 'header.html'; ?>
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
        <form method="post" name="FrameCitation" action="viewCitation.php">
            <table border="1" bgcolor="#ccccff" frame="above">
                <tbody>
                <tr>
                    <th><label for="login">Login</label></th>
                    <td><input name="login" maxlength="64" size="32"></td>
                </tr>
                <tr>
                    <th><label for="citation">Citation</label></th>
                    <td><textarea cols="128" rows="5" name="citation"></textarea></td>
                </tr>
                <tr>
                    <th><label for="auteur">Auteur</label></th>
                    <td><input name="auteur" maxlength="128" size="64"></td>
                </tr>
                <tr>
                    <th><label for="date">Date</label></th>
                    <td><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
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
