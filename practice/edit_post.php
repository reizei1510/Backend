<!DOCTYPE html>

<html lang="ru">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit note</title>
</head>
<body>
  <div class="page">
    
    <div class="topnav">
        <a href="index.php">Diary</a>
	      <div class="topnav_right">
		        <a href="logout.php">Log Out</a>
		    </div>
    </div>
 
    <div class="content">	    
            <form action="" method="POST">
              <textarea name="post" class="add_post"><?php print $p($_POST['edit_post']) ?></textarea><br>
              <div class="log_form"><input value="<?php echo $_SESSION['id'] ?>" name="update_post" type="hidden" /><button id="update_post">Edit</button></div>
           </form>
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
