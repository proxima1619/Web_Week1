<?php
    session_start();
    $mysqli = new mysqli("db", "root", "rootpass", "board_db");
    $result = $mysqli->query("SELECT posts.id, title, username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC");
    while($row = $result->fetch_assoc()) {
        echo "<a href='read.php?id={$row['id']}'>{$row['title']} - {$row['username']}</a><br>";
}
?>
