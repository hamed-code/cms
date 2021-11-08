
<?php

require_once '../../database/db.php';

$id = $_GET['id'];

$result = $conn->prepare("DELETE FROM post WHERE id = ?");
$result->bindValue(1, $id);
$result->execute();
header("Location: blog.php");