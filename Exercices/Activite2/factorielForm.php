<html>
<head>
<title>Factoriel via Form</title>
</head>
<body>
    <?php
        function factorial($n)
        {
            if ($n === 0) {
                return 1;
            } else {
                return $n * factorial($n - 1);
            }
        }

        if (isset($_GET['fvalue']) && is_numeric($_GET['fvalue'])) {
            $n = (int) $_GET['fvalue'];
            $displayResult = true;
        } else {
            $n = 0;
            $displayResult = false;
        }
        $result = factorial($n);
        if ($displayResult == true) {
            echo "Le résultat de factoriel de : $n est $result";
        }
    ?>
    <form action="factorielForm.php">
        <label for="fvalue">Valeur dont vous voulez le factoriel:</label><br>
        <input type="number" id="fvalue" name="fvalue"><br>
        <input type="submit">
    </form>
</body>
</html>
