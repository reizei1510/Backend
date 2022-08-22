<?php
$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));
	$stmt = $db->prepare("SELECT * FROM posts WHERE usr_id = ?");
        $stmt->execute([$_POST['posts_user']]);
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
            </tr>
            <?php
            if (!empty($psts)) {
                foreach ($psts as $p) {
            ?>
                    <tr>
                        <td><?php print $p['post_id'] ?></td>
                        <td><?php print $p['date'] ?></td>
                        <td><?php print $p['post'] ?></td>
                    </tr>
            <?php
                }
            } else {
                print '<tr><td colspan="3">Записи не найдены</td></tr>';
            }
            ?>
        </table>
	    
    </div>
    
  </div>
	
</body>

</html>	
