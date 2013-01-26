<?php
require('sqlinc.php');
if(!isset($_POST['data']))
{
	header("Status: 400 Bad Request");
	exit;
}
$data = $_POST['data'];
$id = $_POST['id'];
$stmt = $db->prepare("UPDATE docs SET data=? WHERE id=?");
$stmt->execute(array($data, $id));
$affected_rows = $stmt->rowCount();
?>