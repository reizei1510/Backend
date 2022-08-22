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
                  <td><input name="name" <?php if ($errors['name']) { print 'class="error"'; } ?> value="<?php print $name; ?>" /><br>
                </tr>
	    
                <tr>
                  <td>Gender:</td>
                  <td><input type="radio" name="gender" value="Male" <?php if($gender == "Male"){ print "checked='checked'"; } ?> />Male<br>
                      <input type="radio" name="gender" value="Female" <?php if($gender == "Female"){ print "checked='checked'"; } ?> />Female<br>
                </tr>
		
                  <td>Birthday:</td>
                  <td><input name="birthday" type="date" <?php if ($errors['birthday']) { print 'class="error"'; } ?> value="<?php print $birthday; ?>" /><br>
                </tr>
		
                <tr>
                  <td>Biography:</td>
                  <td><textarea name="biography" <?php if ($errors['biography']) { print 'class="error"'; } ?>><?php print $biography; ?></textarea><br>
                </tr>
              
              </table>
		<form action="" method="POST">
              		<input value="<?php echo $_SESSION['id'] ?>" name="added_post" type="hidden" /><button id="add_post">OK</button>
		</form>
           </form>
        
        </div>
        
    </div>
    
  </div>
 
</body>
 
</html>
