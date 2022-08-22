<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>About</title>
</head>

<body>
    <div class="page">
	<div class="topnav">
	    <a href="index.php">Diary</a>
	    <div class="topnav_right">
		<?php
		if (empty($_SESSION['login'])) {
	            print '<a href="login.php">Log In</a>';  
		    print '<a href="logup.php">Log Up</a>';
		}
		else {
		    print '<a href="login.php"><img src="profile.png" id="profile" alt="profile"></a>'; 
		}
		?>
	    </div>
	</div>
  
      
        <div class="content">
            <div class="description">
                This is a small website for summer internships at the university.
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
