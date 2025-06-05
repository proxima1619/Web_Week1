<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("db", "root", "rootpass", "board_db");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hash);
    if ($stmt->fetch() && password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        header("Location: index.php");
    } else {
        echo "로그인 실패";
    }
} else {
?>
<form method="POST">
    사용자 이름: <input type="text" name="username"><br>
    비밀번호: <input type="password" name="password"><br>
    <input type="submit" value="로그인">
</form>
<?php } ?>
