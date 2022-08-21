<?php

if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW']) || !empty($_GET['logout'])) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация.</h1>');
    exit();
}

$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));
$stmt = $db->prepare("SELECT * from admins6 WHERE adm_login = ?");
$stmt->execute([$_SERVER['PHP_AUTH_USER']]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);
if (empty($admin) || $admin['adm_pass'] != $_SERVER['PHP_AUTH_PW']) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Неверные данные.</h1>');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $db->query("SELECT * FROM users6");
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
	
    <div class="content">Успешная авторизация.<br><a href="./admin.php?logout=1">Выйти</a></div>
    
    <div class="content">
	    
        <table>
	    <tr>
                <th>Сверхспособности</th>
		<th>Количество владельцев</th>
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
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Дата рождения</th>
                <th>Пол</th>
                <th>Количество конечностей</th>
                <th>Суперспособности</th>
                <th>Биография</th>
                <th colspan="2">Действия</th>
            </tr>
            <?php
            if (!empty($allUsers)) {
                foreach ($allUsers as $usr) {
            ?>
                    <tr>
                        <td><?php echo $usr['usr_id'] ?></td>
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
                        <td><?php echo $usr['biography'] ?></td>
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
    } 
} ?>
	
</body>

</html>
