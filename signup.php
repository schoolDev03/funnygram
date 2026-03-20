<?php 
include 'db.php';

$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $u = trim($_POST['username']);
    $p = $_POST['password'];

    if(strlen($p) < 4){
        $error = "Password must be at least 4 characters";
    } else {

        $hashed = password_hash($p, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindValue(':username', $u, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashed, SQLITE3_TEXT);

        if($stmt->execute()){
            header("Location: login.php");
            exit;
        } else {
            $error = "Signup failed (username may already exist)";
        }
    }
}
?>

<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <form method="post" class="card p-4 shadow" style="width: 350px;">
        <h3 class="text-center mb-3">Signup 😎</h3>

        <?php if($error){ ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <input name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button name="signup" class="btn btn-primary w-100">Create Account</button>
    </form>
</div>