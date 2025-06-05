<?php
session_start();
$mysqli = new mysqli("db", "root", "rootpass", "board_db");
$id = $_GET['id'];
$stmt = $mysqli->prepare("SELECT user_id FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();
if ($_SESSION['user_id'] == $user_id) {
    $delete_stmt = $mysqli->prepare("DELETE FROM posts WHERE id = ?");
    $delete_stmt->bind_param("i", $id);
    $delete_stmt->execute();
    header("Location: index.php");
} else {
    echo "삭제 권한이 없습니다.";
}
?>