<?php
include 'db.php';

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $db->exec("DELETE FROM jokes WHERE id = $id");
}

header("Location: dashboard.php");
exit;