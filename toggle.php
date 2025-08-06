<?php
$conn = new mysqli('localhost', 'root', '', 'smart_methods');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $conn->query("UPDATE users SET status = 1 - status WHERE id = $id");
}

header('Location: index.php');
?>