<?php
$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['delete_post'])) {
        $del_posts = $db->prepare("DELETE FROM posts WHERE post_id = ?");
        $del_posts->execute([$_POST['delete_post']]);
        header('Location: ./posts_by_user.php');
}

else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  setcookie('posts_by', $_POST['posts_by_user'], 100000);
  setcookie('posts_by', $_POST['posts_by_user'], time() + 365 * 24 * 60 * 60);
  header('Location: ./posts_by_user.php');
}

else {
	$stmt = $db->prepare("SELECT * FROM posts WHERE usr_id = ?");
        $stmt->execute([$_COOKIE['posts_by']]);
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
	    
	    <div class="description">
		    All posts by user <?php print $_POST['posts_user']; ?>.
		</div>
	    
        <table id="admin">
            <tr>
                <th>Note ID</th>
                <th>Date</th>
                <th>Note</th>
                <th colspan="2">Acts</th>
            </tr>
            <?php
            if (!empty($psts)) {
                foreach ($psts as $p) {
            ?>
                    <tr>
                        <td><?php print $p['post_id'] ?></td>
                        <td><?php print $p['date'] ?></td>
                        <td><?php print $p['post'] ?></td>
                        
                        <td><form action="" method="POST">
                            <input value="<?php print $p['post_id'] ?>" name="edit_post" type="hidden" /><button id="edit_post">Edit</button>
                            </form></td>
                        <td><form action="" method="POST">
			                      <input value="<?php print $p['post_id'] ?>" name="delete_post" type="hidden" /><button id="delete_post">Delete</button>
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

<?php } ?>
