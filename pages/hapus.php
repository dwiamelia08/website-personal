<?php

	session_start();

	if (!isset($_SESSION['login'])) {
	// Jika session 'login' tidak ada, redirect ke login.php
	header('Location: login.php');
	exit;
	}else{
		require_once '../functions.php';
		if (!empty($_GET['buku'])) {
			if(hapusBuku($_GET['buku'])){
		        header('Location: buku.php?hapus=berhasil');
		        exit;
		     }else{
		        header('Location: buku.php?hapus=gagal');
		        exit;
		     };
		}else{
			header('Location: buku.php');
		     exit;
		}

		if (!empty($_GET['transaksi'])) {
			if(hapusTransaksi($_GET['transaksi'])){
		        header('Location: dashboard.php?hapus=berhasil');
		        exit;
		     }else{
		        header('Location: dashboard.php?hapus=gagal');
		        exit;
		     };
		}else{
			header('Location: dashboard.php');
		     exit;
		}


		if (!empty($_GET['user'])) {
			if(hapusUser($_GET['user'])){
		        header('Location: pengguna.php?hapus=berhasil');
		        exit;
		     }else{
		        header('Location: pengguna.php?hapus=gagal');
		        exit;
		     };
		}else{
			header('Location: pengguna.php');
		     exit;
		}
	}

?>