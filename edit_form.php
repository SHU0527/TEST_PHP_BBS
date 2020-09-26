<?php
session_start();
$post_id = $_SESSION['id'];
if (empty($post_id])) {
	$msg = '投稿を編集するにはログインが必要です';
	$link = '<a href="login_form.php">ログインページへ</a>';
} else {
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=procir_maegawa207;', 'maegawa207', '2w2jog02m7');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>投稿編集ページ</title>
</head>
<body>
<?php
echo $msg;
echo $link;
?>
</body>
</html>
