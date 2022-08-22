<?php
if (session_start() && !empty($_SESSION['login'])) {
    session_destroy();
}
header('Location: ./');
?>
