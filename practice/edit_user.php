<!DOCTYPE html>
<html lang="">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./styles.css" />
  <title>Edit user</title>
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
      
      <form action="" method="POST">
              
              <table id="info">
                
                <tr>
                  <td>Name/Login:</td>
                  <td><input name="login" value="<?php print $values['login']; ?>" /><br>
                </tr>
	    
                <tr>
                  <td>Gender:</td>
                  <td><input type="radio" name="gender" value="Male" <?php if ($values['gender'] == "Male"){ print "checked='checked'"; } ?> />Male<br>
                      <input type="radio" name="gender" value="Female" <?php if ($values['gender'] == "Female"){ print "checked='checked'"; } ?> />Female<br>
                </tr>
		
                <tr>
                  <td>Biography:</td>
                  <td><textarea name="bio" class="bio"><?php print $values['bio']; ?></textarea><br>
                </tr>
		
                <tr>
                  <td>Password:</td>
                  <td><input type="password" name="pass" value="" /><br>
                </tr>
              
              </table><br>
              <input value="" name="update_user" type="hidden" /><button id="update_user">Edit</button>
      
    </form>
    
    </div>
    
  </div>
  
</body>

</html>
