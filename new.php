<?php
if(isset($_POST['title']) && isset($_POST['author'])) {
	require('sqlinc.php');
	$tile = $_POST['title'];
	$author = $_POST['author'];
	$stmt = $db->prepare("INSERT INTO docs (title, author, data) VALUES (?, ?, '')");
	$stmt->execute(array($title, $author));
	$insertId = $db->lastInsertId();
	header("Location: index.php?p=" . $insertId);
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $rows[0]["title"]; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href=" css/application.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="https://raw.github.com/jakiestfu/Behave.js/master/behave.min.js"></script>
	<script src="js/application.js"></script>
</head>
<body>
	<form method="POST">
		<label for="title">Paste title: </label><input type="text" name="title" id="title" /><br />
		<label for="author">Paste author: </label><input type="text" name="author" id="author" /><br />
		<input type="submit" value="Create paste!" />
	</form>
</body>
</html>