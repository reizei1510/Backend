<?php

if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация.</h1>');
    exit();
}

$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));
$stmt = $db->prepare("SELECT * from admins WHERE adm_login = ?");
$stmt->execute([$_SERVER['PHP_AUTH_USER']]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
if (empty($admin) || $admin['adm_pass'] != $_SERVER['PHP_AUTH_PW']) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Неверные данные.</h1>');
    exit();
}

if (session_start() && !empty($_SESSION['login'])) {
    session_destroy();
    header('Location: ./admin.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['delete_user'])) {
        $del_posts = $db->prepare("DELETE FROM posts WHERE usr_id = ?");
        $del_posts->execute([$_POST['delete_user']]);
        $del_user = $db->prepare("DELETE FROM diary_users WHERE usr_id = ?");
        $del_user->execute([$_POST['delete_user']]);
	header('Location: ./admin.php');
    }
    else if (!empty($_POST['edit_user'])) {
        $stmt = $db->prepare("SELECT * FROM diary_users WHERE usr_id = ?");
        $stmt->execute([$_POST['edit_user']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $values['login'] = $result['usr_login'];
        $values['gender'] = $result['gender'];
        $values['bio'] = $result['bio'];

        setcookie('user_id', $_POST['edit_user'], time() + 12 * 30 * 24 * 60 * 60);
        include('edit_user.php');
    }
    else {
        try {
            $stmt = $db->prepare("UPDATE diary_users SET usr_login = ?, gender = ?, bio = ? WHERE usr_id = ?");
            $stmt->execute(array($_POST['login'], $_POST['gender'], $_POST['bio'], $_COOKIE['user_id']));
	    if ($_POST['pass'] != "") {
		$stmt = $db->prepare("UPDATE diary_users SET usr_pass = ? WHERE usr_id = ?");
                $stmt->execute(array($_POST['pass'], $_COOKIE['user_id']));
	    }
            setcookie('user_id', '', 100000);
	}
	catch (PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
	header('Location: ./admin.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $db->query("SELECT * FROM diary_users");
    $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>	
	
<!DOCTYPE html>
<html lang="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./styles.css" />
    <link rel="icon" href="img/logo.png" type="image/png">
    <title>Admin</title>
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
	    
        <table id="admin">
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Password</th>
                <th>Registration date</th>
                <th>Gender</th>
                <th>Biography</th>
                <th>Posts</th>
                <th colspan="3">Acts</th>
            </tr>
            <?php
            if (!empty($allUsers)) {
                foreach ($allUsers as $user) {
            ?>
                    <tr>
                        <td><?php print $user['usr_id'] ?></td>
                        <td><?php print $user['usr_login'] ?></td>
                        <td><?php print $user['usr_pass'] ?></td>
                        <td><?php print $user['reg_date'] ?></td>
                        <td><?php print $user['gender'] ?></td>
                        <td><?php print $user['bio'] ?></td>
                        <td><?php $stmt = $db->prepare("SELECT COUNT(*) as count FROM posts WHERE usr_id = ? GROUP BY usr_id");
			    $stmt->execute([$user['usr_id']]);
                            $count_posts = $stmt->fetch(PDO::FETCH_ASSOC);
                            if (!empty($count_posts)) {
                               $count = $count_posts['count'];
                            }
                            else $count = 0;
			    $uid = $user['usr_id'];
                            print $count; ?></td>
                        <td><form action="./posts_by_user.php" method="POST">
                            <input value="<?php print $uid ?>" name="posts_by_user" type="hidden" /><button id="posts_by_user">Notes</button>
                            </form></td>
                        <td><form action="" method="POST">
                            <input value="<?php print $user['usr_id'] ?>" name="edit_user" type="hidden" /><button id="edit_user">Edit</button>
                            </form></td>
                        <td><form action="" method="POST">
			    <input value="<?php echo $user["usr_id"] ?>" name="delete_user" type="hidden" /><button id="delete_user">Delete</button>
			    </form></td>
                    </tr>
            <?php
                }
            } else {
                print '<tr><td colspan="8">Записи не найдены</td></tr>';
            }
            ?>
        </table>
        
      </div>
    
  </div>
	
</body>

</html>
<?php } ?>
