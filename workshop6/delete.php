<?php
	require 'db.php'; 
	$id = $_GET["id"];
	$sql = "DELETE FROM students WHERE id = :id";
	$smpt = $pdo->prepare($sql);
	$smpt->execute([
		':id' => $id]
	);
	header("Location: index.php ");
	exit;

?>