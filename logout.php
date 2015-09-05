<?php
session_start();
session_destroy();
unset($_REQUEST);
unset($_GET);
unset($_POST);
header('Location: index.php');
?>