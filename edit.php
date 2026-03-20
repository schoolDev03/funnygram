<?php
include 'db.php';

if(isset($_POST['id'])){
    $id = (int)$_POST['id'];
    $content = $_POST['content'];

    $stmt = $db->prepare("UPDATE jokes SET content = :content WHERE id = :id");
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':id', $id);

    $stmt->execute();
}

header("Location: dashboard.php");
exit;