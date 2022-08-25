<?php
if (session_start() && !empty($_SESSION['login'])) {
    setcookie('session_id', '', 1000000);
    setcookie('session_login', '', 1000000);
    session_destroy();
}
header('Location: ./');
?>
