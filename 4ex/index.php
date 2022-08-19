<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['save'])) {
        echo "<script type='text/javascript'>alert('Результаты сохранены.');</script>";
    }
    include('form.php');
    exit();
}







else {
    if (empty($_POST['name'])) {
        setcookie('name_empty', '');
        $errors = TRUE;
    }
    else if (!preg_match("/^[A-Z][a-z]+$/",$_POST['name'])){
        setcookie('name_incorrect', '');
        $errors = TRUE;
    }
    else {
        setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
    }
    
    if (empty($_POST['email'])) {
        setcookie('email_empty', '');
        $errors = TRUE;
      }
    else if (!preg_match("/^[A-Za-z0-9][A-Za-z0-9_\-.]+@[A-Za-z0-9][A-Za-z0-9_\-.]+\.[A-Za-z]+$/",$_POST['email'])){
        setcookie('email_incorrect', '');
        $errors = TRUE;
    } 
    else {
        setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['birthday'])) {
        setcookie('birthday_empty', '');
        $errors = TRUE;
    }
    else if ($_POST['birthday'] > date('Y-m-d')) {
        setcookie('birthday_incorrect', '');
        $errors = TRUE;
    }
    else {
        setcookie('birthday_value', $_POST['birthday'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['gender'])) {
        setcookie('gender_empty', '');
        $errors = TRUE;
    }
    else {
        setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['limbs'])) {
        setcookie('limbs_empty', '');
        $errors = TRUE;
    }
    else {
        setcookie('limbs_value', $_POST['limbs'], time() + 30 * 24 * 60 * 60);
    }
    
    if (empty($_POST['superpowers'])) {
        setcookie('superpowers_empty', '');
        $errors = TRUE;
    }
    else {
        setcookie('superpowers_value', $_POST['superpowers'], time() + 30 * 24 * 60 * 60);
    }
    
    if (empty($_POST['biography'])) {
        setcookie('biography_empty', '');
        $errors = TRUE;
    }
    else {
        setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60);
    }

$name = $_POST['name'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$limbs = $_POST['limbs'];
$superpowers = implode(',',$_POST['superpowers']); // объединить элементы массива в строку
$biography = $_POST['biography'];

$user = 'u16346';
$pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
// PDO – PHP Data Objects – это прослойка, которая предлагает универсальный способ работы с несколькими базами данных.

// Подготовленный запрос. Неименованные метки.
try {
  $stmt = $db->prepare("INSERT INTO users SET name = ?, email = ?, birthday = ?, gender = ?, limbs = ?, biography = ?");
  $stmt -> execute(array($name, $email, $birthday, $gender, $limbs, $biography));
  $usr_id = $db->lastInsertId();
  $pwrs = $db->prepare("INSERT INTO powers SET usr_id = ?, superpowers = ?");
  $pwrs -> execute(array($usr_id, $superpowers));
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');
}
