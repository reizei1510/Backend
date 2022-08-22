<!DOCTYPE html>

<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit info</title>
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
      
      <div class="description">
	    
            <form action="" method="POST">
              
              <table>
                
                <tr>
                  <td>Name/Login:</td>
                  <td><input name="name" value="<?php if (!empty($user['usr_login'])) print $user['usr_login']; else print '';?>" /><br>
                </tr>
	    
                <tr>
                  <td>Gender:</td>
                  <td><input type="radio" name="gender" value="Male" <?php if(!empty($user['gender']) && $user['gender'] == "Male"){ print "checked='checked'"; } ?> />Male<br>
                      <input type="radio" name="gender" value="Female" <?php if(!empty($user['gender']) && $user['gender'] == "Female"){ print "checked='checked'"; } ?> />Female<br>
                </tr>
		
                <td>Birthday:</td>
                  <td><input name="birthday" type="date" <?php if (!empty($user['birthday'])) echo 'value="'.$user["birthday"].'\"'; ?>" /><br>
                </tr>
		
                <tr>
                  <td>Biography:</td>
                  <td><textarea name="bio" class="bio" value="<?php if (!empty($user['bio'])) print $user['bio']; else print ''; ?>"></textarea><br>
                </tr>
              
              </table><br>
              <input value="<?php echo $_SESSION['id'] ?>" name="update_info" type="hidden" /><button id="update_info">Submit</button>
           </form>
        
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
