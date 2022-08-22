<?php

header('Content-Type: text/html; charset=UTF-8');

session_start();

if (!empty($_SESSION['login'])) {
    header('Location: ./read.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $errors = array();
    $errors['usr_login'] = empty($_COOKIE['usr_login_error']) ? false : $_COOKIE['usr_login_error'];
    $errors['usr_pass'] = empty($_COOKIE['usr_pass_error']) ? false : $_COOKIE['usr_pass_error'];

    $messages = array();
    if ($errors['usr_login']) {
        setcookie('usr_login_error', '', 100000);
	if ($errors['usr_login'] == 'empty') {
	    $messages['usr_login'] = 'Input login.';
	}
	else if ($errors['usr_login'] == 'exist') {
	    $messages['usr_login'] = 'Login already registered.';
	}
	else if ($errors['usr_login'] == 'long') {
	    $messages['usr_login'] = 'Login must be 3-10 characters long.';
	}
	else {
	    $messages['usr_login'] = 'Login must contain only letters, numbers and "_".';
	}
    }
    else $messages['usr_login'] = ' ';
    if ($errors['usr_pass']) {
        setcookie('usr_pass_error', '', 100000);
	if ($errors['usr_pass'] == 'empty') {
	    $messages['usr_pass'] = 'Input password.';
	}
	else if ($errors['usr_pass'] == 'long') {
	    $messages['usr_pass'] = 'Password must be 6-15 characters long.';
	}
	else {
	    $messages['usr_pass'] = 'Password must contain only letters, numbers and "_".';
	}
    }
    else $messages['usr_pass'] = ' ';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Log Up</title>
</head>

<body>
<div class="page">
	
    <div class="topnav">
        <a href="index.php">Diary</a>
	<div class="topnav_right">
	    <a href="login.php">Log In</a>;  
        </div>
    </div>
	
    <div class="content">
      
        <?php 
      
        if (!empty($_COOKIE['logup'])) {
            print '<div class="description">You succesfully loged up, now you can <a href="login.php">Login</a>.</div>';
            setcookie('logup', '', 100000);
        }
  
        else {
	?>
	    
            <form action="" method="POST" class="log_form">
          
                <label>
                    <input name="usr_login" <?php if ($errors['usr_login']) { print 'class="error"'; } ?> placeholder="login"/><br>
    		    <div class="error_message"><?php print $messages['usr_login']; ?></div>
                </label><br>
                <label>
                    <input name="usr_pass" type="password" <?php if ($errors['usr_pass']) { print 'class="error"'; } ?> placeholder="password"/><br>
    		    <div class="error_message"><?php print $messages['usr_pass']; ?></div>
                </label><br>
                <input type="submit" class="button" value="Log Up" />
            </form>
      
        <?php
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
          
<?php
  
}

else {
  
    $errors = FALSE;
    if (empty($_POST['usr_login'])) {
        setcookie('usr_login_error', 'empty', time() + 24 * 60 * 60);
	$errors = TRUE;
    }
    else if (!preg_match("/[A-Za-z0-9_]+$/", $_POST['usr_login'])) {
        setcookie('usr_login_error', 'incorrect', time() + 24 * 60 * 60);
	$errors = TRUE;
    }
    else if (strlen($_POST['usr_login']) < 3 || strlen($_POST['usr_login']) > 10) {
        setcookie('usr_login_error', 'long', time() + 24 * 60 * 60);
	$errors = TRUE;
    }
  
    if (empty($_POST['usr_pass'])) {
        setcookie('usr_pass_error', 'empty', time() + 24 * 60 * 60);
	$errors = TRUE;
    }
    else if (!preg_match("/[A-Za-z0-9_]+$/", $_POST['usr_pass'])) {
        setcookie('usr_pass_error', 'incorrect', time() + 24 * 60 * 60);
	$errors = TRUE;
    }
    else if (strlen($_POST['usr_pass']) < 6 || strlen($_POST['usr_pass']) > 15) {
        setcookie('usr_pass_error', 'long', time() + 24 * 60 * 60);
	$errors = TRUE;
    }
	
    if ($errors) {
        header('Location: ./logup.php');
        exit();
    }

    $db_login = 'u16346';
    $db_pass = '34rerfeq5';
    $db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));
	
    $stmt = $db->prepare("SELECT * FROM diary_users WHERE usr_login = ?");
    $stmt->execute([$_POST['usr_login']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
	
    if (!empty($user)) {
        setcookie('usr_login_error', 'exist', time() + 24 * 60 * 60);
        header('Location: ./logup.php');
        exit();
    }
  
    $stmt = $db->prepare("INSERT INTO diary_users SET usr_login = ?, usr_pass = ?, reg_date = ?");
    $stmt->execute([$_POST['usr_login'], $_POST['usr_pass'], date('Y-m-d')]);
	
    $stmt = $db->prepare("SELECT * FROM diary_users WHERE usr_login = ?");
    $stmt->execute([$_POST['usr_login']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $_SESSION['login'] = $_POST['usr_login'];
    $_SESSION['id'] = $user['usr_id'];		

    header('Location: ./logup.php');
}
