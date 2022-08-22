<?php 

    if(!empty($_SESSION['login'])) {
        header('Location: /read.php');
    }

?>

<!DOCTYPE html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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
	    <a href="contacts.php">Rules</a>
	    <a href="admin.php">Are you admin?</a>
	<footer>
		    
    </div>
		    
</body>
 
</html>
