<?php
include_once 'config.php';
$pdo = connect_to_database();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $author = isset($_POST['author']) ? $_POST['author'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $year = isset($_POST['year']) ? $_POST['year'] : '';
        $stmt = $pdo->prepare('UPDATE books SET id = ?, author = ?, title = ?, year = ? WHERE id = ?');
        $stmt->execute([$id, $author, $title, $year, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }

    $stmt = $pdo->prepare('SELECT * FROM books WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$book) {
        die ('A book with this ID does not exist!');
    }
} else {
    die ('No ID specified!');
}

?>

<div id="article">
    <h2>Update Book | ID: <?= $book['id'] ?></h2>
    <p>Click <a href="read.php">here</a> to return.</p>
    <form action="update.php?id=<?= $book['id'] ?>" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" placeholder="1" value="<?= $book['id'] ?>" id="id"> <br/>
        <label for="author">Author:</label>
        <input type="text" name="author" placeholder="Jack Example" value="<?= $book['author'] ?>" id="author"> <br/>
        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="PHP Tutorial" value="<?= $book['title'] ?>" id="title"> <br/>
        <label for="year">Year:</label>
        <input type="text" name="year" placeholder="2019" value="<?= $book['year'] ?>" id="year"> <br/>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>