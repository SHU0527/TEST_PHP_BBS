<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<body>
<?php if (isset($_SESSION['id'])) : ?>
	<?php echo 'ようこそ' . $_SESSION['name'] . 'さん'; ?>
<?php else: ?>
	<?php echo '投稿するにはログインしてください' ; ?>
	 <a href="login_form.php">ログインページへ</a>
	<?php exit(); ?>
<?php endif; ?>
<form action="post_registers.php" method="post">
<p>タイトル<input type="text" name="post_title" required></p>
<p>本文<textarea name="post_message" required></textarea></p>
<p><input type="submit" value="書込みする"></p>
<a class="btn_cancel" href="post_board.php">キャンセル</a>
</form>
</body>
</html>
