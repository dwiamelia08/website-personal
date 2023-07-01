<?php


	require_once '../functions.php';
	$st = $_GET['status'];
	$id = $_GET['id'];
	gantiStatus($id, $st);
	header('Location: pengguna.php?pesan=berhasil');
		        exit;

?>