<?php
include 'db.php';

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = (int)$_GET['id'];
    $type = $_GET['type'];

    if ($type === 'like') {
        $db->exec("UPDATE jokes SET likes = likes + 1 WHERE id = $id");
    } elseif ($type === 'dislike') {
        $db->exec("UPDATE jokes SET dislikes = dislikes + 1 WHERE id = $id");
    }
}

header("Location: index.php");
exit;