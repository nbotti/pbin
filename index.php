<?php
if(!isset($_GET['p'])) {
	header("Location: new.php");
	exit;
}
// Database
require('sqlinc.php');
$stmt = $db->prepare("SELECT * FROM docs WHERE id=?");
$stmt->execute(array($_GET['p']));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($stmt->rowCount() == 0) { 
	header("Status: 404 Not Found");
	exit;
}
// Ha! Found it!


?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $rows[0]["title"]; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href=" css/application.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<?php if(!isset($_GET['c']) || $_GET['c'] != 0) { ?>
	<script src="https://raw.github.com/jakiestfu/Behave.js/master/behave.min.js"></script>
	<script src="js/application.js"></script>
	<?php } ?>
</head>
<body>
	<div><b>The Pbin</b> - Paste: <?php echo $rows[0]["title"]; ?> <input type="button" value="save" id="sv" /> <span id="notes"></span></div>
	<textarea id="editor"><?php echo $rows[0]["data"]; ?></textarea>
<div id="footer" style="padding: 10px;">
<p>Great ideas come from many - or some quote like that. Thanks to <a href="http://longr.co/2cKGmZ">loyals</a> and <a href="https://github.com/andyhmltn/Minimal-Browser-IDE">andyhmltn</a> for their code and ideas.</p>
<p>Dont like the bracket/quote completion? <a href="#" onclick="window.location.href = window.location.href += 'c=0';">Turn them off.</a></p>
</div>

<script type="text/javascript">
var i = <?php echo $rows[0]["id"]; ?>;

function setM(text) {
	$('#notes').show();
	$('#notes').html(text);
	$('#notes').delay(3000).fadeOut('slow');
}

function save() {
	$.post("sav.php", { data: $('#editor').val(), id: i }).done(function () {setM('Changes saved.');}).fail(function () {setM('An error occured. Changes not saved.');});
}

$('#sv').click(function () {
	save();
});
var timer = setInterval('save()', 15000);
</script>
</body>
</html>
