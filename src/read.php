<?php
session_start();
$mysqli = new mysqli("db", "root", "rootpass", "board_db");
$id = $_GET['id'];
$stmt = $mysqli->prepare("SELECT title, content, username, user_id FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($title, $content, $username, $user_id);
if ($stmt->fetch()) {
    echo "<h2>$title</h2><p>$content</p><p>작성자: $username</p>";
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_id) {
        echo "<a href='edit.php?id=$id'>수정</a> | <a href='delete.php?id=$id'>삭제</a>";
    }
} else {
    echo "글을 찾을 수 없습니다.";
}
?>