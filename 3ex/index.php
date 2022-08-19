<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['save'])) {
        echo "<script type='text/javascript'>alert('Спасибо, результаты сохранены.');</script>";
    }
    include('form.php');
    exit();
}

if (empty($_POST['name'])) {
    echo "<script type='text/javascript'>alert('Введите имя.');</script>";
    include('form.php');
    exit();
}
else if (empty($_POST['email'])) {
    echo "<script type='text/javascript'>alert('Введите email.');</script>";
    include('form.php');
    exit();
}
if (empty($_POST['gender'])) {
    echo "<script type='text/javascript'>alert('Выберите пол.');</script>";
    include('form.php');
    exit();
}
if (empty($_POST['limbs'])) {
    echo "<script type='text/javascript'>alert('Выберите количество конечностей.');</script>";
    include('form.php');
    exit();
}
if (empty($_POST['superpowers'])) {
    echo "<script type='text/javascript'>alert('Выберите суперспособности.');</script>";
    include('form.php');
    exit();
}
else if (empty($_POST['biography'])) {
    echo "<script type='text/javascript'>alert('Расскажите о себе.');</script>";
    include('form.php');
    exit();
}
else if (empty($_POST['contract'])) {
    echo "<script type='text/javascript'>alert('Примите соглашение.');</script>";
    include('form.php');
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$limbs = $_POST['limbs'];
$superpowers = implode(',',$_POST['superpowers']); // объединить элементы массива в строку
$biography = $_POST['biography'];

/*$user = 'u16346';
$pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $user , $pass, array(PDO::ATTR_PERSISTENT => true));
// PDO – PHP Data Objects – это прослойка, которая предлагает универсальный способ работы с несколькими базами данных.

// Подготовленный запрос. Неименованные метки.
try {
  $stmt = $db->prepare("INSERT INTO form SET name = ?, email = ?, birthday = ?, gender = ?, limbs = ?, biography = ?");
  $stmt -> execute(array($name, $email, $birthday, $gender, $limbs, $biography));
  $superpowers_id = $db->lastInsertId();
  $superpowers = $db->prepare("INSERT INTO superpowers SET superpowers_id = ?, superpowers = ?");
  $superpowers -> execute(array($superpowers_id, $superpowers));
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
catch(PDOException $e){
  echo "<script type='text/javascript'>alert('Error: ' + $e->getMessage());</script>";
  exit();
}

header('Location: ?save=1');*/
