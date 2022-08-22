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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['delete_user'])) {
        $del_posts = $db->prepare("DELETE FROM posts WHERE usr_id = ?");
        $del_posts->execute(array($_POST['delete_user']));
        $del_user = $db->prepare("DELETE FROM diary_users WHERE usr_id = ?");
        $del_user->execute(array($_POST['delete_user']));
	header('Location: ./admin.php');
    }
    else if (!empty($_POST['posts_user'])) {
        $pu = $_POST['posts_user'];
        include('posts_user.php');
    }
    else if (!empty($_POST['edit_user'])) {
        $stmt = $db->prepare("SELECT * FROM diary_users WHERE usr_id = ?");
        $stmt->execute([$_POST['edit_user']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $values['login'] = $result['usr_login'];
        $values['pass'] = $result['usr_pass'];
        $values['gender'] = $result['gender'];
        $values['bio'] = $result['bio'];

        setcookie('user_id', $_POST['edit_user'], time() + 12 * 30 * 24 * 60 * 60);
        include('edit_user.php');
    }
    else {
        try {
            $stmt = $db->prepare("UPDATE diary_users SET login = ?, pass = ?, gender = ?, bio = ? WHERE usr_id = ?");
            $stmt->execute(array($_POST['login'], $_POST['pass'], $_POST['gender'], $_POST['bio'], $_COOKIE['user_id']));
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
}
?>	
	
<!DOCTYPE html>
<html lang="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./styles.css" />
    <title>Admin</title>
</head>

<body>
	
  <div class="page">
    
    <div class="content">
      
      <div class="admin">
	    
        <table>
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
                        <td><?php $stmt = $db->prepare("SELECT COUNT(*) as count FROM posts WHERE usr_id = ? GROUPED BY usr_id");
                            $stmt->execute([$user['usr_id']]);
                            $p = $stmt->fetch(PDO::FETCH_ASSOC);
                            print $p['count']; ?></td>
                        <td><form action="" method="POST">
                            <input value="<?php print $usr['usr_id'] ?>" name="posts_user" type="hidden" /><button id="posts_user">All posts</button>
                            </form></td>
                        <td><form action="" method="POST">
                            <input value="<?php print $usr['usr_id'] ?>" name="edit_user" type="hidden" /><button id="edit_user">Edit</button>
                            </form></td>
                        <td><form action="" method="POST">
                            <input value="<?php echo $usr['usr_id'] ?>" name="delete_user" type="hidden" /><button id="delete_user">Delete</button>
                            </form></td>
                    </tr>
            <?php
                }
            } else {
                print "Записи не найдены";
            }
            ?>
        </table>
        
      </div>
	    
    </div>
    
  </div>
	
</body>

</html>