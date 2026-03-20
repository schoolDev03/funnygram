<?php include 'db.php';

if(!isset($_SESSION['user_id'])) header("Location: login.php");

if(isset($_POST['add'])){
    $content = $_POST['content'];
    $uid = $_SESSION['user_id'];

    $db->exec("INSERT INTO jokes (user_id, content) VALUES ($uid, '$content')");
}

$res = $db->query("SELECT * FROM jokes WHERE user_id=".$_SESSION['user_id']);
?>

<h2>Your Jokes</h2>

<form method="post">
<textarea name="content" maxlength="300"></textarea>
<button name="add">Add Joke</button>
</form>

<?php while($row = $res->fetchArray()){ ?>
<div>
    <?= htmlspecialchars($row['content']) ?>
</div>
<?php } ?>

<a href="index.php">Home</a>