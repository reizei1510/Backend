<?php

$db_login = 'u16346';
$db_pass = '34rerfeq5';
$db = new PDO('mysql:host=localhost;dbname=u16346', $db_login, $db_pass, array(PDO::ATTR_PERSISTENT => true));

if (
    empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW']) || !empty($_GET['logout']) {
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация</h1>');
    exit();
}

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css" />
    <title>Admin</title>
</head>

<body>
    <div class="content">
        <?php print('Вы успешно авторизовались. <a href="./admin.php?logout=1">Выйти</a>'); ?>
    </div>
                <div>
                    <button type="button" class="btn btn-primary" style="max-width: 80px; max-height: 40px;"><a style="text-decoration: none; color: white;" href="./logout.php">Logout</a></button>
                </div>
                <div id="db_del_input" class="col m-1 p-1 rounded-3 border border-dark" style="background-color:darkgrey;">
                    <?php if (!empty($_COOKIE['mes'])) { ?> <div class=" alert alert-warning" role="alert"><?php echo $_COOKIE['mes'] ?></div><?php }
                                                                                                                                            setcookie('mes', '', 10000); ?>
                    <form action="db_delu.php" method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text">ID</span>
                            <input type="text" name="did" class="form-control" placeholder="ID on delete">
                            <button type="submit" class="btn btn-danger">Delete user</button>
                        </div>
                    </form>
                </div>
                <div id="db_del_input" class="col m-2 p-2 rounded-3 border border-dark" style="background-color:darkgrey;">
                    <?php if (!empty($_COOKIE['mesch'])) { ?> <div class="alert alert-warning" role="alert"><?php echo $_COOKIE['mesch'] ?></div><?php }
                                                                                                                                                setcookie('mesch', '', 10000); ?>
                    <form action="db_ch_u.php" method="POST">
                        <h4 class="text-center">Изменить данные пользователя</h4>
                        <div class="input-group mb-3">
                            <span class="input-group-text">ID</span>
                            <input type="text" name="chid" class="form-control" placeholder="Введите ID пользователя">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-danger">Change</button>
                        </div>
                    </form>
                </div>
                <div id="statistic" class="rounded-3 border border-dark" style="background-color:darkgrey;">
                    <h4 class="text-center">Статистика сверхспособностей</h4>
                    <table class="table align-middle bg-light rounded-3 border border-dark">
                        <thead>
                            <tr>
                                <th scope="col">Immortal</th>
                                <th scope="col">Walking through walls</th>
                                <th scope="col">Levitation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                    require 'db_connect.php';
                                    $query = "SELECT count(immortal) FROM super WHERE immortal = 1";
                                    $result = mysqli_query($db, $query);
                                    $result = mysqli_fetch_row($result);
                                    if (!empty($result)) {
                                        echo $result[0];
                                    } else {
                                        echo '<p class="alert alert-warning" role="alert"></p>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    require 'db_connect.php';
                                    $query = "SELECT count(ptw) FROM super WHERE ptw = 1";
                                    $result = mysqli_query($db, $query);
                                    $result = mysqli_fetch_row($result);
                                    if (!empty($result)) {
                                        echo $result[0];
                                    } else {
                                        echo '<p class="alert alert-warning" role="alert"></p>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    require 'db_connect.php';
                                    $query = "SELECT count(levitation) FROM super WHERE levitation = 1";
                                    $result = mysqli_query($db, $query);
                                    $result = mysqli_fetch_row($result);
                                    if (!empty($result)) {
                                        echo $result[0];
                                    } else {
                                        echo '<p class="alert alert-warning" role="alert"></p>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center m-1 p-1">
                <div id="db_table" class="col-12 col-md-8 bg-light rounded-3 border border-dark" style="background-color:darkgrey;">
                    <h3>Список пользователей</h3>
                    <?php
                    require_once 'db_connect.php';
                    $query = "SELECT * FROM form INNER JOIN super using(id);";
                    if ($result = mysqli_query($db, $query)) {
                        $rowsCount = $result->num_rows; // количество полученных строк
                        echo "<p>Получено объектов: $rowsCount</p>";
                        echo "<table class='table table-striped table-hover table-sm'><thread><tr><th scope='col'>#</th><th scope='col'>Name</th><th scope='col'>Email</th><th scope='col'>Birthday</th><th scope='col'>Sex</th>
                        <th scope='col'>Limbs</th><th scope='col'>Biography</th><th scope='col'>Imm</th><th scope='col'>PTW</th><th scope='col'>Levi</th></tr></thread>";
                        echo "<tbody>";
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row["id"] . "</th>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["birthday"] . "</td>";
                            echo "<td>" . $row["sex"] . "</td>";
                            echo "<td>" . $row["limbs"] . "</td>";
                            echo "<td>" . $row["biography"] . "</td>";
                            echo "<td>" . $row["immortal"] . "</td>";
                            echo "<td>" . $row["ptw"] . "</td>";
                            echo "<td>" . $row["levitation"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        $result->free();
                    } else {
                        echo "Ошибка: " . $db->error;
                    }
                    $db->close();
                    ?>
                </div>
            </div>
        </div>
</body>

</html>
