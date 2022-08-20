<?php

$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));

/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['delete'])) {
        $stmt = $db->prepare("SELECT * FROM members WHERE login = ?");
        $stmt->execute(array($_POST['delete']));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
            print('<p>Ошибка при удалении данных</p>');
        } else {
            $stmt = $db->prepare("DELETE FROM members WHERE login = ?");
            $stmt->execute(array($_POST['delete']));

            $powers = $db->prepare("DELETE FROM powers2 where user_login = ?");
            $powers->execute(array($_POST['delete']));
            header('Location: ?delete_error=0');
        }
    }
    else if (!empty($_POST['edit'])) {
        $user = 'u47572';
        $pass = '4532025';
        $member_id = $_POST['edit'];

        $db = new PDO('mysql:host=localhost;dbname=u47572', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
        $stmt = $db->prepare("SELECT * FROM members WHERE login = ?");
        $stmt->execute(array($member_id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $values['name'] = $result['name'];
        $values['email'] = $result['email'];
        $values['birth'] = $result['date'];
        $values['gender'] = $result['gender'];
        $values['limbs'] = $result['limbs'];
        $values['bio'] = $result['bio'];
        $values['policy'] = $result['policy'];

        setcookie('user_id', $member_id, time() + 12 * 30 * 24 * 60 * 60);

        $powers = $db->prepare("SELECT * FROM powers2 WHERE user_login = ?");
        $powers->execute(array($member_id['login']));
        $result = $powers->fetch(PDO::FETCH_ASSOC);
        $values['select'] = $result['powers'];
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = $_POST['birth'];
        $gender = $_POST['gender'];
        $limbs = $_POST['limbs'];
        $bio = $_POST['bio'];
        $policy = $_POST['policy'];
        $select = implode(',', $_POST['select']);
        $user = 'u47572';
        $pass = '4532025';
        $db = new PDO('mysql:host=localhost;dbname=u47572', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

        $member_id = $_COOKIE['user_id'];

        try {
            $stmt = $db->prepare("SELECT login FROM members WHERE id = ?");
            $stmt->execute(array($member_id));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            setcookie('login_value', $result['login'], time() + 12 * 30 * 24 * 60 * 60);

            $stmt = $db->prepare("UPDATE members SET name = ?, email = ?, date = ?, gender = ?, limbs = ?, bio = ?, policy = ? WHERE login = ?");
            $stmt->execute(array($name, $email, $date, $gender, $limbs, $bio, $policy, $result['login']));

            $superpowers = $db->prepare("UPDATE powers2 SET powers = ? WHERE user_login = ? ");
            $superpowers->execute(array($select, $result['login']));
        } catch (PDOException $e) {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
}*/

if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="Realm_6"');
    print('<h1>401 Требуется авторизация</h1>');
    exit();
}

$stmt = $db->prepare("SELECT * FROM admins6 WHERE adm_login = ?");
$stmt->execute($_SERVER['PHP_AUTH_USER']);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($admin)) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="Realm_6"');
    print('<h1>401 Неверный логин</h1>');
    exit();
}

if ($admin['adm_pass'] != $_SERVER['PHP_AUTH_PW']) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="Realm_6"');
    print('<h1>401 Неверный пароль</h1>');
    exit();
}

print('Авторизация выполнена успешно.');

$stmt = $db->query("SELECT * FROM users6");
$users_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->query("SELECT superpower, COUNT(*) AS count_own FROM powers6 GROUP BY superpower");
$powers_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Админ</title>
</head>

<body>
    <div class="content">
        <table>
            <tr>
                <th>Название способности</th>
                <th>Количество обладателей</th>
            </tr>
            <?php
            if (!empty($powers_data)) {
                foreach ($powers_data as $power) {
            ?>
                    <tr>
                        <td><?php echo $power['superpower'] ?></td>
                        <td><?php echo $power['count_own'] ?></td>
                    </tr>
            <?php }
            } 
            else ?>
                    <tr>
                        <td>нет данных</td>
                        <td>нет данных</td>  
                    </tr>
        </table>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>Имя</th>
                <th>email</th>
                <th>Дата рождения</th>
                <th>Пол</th>
                <th>Количество конечностей</th>
                <th>Суперспособности</th>
                <th>Биография</th>
            </tr>
            <?php
            if (!empty($users_data)) {
                foreach ($users_data as $user) {
                    $stmt = $db->prepare("SELECT superpower FROM powers6 WHERE usr_id = ?");
                    $stmt = $db->execute($user['usr_id']);
                    $usr_powers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $usr_powers_string = '';
                    foreach ($usr_powers as $usr_power) {
                        $usr_powers_string .= $usr_power['superpower'] . ', ';
                    }
            ?>
                    <tr>
                        <td><?php echo $user['usr_id'] ?></td>
                        <td><?php echo $user['name'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['birhday'] ?></td>
                        <td><?php echo $vuser['limbs'] ?></td>
                        <td><?php echo $user['gender'] ?></td>
                        <td><?php echo $usr_powers_string ?></td>
                        <td id="biography"><?php echo $user['biography'] ?></td>
                        <td><form action="" method="post">
                                <input value="<?php echo $value['usr_id'] ?>" name="edit" type="hidden" /><button id="edit">Edit</button>
                            </form>
                        </td>
                        <td><form action="" method="post">
                                <input value="<?php echo $value['login'] ?>" name="delete" type="hidden" /><button id="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
            <?php }
            } else {  ?>
                echo "Записи не найдены";
            <?php }  ?>
        </table>
    </div>
  
    /*<?php if (!empty($_POST['edit'])) {
        include('edit.php');
    } ?>*/
  
</body>

</html>
