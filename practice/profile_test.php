<?php

session_start();

if (empty($_SESSION['login'])) {
    header('Location: ./login.php');
}

$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));

$stmt = $db->prepare("SELECT * FROM diary_users WHERE usr_id = ?");
$stmt->execute([$_SESSION['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $user['usr_login'];
$gender = is_null($user['gender']) ? '' : $user['gender'];
$reg_date = $user['reg_date'];
$bio = is_null($user['bio']) ? '' : $user['bio'];

$stmt = $db->prepare("SELECT COUNT(*) as count_posts FROM posts WHERE usr_id = ? GROUP BY usr_id");
$stmt->execute([$_SESSION['id']]);
$count_posts = $stmt->fetch(PDO::FETCH_ASSOC);
if (!empty($count_posts)) {
    $count = $count_posts['count_posts'];
}
else $count = 0;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  
    $messages = array();
  
    $errors = array();
    $errors['login'] = empty($_COOKIE['login_error']) ? false : $_COOKIE['login_error'];
    $errors['pass'] = empty($_COOKIE['pass_error']) ? false : $_COOKIE['pass_error'];
	
   if ($errors['login']) {
      setcookie('login_error', '', 100000);
	    if ($errors['usr_login'] == 'empty') {
	       $messages['login'] = 'Input login.';
	    }
	    else if ($errors['usr_login'] == 'exist') {
	       $messages['login'] = 'Login already registered.';
	    }
	    else if ($errors['usr_login'] == 'long') {
	       $messages['login'] = 'Login must be 3-10 characters long.';
	    }
	    else {
	       $messages['login'] = 'Login must contain only letters, numbers and "_".';
	    }
   }
   else $messages['login'] = '';
   if ($errors['pass']) {
       setcookie('pass_error', '', 100000);
	     if ($errors['pass'] == 'empty') {
	        $messages['pass'] = 'Input password.';
	     }
	     else if ($errors['pass'] == 'long') {
	         $messages['pass'] = 'Password must be 6-15 characters long.';
	     }
	    else {
	         $messages['pass'] = 'Password must contain only letters, numbers and "_".';
	    }
    }
    else $messages['pass'] = ' ';
?>

<!DOCTYPE html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Profile</title>
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

            <div class="text">Hello! This is your profile. Here you can change information about yourself or add or change your notes.</div>
          
            <div class="description">
                <div class="name"><?php print $name; ?></div>
                <div class="info">
                    Gender:<?php print $gender; ?><br>Biography: <?php print $bio; ?><br><br>
                    Posts:  <?php print $count; ?><br>Registration date: <?php print $reg_date; ?><br><br>
                    <form action="" method="post"><input value="<?php echo $_SESSION['id'] ?>" name="edit_info" type="hidden" /><button id="edit_info">Edit info</button></form>
                </div>
            </div>
          
            <div class="log_form">
                <form action="" method="post"><input value="<?php echo $_SESSION['id'] ?>" name="add_post" type="hidden" /><button id="add_post">Add note</button></form>
            </div>
            
            <?php
            
            $stmt = $db->prepare("SELECT post_id, post, date, up_date FROM posts WHERE usr_id = ?");
            $stmt->execute([$_SESSION['id']]);
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($posts)) {
                print '<div class="description">You don\'t have notes yet.</div>';
            }
            else {
		$resposts = array_reverse($posts);    
                foreach ($resposts as $p) {
                    print '<div class="description">';
                    print $p['date'];
                    if ($p['up_date'] > $p['date']) {
                        print '<br>updated ';
                        print $p['up_date'];
                    }
                    print '<br><br>';
                    print $p['post'];
                    print '<br><br>'; ?>
                    <div class="log_form">
			<table>
			    <tr>
				<td><form action="" method="post"><input value="<?php echo $p["post_id"] ?>" name="edit_post" type="hidden" />
				    <button id="edit_post">Edit note</button></form></td>
			        <td><form action="" method="post"><input value="<?php echo $p["post_id"] ?>" name="delete_post" type="hidden" />
				    <button id="delete_post">Delete note</button></form></td>
			    </tr>
			</table>
                    </div>
                </div>
	    <?php
                }
            }
            ?>

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

<?php
}
else {
$errors = FALSE;
    if (empty($_POST['login'])) {
        setcookie('login_error', 'empty', time() + 24 * 60 * 60);
	      $errors = TRUE;
    }
    else if (!preg_match("/[A-Za-z0-9_]+$/", $_POST['login'])) {
        setcookie('login_error', 'incorrect', time() + 24 * 60 * 60);
	      $errors = TRUE;
    }
    else if (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 10) {
        setcookie('login_error', 'long', time() + 24 * 60 * 60);
	      $errors = TRUE;
    }
  
    if (empty($_POST['pass'])) {
        setcookie('pass_error', 'empty', time() + 24 * 60 * 60);
	      $errors = TRUE;
    }
    else if (!preg_match("/[A-Za-z0-9_]+$/", $_POST['pass'])) {
        setcookie('pass_error', 'incorrect', time() + 24 * 60 * 60);
	      $errors = TRUE;
    }
    else if (strlen($_POST['pass']) < 6 || strlen($_POST['pass']) > 15) {
        setcookie('pass_error', 'long', time() + 24 * 60 * 60);
	      $errors = TRUE;
    }
	
    if ($errors) {
        header('Location: ./logup.php');
        exit();
    }
 
    if (!empty($_POST['edit_info'])) {
        include('edit_info_test.php');
    }
    else if (!empty($_POST['add_post'])) {
        include('add_post.php');
    }
    else if (!empty($_POST['edit_post'])) {
	     $pid = $_POST['edit_post'];
        include('edit_post.php');
    }
    else if (!empty($_POST['delete_post'])) {
        $stmt = $db->prepare("DELETE FROM posts WHERE post_id = ?");
	     $stmt->execute([$_POST['delete_post']]);
	     header('Location: ./profile_test.php');
    }
    else if (!empty($_POST['added_post'])) {
        try {
            $stmt = $db->prepare("INSERT INTO posts SET usr_id = ?, post = ?, date = ?, up_date = ?");
            $stmt->execute(array($_SESSION['id'], $_POST['post'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));
	          header('Location: ./profile_test.php');
         }
	      catch (PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
         }
    }
    else if (!empty($_POST['update_info'])) {
        try {
            $stmt = $db->prepare("UPDATE diary_users SET usr_login = ?, gender = ?, bio = ? WHERE usr_id = ?");
            $stmt->execute(array($_POST['name'], $_POST['gender'], $_POST['bio'], $_POST['update_info']));
	          if ($_POST['pass'] != "") {
		            $stmt = $db->prepare("UPDATE diary_users SET usr_pass = ? WHERE usr_id = ?");
                $stmt->execute(array($_POST['pass'], $_POST['update_info']));
	          }
	          header('Location: ./profile_test.php');
        }
	      catch (PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
    else if (!empty($_POST['update_post'])) {
        try {
            $stmt = $db->prepare("UPDATE posts SET post = ?, up_date = ? WHERE post_id = ?");
            $stmt->execute(array($_POST['post'], date("Y-m-d H:i:s"), $_POST['update_post']));
	          header('Location: ./profile_test.php');
        }
	      catch (PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
}


