<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['save'])) {
        echo "<script type='text/javascript'>alert('Спасибо, результаты сохранены.');</script>";
    }
    //include('form.php');
    //exit();
    header('Location: /');
}

if (empty($_POST['name'])) {
    echo "<script type='text/javascript'>alert('Введите имя.');</script>";
    header('Location: /');
}
else if (empty($_POST['email'])) {
    echo "<script type='text/javascript'>alert('Введите email.');</script>";
    header('Location: /');
}
else if (empty($_POST['birthday'])) {
    echo "<script type='text/javascript'>alert('Введите дату рождения.');</script>";
    header('Location: /');
}
else if (empty($_POST['gender'])) {
    echo "<script type='text/javascript'>alert('Выберите пол.');</script>";
    header('Location: /');
}
else if (empty($_POST['limbs'])) {
    echo "<script type='text/javascript'>alert('Выберите количество конечностей.');</script>";
    header('Location: /');
}
else if (empty($_POST['biography'])) {
    echo "<script type='text/javascript'>alert('Расскажаите о себе.');</script>";
    header('Location: /');
}
else if (empty($_POST['contract'])) {
    echo "<script type='text/javascript'>alert('Ознакомьтесь с контрактом.');</script>";
    header('Location: /');
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
  echo "<script type='text/javascript'>alert('Error: ' + $e->getMessage());</script>";
  exit();
}

header('Location: ?save=1');
