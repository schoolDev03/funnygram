<?php include 'db.php';

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = $_POST['password'];

    $res = $db->query("SELECT * FROM users WHERE username='$u'");
    $row = $res->fetchArray();

    if($row && password_verify($p, $row['password'])){
        $_SESSION['user_id'] = $row['id'];
        header("Location: dashboard.php");
    }
}
?>

<form method="post">
<input name="username">
<input type="password" name="password">
<button name="login">Login</button>
</form>