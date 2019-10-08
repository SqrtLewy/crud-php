<?php
include_once 'config.php';
$pdo = connect_to_database();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

$stmt = $pdo->prepare('SELECT * FROM books ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_books = $pdo->query('SELECT COUNT(*) FROM books')->fetchColumn();

?>

<div id="article">
    <h2>Books:</h2>
    Click <a href="index.php">here</a> to return to homepage. <br/> <br/>
    <a href="create.php"><b>Add new book</b></a> <br/> <br/>
    <table>
        <thead>
        <tr>
            <td>ID:</td>
            <td>Author:</td>
            <td>Title:</td>
            <td>Year:</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= $book['id'] ?></td>
                <td><?= $book['author'] ?></td>
                <td><?= $book['title'] ?></td>
                <td><?= $book['year'] ?></td>
                <td>
                    <a href="update.php?id=<?= $book['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $book['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="read.php?page=<?= $page - 1 ?>">Return</a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_books): ?>
            <a href="read.php?page=<?= $page + 1 ?>">Next page</a>
        <?php endif; ?>
    </div>
</div>