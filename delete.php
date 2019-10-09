<?php
include_once 'config.php';
$pdo = connect_to_database();
$msg = '';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM books WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$book) {
        die ('A book with this ID does not exist!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM books WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Book removed!';
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    die ('No ID specified!');
}
?>

<div id="article">
    <h2>Delete Book | ID:<?= $book['id'] ?></h2>
    <?php if ($msg): ?>
        <p><?= $msg ?></p>
    <?php else: ?>
        <p>Are you sure you want to delete book ID:<?= $book['id'] ?>?</p>
        <div id="decision">
            <a href="delete.php?id=<?= $book['id'] ?>&confirm=yes">Yes</a>
            <a href="delete.php?id=<?= $book['id'] ?>&confirm=no">No</a>
        </div>
    <?php endif; ?>
</div>