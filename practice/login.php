<?php

header('Content-Type: text/html; charset=UTF-8');
	
session_start();
if (empty($_SESSION['token']))
    $_SESSION['token'] = bin2hex(random_bytes(15));

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $errors = array();
    $errors['usr_login'] = empty($_COOKIE['usr_login_error']) ? false : $_COOKIE['usr_login_error'];
    $errors['usr_pass'] = empty($_COOKIE['usr_pass_error']) ? false : $_COOKIE['usr_pass_error'];

    $messages = array();
    if ($errors['usr_login']) {
        setcookie('usr_login_error', '', 100000);
        $messages['usr_login'] = $errors['usr_login'] == 'empty' ? 'Input login.' : 'Login not registered.';
    }
    else $messages['usr_login'] = '';
    if ($errors['usr_pass']) {
        setcookie('usr_pass_error', '', 100000);
        $messages['usr_pass'] = $errors['usr_pass'] == 'empty' ? 'Input password.' : 'Incorrect password.';
    }
    else $messages['usr_pass'] = '';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Lod In</title>
</head>

<body>
    <div class="topnav">
        <a href="index.php">Diary</a>
	<div class="topnav_right">
	    <a href="logup.php">Log Up</a>
	</div>
    </div>
	
    <div class="content">
	    
        <form action="" method="POST">
          
            <label>
                <input name="usr_login" <?php if ($errors['usr_login']) { print 'class="error"'; } ?> placeholder="login" /><br>
    		        <div class="error_message"><?php print $messages['usr_login']; ?></div>
            </label><br>
            <label>
                <input name="usr_pass" type="password" <?php if ($errors['usr_pass']) { print 'class="error"'; } placeholder="password" ?> /><br>
    		        <div class="error_message"><?php print $messages['usr_pass']; ?></div>
            </label><br>
            <input type="submit" class="button" value="Log In" />
        </form>
    	    
    </div>
	
    <footer>
        <table>
	    <tr>
                <td><a href="about.php">About</a></td>
                <td><a href="contacts.php">Contacts</a></td>
                <td><a href="contacts.php">Rules</a></td>
	    </tr>
            <tr>
                <td><a href="admin.php">Are you admin?</a></td>
            </tr>
        </table>
    <footer>

</body>
          
<?php
  
}

else {
  
    $errors = FALSE;
    if (empty($_POST['usr_login'])) {
        setcookie('usr_login_error', 'empty', time() + 24 * 60 * 60);
	      $errors = TRUE;
   }
  
   if (empty($_POST['usr_pass'])) {
        setcookie('usr_pass_error', 'empty', time() + 24 * 60 * 60);
	      $errors = TRUE;
    }
	
    if ($errors) {
        header('Location: login.php');
        exit();
    }

    $db_login = 'u16346';
    $db_pass = '34rerfeq5';
    $db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));
	
    $stmt = $db->prepare("SELECT * FROM diary_users WHERE usr_login = ?");
    $stmt->execute([$_POST['usr_login']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
	
    if (empty($user)) {
        setcookie('usr_login_error', 'incorrect', time() + 24 * 60 * 60);
        header('Location: login.php');
        exit();
    }
    if ($user['usr_pass'] != $_POST['usr_pass']) {
        setcookie('usr_pass_error', 'incorrect', time() + 24 * 60 * 60);
        header('Location: login.php');
        exit();
    }
  
    $_SESSION['login'] = $_POST['usr_login'];
    $_SESSION['uid'] = $user['usr_id'];	

    header('Location: ./');
}
