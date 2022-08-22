<?php 

session_start();

if (!empty($_SESSION['login'])) {
    header('Location: /profile.php');
}

?>

<!DOCTYPE html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>Main Page</title>
</head>

<body>
	
    <div class="page">	
	
	<div class="content">

	    <div class="welcome">
	        Diary
	    </div>
	    <div class="welcome_text">
		You can <a href="logup.php">Join</a> or <a href="login.php">Login</a> or <a href="read.php">Read</a>
	    </div>

	</div>

	<footer>
	    <a href="about.php">About</a>
	    <a href="contacts.php">Contacts</a>
	    <a href="rules.php">Rules</a>
	    <a href="admin.php">Are you admin?</a>
	<footer>
		    
    </div>
		    
</body>
 
</html>
