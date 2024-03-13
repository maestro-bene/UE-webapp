
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Home Page</title>
</head>
<body>
<?php 
if(isset($_COOKIE['lastConnection'])){?>
	Hello, your last visit is from  <?php echo $_COOKIE['lastConnection'];
    }
	else
	    echo "Hello, is your first visit.";	    
	
	?>
	
</body>
</html>
