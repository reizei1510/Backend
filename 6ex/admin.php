<?php

$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));

/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['delete'])) {
        $del_user = $db->prepare("DELETE FROM users6 WHERE usr_id = ?");
        $del_user->execute(array($_POST['delete']));
        $del_powers = $db->prepare("DELETE FROM powers6 WHERE usr_id = ?");
        $del_powers->execute(array($_POST['delete']));
        $del_data = $db->prepare("DELETE FROM users_data6 WHERE usr_id = ?");
        $del_data->execute(array($_POST['delete']));
    }
//------------------------------------------------------------------------------------------------------    
    else if (!empty($_POST['edit'])) {
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
    }
    else {
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

//------------------------------------------------------------------------------------------------------

/*if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация</h1>');
    exit();
}
    
try {
    $stmt = $db->prepare("SELECT * FROM admins6 WHERE adm_login = ?");
    $stmt->execute($_SERVER['PHP_AUTH_USER']);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    print('Error : ' . $e->getMessage());
    exit();
}

if (empty($admin)) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Неверный логин</h1>');
    exit();
}

if ($admin['password'] != $_SERVER['PHP_AUTH_PW']) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Неверный пароль</h1>');
    exit();
}

print('Авторизация выполнена успешно.');*/





if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW']) || !empty($_GET['logout'])) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="Authorization error"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}

  /*$stmt = $db->prepare("SELECT * from admins6 WHERE adm_login = ?");
  $stmt->execute($_SERVER['PHP_AUTH_USER']);
  $admindata = $stmt->fetch(PDO::FETCH_ASSOC);
  if (empty($admindata) || $admindata['adm_pass'] != $_SERVER['PHP_AUTH_PW']) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="Authorization error"');
    print('<h1>401 Неверные данные входа</h1>');
    exit();
  }*/

print('Вы успешно авторизовались и видите защищенные паролем данные.');

//?>
//<br>
//<a href="?logout=1">Выйти</a>






 /*   $stmt = $db->query("SELECT * FROM users6");
    $allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->query("SELECT superpower, COUNT(*) as count_own FROM powers6 GROUP BY superpower");
    $powersCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./styles.css" />
    <title>Admin</title>
</head>

<body>
    <div class="content">
        <table>
            <tr>
                <th>Способность</th>
                <th>Количество обладателей</th>
            </tr>
            <?php
            if (!empty($powersCount)) {
                foreach ($powersCount as $pwr) {
            ?>
                    <tr>
                        <td><?php echo $pwr['superpower'] ?></td>
                        <td><?php echo $pwr['count_own'] ?></td>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Дата рождения</th>
                <th>Пол</th>
                <th>Количество конечностей</th>
                <th>Суперспособности</th>
                <th>Биография</th>
            </tr>
            <?php
            if (!empty($allUsers)) {
                foreach ($allUsers as $usr) {
            ?>
                    <tr>
                        <td><?php echo $usr['name'] ?></td>
                        <td><?php echo $usr['email'] ?></td>
                        <td><?php echo $usr['birthday'] ?></td>
                        <td><?php echo $usr['gender'] ?></td>
                        <td><?php echo $usr['limbs'] ?></td>
                        <td>
                            <?php
                            $superpowers = [];
                            $stmt = $db->prepare("SELECT superpower FROM powers6 WHERE usr_id = ?");
    	                    $stmt->execute($usr['usr_id']);
    	                    $pwrs = $stmt->fetchAll(PDO::FETCH_ASSOC);
	                        foreach ($pwrs as $pwr)
                                array_push($superpowers, $pwr['superpower']);
                            echo implode(', ', $superpowers);
                            ?>
                        </td>
                        <td><?php echo $value['biography'] ?></td>
                        <td><form action="" method="POST">
                            <input value="<?php echo $usr['usr_id'] ?>" name="edit" type="hidden" /><button id="edit">Изменить</button>
                            </form>
                        </td>
                        <td><form action="" method="POST">
                            <input value="<?php echo $usr['usr_id'] ?>" name="delete" type="hidden" /><button id="delete">Удалить</button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "Записи не найдены";
            }
            ?>
        </table>
    </div>
    <?php if (!empty($_POST['edit'])) {
        include('edit.php');
    } ?>
</body>

</html>*/
