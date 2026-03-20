<?php include 'db.php';

if(isset($_POST['signup'])){
    $u = $_POST['username'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $db->exec("INSERT INTO users (username, password) VALUES ('$u','$p')");
    header("Location: login.php");
}
?>

<form method="post">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="signup">Signup</button>
</form>