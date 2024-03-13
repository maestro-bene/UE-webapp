<?php
setcookie("lastConnection",Date("Y-m-d H:i:s"),time()+2*24*3600,null,null,false,true);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Home Page</title>
</head>
<body>
In this page one cookie is created. Is named lastConnection and contais the date of connection: <?php echo Date("Y-m-d H:i:s")?>.
<a href="otherPage.php">Other page</a>
</body>
</html>
