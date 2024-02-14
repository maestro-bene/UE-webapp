<html>
<head>
<title>Factoriel via Form : Calcul</title>
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

        function factorial_suite($n)
        {
            $result = 0;
            if ($n === 0) {
                return 1;
            } else {
                for ($i = 0; $i < $n; $i++) {
                    $result = $result + factorial($n);
                    echo "La suite du factoriel de $n, au $i eme element vaut $result <br>";
                }
            }
            return $result;
        }

        if (isset($_GET['fvalue']) && is_numeric($_GET['fvalue'])) {
            $n = (int) $_GET['fvalue'];
        } else {
            $n = 5;
        }
        $result = factorial_suite($n);
        echo "Le résultat de factoriel de : $n est $result"
    ?>
</body>
</html>
