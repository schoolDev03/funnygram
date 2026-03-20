<?php 
include 'db.php';

$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $u = trim($_POST['username']);
    $p = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $u, SQLITE3_TEXT);
    $result = $stmt->execute();

    $row = $result->fetchArray(SQLITE3_ASSOC);

    if($row && password_verify($p, $row['password'])){
        $_SESSION['user_id'] = $row['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <form method="post" class="card p-4 shadow" style="width: 350px;">
        <h3 class="text-center mb-3">Login 😂</h3>

        <?php if ($error) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <input name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button name="login" class="btn btn-primary w-100">Login</button>

        <p class="mt-3 text-center">
            No account? <a href="signup.php">Signup</a>
        </p>
    </form>
</div>