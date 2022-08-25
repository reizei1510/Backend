<?php
session_start();

if (!empty($_COOKIE['session_id'])) {
	$_SESSION['id'] = $_COOKIE['session_id'];
	$_SESSION['login'] = $_COOKIE['session_login'];
};

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>Contacts</title>
</head>

<body>
    <div class="page">
	<div class="topnav">
	    <a href="index.php">Diary</a>
	    <div class="topnav_right">
		<?php
		if (session_start() && empty($_SESSION['login'])) {
	            print '<a href="login.php">Log In</a>';  
		    print '<a href="logup.php">Log Up</a>';
		}
		else {
		    print '<a href="profile.php">Profile</a>'; 
		}
		?>
	    </div>
	</div>
  
      
        <div class="content">
            <div class="description">
                Naydo Anna<br>Russia, Krasnodar, Stavropolskaya street, 149, 350040, KubSU
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
