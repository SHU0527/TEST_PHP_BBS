<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ログアウト</title>
</head>
<body>
<p>ログアウトしました</p>
<a href="post_board.php">トップページへ</a>
</body>
</html>
