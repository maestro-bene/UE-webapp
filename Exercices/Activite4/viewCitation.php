<?php include 'header.html'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Citation</title>
    <meta charset="UTF-8">
</head>
<body>
<main>
    <article>
        <header><h1>Citation</h1></header>
        <section>
            <p><strong>Login :</strong> <?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?></p>
            <p><strong>Citation :</strong> <?php echo isset($_POST['citation']) ? htmlspecialchars($_POST['citation']) : ''; ?></p>
            <p><strong>Auteur :</strong> <?php echo isset($_POST['auteur']) ? htmlspecialchars($_POST['auteur']) : ''; ?></p>
            <p><strong>Date :</strong> <?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?></p>
        </section>
    </article>
</main>
</body>
</html>
