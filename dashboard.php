<?php include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
if (isset($_POST['add'])) {
    $content = $_POST['content'];
    $uid = $_SESSION['user_id'];

    $db->exec("INSERT INTO jokes (user_id, content) VALUES ($uid, '$content')");
}

$res = $db->query("SELECT * FROM jokes WHERE user_id=" . $_SESSION['user_id']);
?>

<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

<div class="container mt-4">

    <nav class="navbar navbar-dark px-3 mb-3">
        <span class="navbar-brand">🎤 Dashboard</span>

        <div>
            <a href="index.php" class="btn btn-light btn-sm">Home</a>
            <a href="logout.php" class="btn btn-dark btn-sm">Logout</a>
        </div>
    </nav>

    <form method="post" class="card p-3 mb-3">
        <textarea name="content" class="form-control mb-2"
            oninput="updateWordCount(this, document.getElementById('counter'))"></textarea>

        <div class="d-flex justify-content-between">
            <span id="counter" class="word-counter">0 / 50 words</span>
            <button name="add" class="btn btn-primary">Add Joke</button>
        </div>
    </form>

    <?php while ($row = $res->fetchArray()) { ?>
        <div class="card p-3 mb-3">

            <p><?= htmlspecialchars($row['content']) ?></p>

            <div class="d-flex justify-content-between">
                <small>🕒 <?= $row['created_at'] ?></small>

                <div>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                        Edit
                    </button>

                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">
                        Delete
                    </a>
                </div>
            </div>
        </div>

        <!-- EDIT MODAL -->
        <div class="modal fade" id="editModal<?= $row['id'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form method="post" action="edit.php">
                        <div class="modal-header">
                            <h5>Edit Joke</h5>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">

                            <textarea name="content" class="form-control"><?= htmlspecialchars($row['content']) ?></textarea>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    <?php } ?>

    <a href="index.php" class="btn btn-dark mt-3">Back</a>
</div>
