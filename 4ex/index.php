<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['save'])) {
        echo "<script type='text/javascript'>alert('Результаты сохранены.');</script>";
    }
    
    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
    $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
    $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
    $values['bdate'] = empty($_COOKIE['bdate_value']) ? '' : $_COOKIE['bdate_value'];
    $superpowers = empty($_COOKIE['superpowers_value']) ? [] : explode(', ', $_COOKIE['superpowers_value']);
    $values['checkbox'] = empty($_COOKIE['checkbox_value']) ? '' : $_COOKIE['checkbox_value'];
    
    include('form.php');
}

else {
    if (empty($_POST['name'])) {
        setcookie('name_error', 'empty');
        $errors = TRUE;
    }
    else if (!preg_match("/^[A-Z][a-z]+$/",$_POST['name'])){
        setcookie('name_error', 'incorrect');
        $errors = TRUE;
    }
    else {
        setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
        if (!empty($_COOKIE['name_error']) setcookie('name_error', '', 100000);
    }
    
    if (empty($_POST['email'])) {
        setcookie('email_error', 'empty');
        $errors = TRUE;
      }
    else if (!preg_match("/^[A-Za-z0-9][A-Za-z0-9_\-.]+@[A-Za-z0-9][A-Za-z0-9_\-.]+\.[A-Za-z]+$/",$_POST['email'])){
        setcookie('email_error', 'incorrect');
        $errors = TRUE;
    } 
    else {
        setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
        if (!empty($_COOKIE['email_error']) setcookie('email_error', '', 100000);
    }

    if (empty($_POST['birthday'])) {
        setcookie('birthday_error', 'empty');
        $errors = TRUE;
    }
    else if ($_POST['birthday'] > date('Y-m-d')) {
        setcookie('birthday_error', 'incorrect');
        $errors = TRUE;
    }
    else {
        setcookie('birthday_value', $_POST['birthday'], time() + 30 * 24 * 60 * 60);
        if (!empty($_COOKIE['birthday_error']) setcookie('birthday_error', '', 100000);
    }

    if (empty($_POST['gender'])) {
        setcookie('gender_error', 'empty');
        $errors = TRUE;
    }
    else {
        setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
        if (!empty($_COOKIE['gender_error']) setcookie('gender_error', '', 100000);
    }

    if (empty($_POST['limbs'])) {
        setcookie('limbs_error', 'empty');
        $errors = TRUE;
    }
    else {
        setcookie('limbs_value', $_POST['limbs'], time() + 30 * 24 * 60 * 60);
        if (!empty($_COOKIE['limbs_error']) setcookie('limbs_error', '', 100000);
    }
    
    if (empty($_POST['superpowers'])) {
        setcookie('superpowers_error', 'empty');
        $errors = TRUE;
    }
    else {
        setcookie('superpowers_value', implode(', ', $_POST['superpowers']), time() + 30 * 24 * 60 * 60);
        if (!empty($_COOKIE['superpowers_error']) setcookie('superpowers_error', '', 100000);
    }
    
    if (empty($_POST['biography'])) {
        setcookie('biography_error', 'empty');
        $errors = TRUE;
    }
    else {
        setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60);
        if (!empty($_COOKIE['biography_error']) setcookie('biography_error', '', 100000);
    }
    
    if ($errors) {
        header('Location: index.php');
        exit();
    }
    else {
        setcookie('name_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('birthday_error', '', 100000);
        setcookie('gender_error', '', 100000);
        setcookie('limbs_error', '', 100000);
        setcookie('superpowers_error', '', 100000);
        setcookie('biography_error', '', 100000);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $limbs = $_POST['limbs'];
    $superpowers = implode(', ', $_POST['superpowers']); // объединить элементы массива в строку
    $biography = $_POST['biography'];

    $user = 'u16346';
    $pass = '34rerfeq5';
    $db = new PDO('mysql:host=localhost;dbname=u16346', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

    try {
        $stmt = $db->prepare("INSERT INTO users SET name = ?, email = ?, birthday = ?, gender = ?, limbs = ?, biography = ?");
        $stmt -> execute(array($name, $email, $birthday, $gender, $limbs, $biography));
        $usr_id = $db->lastInsertId();
        $pwrs = $db->prepare("INSERT INTO powers SET usr_id = ?, superpowers = ?");
        $pwrs -> execute(array($usr_id, $superpowers));
    }
    catch(PDOException $e){
        setcookie('save_error', '$e->getMessage()', 100000);
        header('Location: index.php');
        exit();
    }

    header('Location: ?save=1');
}
