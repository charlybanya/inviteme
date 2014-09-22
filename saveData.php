<?php
session_start();
include './includes/Database.php';
foreach ($_POST as $key => $value) {
    $_SESSION['graphObjectArray'][$key] = $value;
}
Database::saveData($_SESSION['graphObjectArray']);

?>