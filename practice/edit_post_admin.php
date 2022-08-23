<?php
$stmt = $db->prepare("SELECT post FROM posts WHERE post_id = ?");
$stmt->execute([$pid]);
$ps = $stmt->fetch(PDO::FETCH_ASSOC);
?>

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
		<?php
		if (empty($_SESSION['login'])) {
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
		               Edit post <?php print $ps['post_id']; ?> by user <?php print $ps['usr_id']; ?>.
		              </div>
            <form action="" method="POST">
              <textarea name="post" class="add_post"><?php print $ps['post'] ?></textarea><br>
              <div class="log_form"><input value="<?php echo $_SESSION['id'] ?>" name="update_post" type="hidden" /><button id="update_post">Edit</button></div>
           </form>
    </div>
	  
	<footer>
	    <a href="about.php">About</a>
	    <a href="contacts.php">Contacts</a>
	    <a href="rules.php">Rules</a>
	<footer>
    
  </div>
 
</body>
 
</html>
