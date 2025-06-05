<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("db", "root", "rootpass", "board_db");
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $stmt = $mysqli->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $user_id);
    $stmt->execute();
    header("Location: index.php");
} else {
?>
<form method="POST">
    제목: <input type="text" name="title"><br>
    내용:<br>
    <textarea name="content" rows="5" cols="40"></textarea><br>
    <input type="submit" value="작성">
</form>
<?php } ?>
