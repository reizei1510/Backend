<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['save'])) {
        print('Спасибо, результаты сохранены.');
    }
    include('form.php');
    exit();
}

$errors = FALSE;
if (empty($_POST['name'])) {
    print('Введите имя.<br/>');
    $errors = TRUE;
}
if (empty($_POST['email'])) {
    print('Введите email.<br/>');
    $errors = TRUE;
}
if (empty($_POST['birthday'])) {
    print('Введите дату рождения.<br/>');
    $errors = TRUE;
}
if (empty($_POST['gender'])) {
    print('Выберите пол.<br/>');
    $errors = TRUE;
}
if (empty($_POST['limbs'])) {
    print('Выберите количество конечностей.<br/>');
    $errors = TRUE;
}
if (empty($_POST['biography'])) {
    print('Расскажите о себе.<br/>');
    $errors = TRUE;
}
if (empty($_POST['contract'])) {
    print('Ознакомьтесь с контрактом.<br/>');
    $errors = TRUE;
}

if ($errors) {
    exit();
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
$db = new PDO('mysql:host=localhost;dbname=u16346', $user , $pass, array(PDO::ATTR_PERSISTENT => true));
// PDO – PHP Data Objects – это прослойка, которая предлагает универсальный способ работы с несколькими базами данных.

// Подготовленный запрос. Именованные метки.
try {
    $stmt = $db->prepare("INSERT INTO form (name, email, birthday, gender, limbs, superpowers, biography) VALUES (:name, :email, :bdate, :gender, :limbs, :superpowers, :bio)");
    $stmt -> execute([
      'name' => $name,
      'email' => $email,
      'birthday' => $birthday,
      'gender' => $gender,
      'limbs' => $limbs,
      'superpowers' => $superpowers,
      'biography' => $biography]);
  }
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');