<?php
include_once 'config.php';
$pdo = connect_to_database();
$msg = '';

if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $stmt = $pdo->prepare('INSERT INTO books VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $author, $title, $year]);
    $msg = 'Created Successfully!';
}
?>

<div id="article">
    <h2>Add a book:</h2>
    <p>Click <a href="read.php">here</a> to return.</p>
    <form action="create.php" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id"> <br/>
        <label for="author">Author:</label>
        <input type="text" name="author" placeholder="Jack Example" id="author"> <br/>
        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="PHP Tutorial" id="title"> <br/>
        <label for="year">Year:</label>
        <input type="text" name="year" placeholder="2019" id="year"> <br/>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>