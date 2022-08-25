<?php
if (session_start() && !empty($_SESSION['login'])) {
    setcookie('session_id', $_SESSION['id'], 1000000);
    session_destroy();
}
header('Location: ./');
?>
