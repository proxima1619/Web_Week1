<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("db", "root", "rootpass", "board_db");
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        echo "회원가입 성공! <a href='login.php'>로그인</a>";
    } else {
        echo "오류: 사용자 이름이 이미 존재합니다.";
    }
} else {
?>
<form method="POST">
    사용자 이름: <input type="text" name="username"><br>
    비밀번호: <input type="password" name="password"><br>
    <input type="submit" value="회원가입">
</form>
<?php } ?>