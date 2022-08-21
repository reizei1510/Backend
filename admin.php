<?php

if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    !empty($_GET['logout'])) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="Authorization error"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}

  $user = 'u16346';
  $pass_db = '34rerfeq5';
  $db = new PDO('mysql:host=localhost;dbname=u16346', $user, $pass_db, array(PDO::ATTR_PERSISTENT => true));
  $stmt1 = $db->prepare("SELECT * from admins6 WHERE adm_login = ?");
  $stmt1->execute([$_SERVER['PHP_AUTH_USER']]);
  $admindata = $stmt1->fetch(PDO::FETCH_ASSOC);
  if (empty($admindata) || $admindata['adm_pass'] != $_SERVER['PHP_AUTH_PW']) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="Authorization error"');
    print('<h1>401 Неверные данные входа</h1>');
    exit();
  }

print('Вы успешно авторизовались и видите защищенные паролем данные.');
?>
<br>
<form>
  <a href="./admin.php?logout=1">Выйти</a>
</form>
<table><tr><th>ability</th><th>count</th></tr>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmtc = $db->prepare("SELECT ability, count(id) AS count FROM super GROUP BY ability");
    $stmtc->execute();
    while($r = $stmtc->fetch(PDO::FETCH_ASSOC)) {
      print("<tr><th>".$r['ability'] . "</th><th>" . $r['count'] . "</th></tr>");
    }
    print("<table><tr><th>id</th><th>name</th><th>email</th><th>bdate</th><th>gender</th><th>limbs</th><th>super</th><th>bio</th><th></th></tr>");
    $stmt1 = $db->prepare("SELECT * from form");
    $stmt1->execute();
    while($r = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        print("<tr><th>".$r['id']."</th><th>".$r['name']."</th><th>".$r['email']."</th><th>".$r['bdate']."</th><th>".$r['gender']."</th><th>".$r['limbs']."</th>");
        $stmt2 = $db->prepare("SELECT ability from super WHERE id = ?");
        $stmt2->execute([$r['id']]);
        $superpowers = "";
        while($userdata = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $superpowers .= $userdata['ability'] . ", ";
        }
        print("<th>".$superpowers."</th><th>".$r['bio']."</th>");
        ?>
    <th><form action="admin.php" method="POST">
        <input  type="hidden" name="id" value="<?php print($r['id']); ?>" />
        <input  type="submit" name="edit" class="button" value="edit" />
        <input  type="submit" name="delete" class="button" value="delete" /></form></th></tr>
<?php
    }
  }
  else {
    if (array_key_exists('delete', $_POST)) {
        $user = 'u47477';
        $pass_db = '5680591';
        $db = new PDO('mysql:host=localhost;dbname=u47477', $user, $pass_db, array(PDO::ATTR_PERSISTENT => true));
        $stmt1 = $db->prepare("DELETE FROM form WHERE id = ?");
        $stmt1 -> execute([$_POST['id']]);
        $stmt2 = $db->prepare('DELETE FROM super WHERE id = ?');
        $stmt2->execute([$_POST['id']]);
    }
    else if (array_key_exists('edit', $_POST)) {
        
    }
    header('Location: admin.php');
  }
?>
