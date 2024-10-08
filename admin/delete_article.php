<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);
    
    if (! $article) {
        die("article not found");
    }

} else {
    die("article not found, missing id");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($article->delete($conn)) {
        
        Url::redirect("/admin/index.php");
    }

}

?>
<?php require '../includes/header.php'; ?>

<h2>Delete post</h2>

<form method="post">
    <p>Are you sure?</p>
    <button id="delete_btn" data-testid="delete_btn">Delete</button>
    <a id="cancel_btn" data-testid="cancel_btn" href="article.php?id=<?= $article->id; ?>">Cancel</a>
</form>

<?php require '../includes/footer.php'; ?>