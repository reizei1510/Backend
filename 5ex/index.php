<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if (!empty($_COOKIE['save'])) {
        echo "<script type='text/javascript'>alert('Результаты сохранены.');</script>";
        if (!empty($_COOKIE['usr_pass'])) {
            echo "<script type='text/javascript'>alert('Ваш логин: ${$_COOKIE['usr_login']}, пароль: ${$_COOKIE['usr_pass']}.');</script>";
        }
        setcookie('save', '', 100000);
        setcookie('login', '', 100000);
        setcookie('pass', '', 100000);
    }
    
    $errors = array();
    $errors['name'] = empty($_COOKIE['name_error']) ? false : $_COOKIE['name_error'];
    $errors['email'] = empty($_COOKIE['email_error']) ? false : $_COOKIE['email_error'];
    $errors['birthday'] = empty($_COOKIE['birthday_error']) ? false : $_COOKIE['birthday_error'];
    $errors['gender'] = empty($_COOKIE['gender_error']) ? false : $_COOKIE['gender_error'];
    $errors['limbs'] = empty($_COOKIE['limbs_error']) ? false : $_COOKIE['limbs_error'];
    $errors['superpowers'] = empty($_COOKIE['superpowers_error']) ? false : $_COOKIE['superpowers_error'];
    $errors['biography'] = empty($_COOKIE['biography_error']) ? false : $_COOKIE['biography_error'];
    $errors['contract'] = empty($_COOKIE['contract_error']) ? false : $_COOKIE['contract_error'];
    $errors['save'] = empty($_COOKIE['save_error']) ? false : $_COOKIE['save_error'];
    
    $messages = array();
    if ($errors['name']) {
        setcookie('name_error', '', 100000);
        $messages['name'] = $errors['name'] == 'empty' ? 'Введите имя.' : 'Имя должно начинаться с заглавной буквы<br>и может содержать только латинские буквы.';
    }
    else $messages['name'] = '';
    if ($errors['email']) {
        setcookie('email_error', '', 100000);
        $messages['email'] = $errors['email'] == 'empty' ? 'Введите email.' : 'email должен иметь вид email@example.com.';
    }
    else $messages['email'] = '';
    if ($errors['birthday']) {
        setcookie('birthday_error', '', 100000);
        $messages['birthday'] = $errors['birthday'] == 'empty' ? 'Введите дату рождения.' : 'Введите корректную дату рождения.';
    }
    else $messages['birthday'] = '';
    if ($errors['gender']) {
        setcookie('gender_error', '', 100000);
        $messages['gender'] = 'Выберите пол.';
    }
    else $messages['gender'] = '';
    if ($errors['limbs']) {
        setcookie('limbs_error', '', 100000);
        $messages['limbs'] = 'Выберите количество конечностей.';
    }
    else $messages['limbs'] = '';
    if ($errors['superpowers']) {
        setcookie('superpowers_error', '', 100000);
        $messages['superpowers'] = 'Выберите хотя бы одну сверхспособность.';
    }
    else $messages['superpowers'] = '';
    if ($errors['biography']) {
        setcookie('biography_error', '', 100000);
        $messages['biography'] = 'Расскажите о себе.';
    }
    else $messages['biography'] = '';
    if ($errors['contract']) {
        setcookie('contract_error', '', 100000);
        $messages['contract'] = 'Примите соглашение.';
    }
    else $messages['contract'] = '';
    if ($errors['save']) {
        setcookie('save_error', '', 100000);
        $messages['save'] = 'Ошибка сохранения, попробуйте ещё раз.';
    }
    else $messages['save'] = '';
    
    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    $values['birthday'] = empty($_COOKIE['birthday_value']) ? '' : $_COOKIE['birthday_value'];
    $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
    $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
    $values['superpowers'] = empty($_COOKIE['superpowers_value']) ? [] : explode(', ', $_COOKIE['superpowers_value']);
    $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
    $values['contract'] = empty($_COOKIE['contract_value']) ? '' : $_COOKIE['contract_value'];
    
    if (empty($errors) && !empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
        $db_login = 'u16346';
        $db_pass = '34rerfeq5';
        $db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));
        
        $stmt = $db->prepare("SELECT * FROM users5 WHERE id = ?");
        $stmt->execute([$_SESSION['uid']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $values['name'] = $user['name'];
        $values['email'] = $user['email'];
        $values['birthday'] = $user['birthday'];
        $values['gender'] = $user['gender'];
        $values['limbs'] = $user['limbs'];
        $values['biography'] = $user['biography'];

        $stmt = $db->prepare("SELECT superpowers FROM powers5 WHERE usr_id = ?");
        $stmt->execute([$_SESSION['uid']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $values['superpowers'] = explode(', ', $user['superpowers']);
        echo "<script type='text/javascript'>alert('Вход с логином ${$_SESSION['login']}.');</script>";
    }
    
    include('form.php');
}

else {
    $errors = FALSE;
    if (empty($_POST['name'])) {
        setcookie('name_error', 'empty', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else if (!preg_match("/^[A-Z][a-z]+$/", $_POST['name'])){
        setcookie('name_error', 'incorrect', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else {
        setcookie('name_value', $_POST['name'], time() + 365 * 24 * 60 * 60);
    }
    
    if (empty($_POST['email'])) {
        setcookie('email_error', 'empty', time() + 24 * 60 *60);
        $errors = TRUE;
      }
    else if (!preg_match("/^[A-Za-z0-9][A-Za-z0-9_\-.]+@[A-Za-z0-9][A-Za-z0-9_\-.]+\.[A-Za-z]+$/",$_POST['email'])){
        setcookie('email_error', 'incorrect', time() + 24 * 60 *60);
        $errors = TRUE;
    } 
    else {
        setcookie('email_value', $_POST['email'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['birthday'])) {
        setcookie('birthday_error', 'empty', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else if ($_POST['birthday'] > date('Y-m-d')) {
        setcookie('birthday_error', 'incorrect', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else {
        setcookie('birthday_value', $_POST['birthday'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['gender'])) {
        setcookie('gender_error', 'empty', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else {
        setcookie('gender_value', $_POST['gender'], time() + 365 * 24 * 60 * 60);
    }

    if (empty($_POST['limbs'])) {
        setcookie('limbs_error', 'empty', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else {
        setcookie('limbs_value', $_POST['limbs'], time() + 365 * 24 * 60 * 60);
    }
    
    if (empty($_POST['superpowers'])) {
        setcookie('superpowers_error', 'empty', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else {
        setcookie('superpowers_value', implode(', ', $_POST['superpowers']), time() + 365 * 24 * 60 * 60);
    }
    
    if (empty($_POST['biography'])) {
        setcookie('biography_error', 'empty', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else {
        setcookie('biography_value', $_POST['biography'], time() + 365 * 24 * 60 * 60);
    }      
    
    if (empty($_POST['contract'])) {
        setcookie('contract_error', 'empty', time() + 24 * 60 *60);
        $errors = TRUE;
    }
    else {
        setcookie('contract_value', $_POST['contract'], time() + 365 * 24 * 60 * 60);
    }
    
    if ($errors) {
        header('Location: index.php');
        exit();
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $limbs = $_POST['limbs'];
    $superpowers = implode(', ', $_POST['superpowers']); // объединить элементы массива в строку
    $biography = $_POST['biography'];

    $db_login = 'u16346';
    $db_pass = '34rerfeq5';
    $db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));
    
    if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
        try {
            $uid = $_SESSION['uid'];
            $stmt = $db->prepare("UPDATE users5 SET name = ?, email = ?, birthday = ?, gender = ?, limbs = ?, biography = ? WHERE id = ?");
            $stmt -> execute(array($name, $email, $birthday, $gender, $limbs, $biography, $uid));
            $stmt = $db->prepare("UPDATE powers5 SET superpowers = ? WHERE id = ?");
            $stmt->execute(array($superpowers, $uid));
        }
        catch(PDOException $e){
            setcookie('save_error', '$e->getMessage()', time() + 24 * 60 *60);
            header('Location: index.php');
            exit();
        }
    }
    else {
        $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $usr_login = '';
        for ($i = 0; $i < 8; $i++) {
            $usd_login .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }
        
        $usr_pass = '';
        for ($i = 0; $i < 10; $i++) {
            $usd_pass .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }
        setcookie('usr_login', $usr_login);
        setcookie('usr_pass', $usr_pass);
    
        try {
            $stmt = $db->prepare("INSERT INTO users5 SET name = ?, email = ?, birthday = ?, gender = ?, limbs = ?, biography = ?");
            $stmt -> execute(array($name, $email, $birthday, $gender, $limbs, $biography));
            $usr_id = $db->lastInsertId();
            $stmt = $db->prepare("INSERT INTO powers5 SET usr_id = ?, superpowers = ?");
            $stmt -> execute(array($usr_id, $superpowers));
            $stmt = $db->prepare("INSERT INTO users_data SET usr_id = ?, login = ?, pass = ?");
            $stmt -> execute(array($usr_id, $usr_login, $usr_pass));
        }
        catch (PDOException $e) {
            setcookie('save_error', '$e->getMessage()', 100000);
            header('Location: index.php');
            exit();
        }
    }
    
    setcookie('save', '1');
    header('Location: index.php');
}
