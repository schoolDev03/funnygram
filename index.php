<?php include 'db.php';

$sort = isset($_GET['sort']) && $_GET['sort']=='likes' ? 'likes DESC' : 'created_at DESC';

$res = $db->query("SELECT jokes.*, users.username 
FROM jokes JOIN users ON users.id=jokes.user_id 
ORDER BY $sort");

?>

<link rel="stylesheet" href="style.css">

<h1>Funnygram</h1>

<a href="login.php">Login</a> | <a href="signup.php">Signup</a>

<?php while($row = $res->fetchArray()){ ?>
<div class="card">
    <p><?= htmlspecialchars($row['content']) ?></p>
    <small><?= $row['username'] ?> | <?= $row['created_at'] ?></small>
    <br>
    👍 <?= $row['likes'] ?> | 👎 <?= $row['dislikes'] ?>
</div>
<?php } ?>