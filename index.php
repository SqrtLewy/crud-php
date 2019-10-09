<?php
include_once 'config.php';
$pdo = connect_to_database();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Library</title>
    <meta charset="utf-8">
</head>

<body>

<div id="container">

    <div id="header">
        <h2>Library</h2>
    </div>

    <div id="article">
        <p>This is an example library. You won't borrow a book here ;)</p>
        <p>Click <a href="read.php">here</a> to browse the books.</p>
    </div>

    <div id="footer">
        Library &copy; 2019
    </div>

</div>

</body>

</html>
