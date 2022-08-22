<?php

if (session_start() && empty($_SESSION['login'])) {
    header('Location: ./login.php');
}

$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['edit_info'])) {
        include('edit_info.php');
    }
    else if (!empty($_POST['add_post'])) {
        include('add_post.php');
    }
    else if (!empty($_POST['edit_post'])) {
        include('edit_post.php');
    }
    else if (!empty($_POST['added_post'])) {
        try {
            $stmt = $db->prepare("INSERT INTO posts SET post = ?, date = ?, up_date = ?");
            $stmt->execute(array($_POST['post'], date('Y-m-d'), date('Y-m-d')));
        }
	      catch (PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
    else if (!empty($_POST['update_info'])) {
        try {
            $stmt = $db->prepare("UPDATE diary_users SET name = ?, gender = ?, birthday = ?, bio = ?");
            $stmt->execute(array($_POST['name'], $_POST['gender'], $_POST['birthday'], $_POST['bio']));
        }
	      catch (PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
    else if (!empty($_POST['update_post'])) {
        try {
            $stmt = $db->prepare("UPDATE posts SET post = ?, up_date = ?");
            $stmt->execute(array($_POST['post'], date('Y-m-d')));
        }
	      catch (PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
}

$stmt = $db->prepare("SELECT * FROM diary_users WHERE usr_login = ?");
$stmt->execute([$_SESSION['usr_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $user['usr_login'];
$gender = is_null($user['gender']) ? 'no information' : $user['gender'];
$reg_date = $user['reg_date'];
$birthday = is_null($user['birthday']) ? 'no information' : $user['birthday'];
$bio = is_null($user['bio']) ? 'no information' : $user['bio'];

$stmt = $db->prepare("SELECT COUNT(*) as count_posts FROM posts WHERE usr_id = ? GROUP BY usr_id");
$stmt->execute([$_SESSION['usr_id']]);
$count_posts = $stmt->fetch(PDO::FETCH_ASSOC);
if (!empty($count_posts)) {
    $count = $count_posts['count_posts'];
}
else $count = 0;
?>

<!DOCTYPE html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Main Page</title>
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

            <div class="description">Hello! This is your profile. Here you can change information about yourself or add or change your notes.</div>
          
            <div class="description">
                <div class="name"><?php print $name; ?></div>
                <div class="info">
                    <?php print $gender; ?><br>Birthday: <?php print $birthday; ?><br>Biography: <?php print $bio; ?><br><br>
                    Posts:  <?php print $count; ?><br><br>Registration date: <?php print $reg_date; ?><br><br>
                    <input value="<?php echo $usr['usr_id'] ?>" name="edit_info" type="hidden" /><button id="Edit info">
                </div>
            </div>
          
            <div class="log_form">
                <input value="<?php echo $usr['usr_id'] ?>" name="add_note" type="hidden" /><button id="Add note">
            </div>
            
            <?php
            
            $stmt = $db->prepare("SELECT post_id, post, date, up_date FROM posts WHERE usr_id = ?");
            $stmt->execute([$_SESSION['usr_id']]);
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($posts)) {
                print '<div class="description">You don\'t have notes yet.</div>';
            }
            else {
                foreach ($posts as $p) {
                    print '<div class="description">';
                    print $p['post'];
                    print '<br><br>';
                    print $p['date'];
                    if ($p['up_date'] > $p['date']) {
                        print '<br>updated';
                        print $p['up_date'];
                    }
                    print '<div class="log_form"><input value="<?php echo $usr["post_id"] ?>" name="edit_post" type="hidden" /><button id="Edit note"></div>';
                    print '</div>';
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
