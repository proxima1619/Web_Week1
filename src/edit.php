<?php
session_start();
$mysqli = new mysqli("db", "root", "rootpass", "board_db");
$id = $_GET['id'];

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $mysqli->prepare("SELECT title, content, user_id FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($title, $content, $user_id);
$stmt->fetch();              
$stmt->close();              

if ($_SESSION['user_id'] != $user_id) {
    echo "수정 권한이 없습니다.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST['title'];
    $new_content = $_POST['content'];

    $update_stmt = $mysqli->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $update_stmt->bind_param("ssi", $new_title, $new_content, $id);
    $update_stmt->execute();
    header("Location: read.php?id=$id");
} else {
?>
<form method="POST">
    제목: <input type="text" name="title" value="<?= htmlspecialchars($title) ?>"><br>
    내용:<br>
    <textarea name="content" rows="5" cols="40"><?= htmlspecialchars($content) ?></textarea><br>
    <input type="submit" value="수정">
</form>
<?php } ?>
