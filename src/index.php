<?php
    session_start();
    
    if (isset($_SESSION['user_id'])) {
        echo "로그인됨. <a href='logout.php'>로그아웃</a> | <a href='write.php'>글쓰기</a><br>";
    } else {
        echo "<a href='login.php'>로그인</a> | <a href='register.php'>회원가입</a><br>";
    }
    echo "<h2>게시판</h2>";

    $mysqli = new mysqli("db", "root", "rootpass", "board_db");
    $result = $mysqli->query("SELECT posts.id, title, username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC");
    while($row = $result->fetch_assoc()) {
        echo "<a href='read.php?id={$row['id']}'>{$row['title']} - {$row['username']}</a><br>";
}
?>
