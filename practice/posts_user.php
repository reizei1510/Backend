<?php
$stmt = $db->prepare("SELECT * FROM posts WHERE usr_id = ?");
$stmt->execute([$pu]);
$psts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles.css" />
    <title>All Posts</title>
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
	    
	    <div class="decription">
		    All posts by user <?php print $pu; ?>.
		</div>
	    
        <table id="admin">
            <tr>
                <th>Note ID</th>
                <th>Note</th>
                <th colspan="2">Acts</th>
            </tr>
            <?php
            if (!empty($psts)) {
                foreach ($psts as $p) {
            ?>
                    <tr>
                        <td><?php print $p['post_id'] ?></td>
                        <td><?php print $p['post'] ?></td>
                      
                        <td><form action="" method="POST">
                            <input value="<?php print $p['post_id'] ?>" name="edit_p" type="hidden" /><button id="edit_p">Edit</button>
                            </form></td>
                        <td><form action="" method="POST">
                            <input value="<?php echo $usr['post_id'] ?>" name="delete_p" type="hidden" /><button id="delete_p">Delete</button>
                            </form></td>
                    </tr>
            <?php
                }
            } else {
                print '<tr><td colspan="5">Записи не найдены</td></tr>';
            }
            ?>
        </table>
	    
    </div>
    
  </div>
	
</body>

</html>
