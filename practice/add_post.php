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
	    
            <form action="" method="POST">
              <textarea name="bio" class="add_post"><?php if (!empty($bio)) print $bio; else print '""';?></textarea>
              <input value="<?php echo $_SESSION['id'] ?>" name="added_post" type="hidden" /><button id="added_post">Add</button>
           </form>
        
    </div>
    
  </div>
 
</body>
 
</html>
