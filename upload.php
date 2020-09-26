<?php
session_start();
if (empty($_SESSION['id'])) {
	$msg = 'プロフィール画像の編集にはログインが必要です';
} else {
	$user_id = $_SESSION['id'];
	$msg = '画像をアップロードしてください';
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=xxxxxxxxxxxxxxxxxxxxx');
	} catch (PDOException $e) {
		echo '接続失敗' . $e->getMessage();
		exit();
	}
	if (isset($_POST['upload'])) {
		$image = uniqid(mt_rand(), true);
		$image .= substr(strrchr($_FILES['image']['tmp_name'], '.'), 1);
		$file = "images/$image";
		$update = "UPDATE registers SET images_name = :images_name WHERE id = $user_id";
		$update_image = $dbh->prepare($update);
		$update_params = array(':images_name' => $image);
		if (!empty($_FILES['image']['name'])) {
			move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);
			if (exif_imagetype($file)) {
				$msg = '画像をアップロードしました';
				$update_image->execute($update_params);
			} else {
				$msg = '画像ファイルを選択してください';
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>画像アップロード</title>
</head>
<body>
<p>アップロード画像</p>
<?php echo $msg; ?>
<?php if (isset($user_id) && empty($_POST['upload'])): ?>
	<form method="post" enctype="multipart/form-data">
	<input type="file" name="image" required>
	<button><input type="submit" name="upload" value="送信"></button>
	</form>
<?php endif; ?>
<a href="post_board.php">投稿一覧へ</a>
</body>
</html>
