<html>
<head>
<title>Factoriel via URL</title>
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

    if (isset($_POST['n']) && is_numeric($_POST['n'])) {
        $n = (int) $_POST['n'];
    } else {
        $n = 0;
    }
    $result = factorial($n);
    echo "Le résultat de factoriel de : $n est $result"
    ?>
</body>
</html>
