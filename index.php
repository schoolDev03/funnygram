<?php include 'db.php'
  $query = "SELECT * FROM users WHERE username='$_POST[user]'";
$sort = isset($_GET['sort']) && $_GET['sort'] == 'likes' ? 'likes DESC' : 'created_at DESC';

$res = $db->query("SELECT jokes.*, users.username 
FROM jokes JOIN users ON users.id=jokes.user_id 
ORDER BY $sort");
?>

<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-dark px-3">
    <span class="navbar-brand">😂 Funnygram</span>

    <div>
        <?php if(isset($_SESSION['user_id'])) { ?>
            <a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
            <a href="logout.php" class="btn btn-dark btn-sm">Logout</a>
        <?php } else { ?>
            <a href="login.php" class="btn btn-light btn-sm">Login</a>
            <a href="signup.php" class="btn btn-dark btn-sm">Signup</a>
        <?php } ?>
    </div>
</nav>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>🔥 Latest Jokes</h3>
        <div>
            <a href="?sort=date" class="btn btn-outline-dark btn-sm">Newest</a>
            <a href="?sort=likes" class="btn btn-outline-dark btn-sm">Popular</a>
        </div>
    </div>

    <?php while ($row = $res->fetchArray()) { ?>
        <div class="card p-3 mb-3">
            <p class="joke-text"><?= htmlspecialchars($row['content']) ?></p>

            <div class="d-flex justify-content-between">
                <small>👤 <?= $row['username'] ?> | 🕒 <?= $row['created_at'] ?></small>
                <div>
                    <a href="like.php?id=<?= $row['id'] ?>&type=like" class="like-btn text-decoration-none">
                        👍 <?= $row['likes'] ?>
                    </a>

                    <a href="like.php?id=<?= $row['id'] ?>&type=dislike" class="ms-3 dislike-btn text-decoration-none">
                        👎 <?= $row['dislikes'] ?>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>