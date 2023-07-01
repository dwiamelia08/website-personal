<?php

	session_start();
	include '../koneksi.php';

	if (!isset($_SESSION['login'])) {
		// Jika session 'login' tidak ada, redirect ke login.php
		header('Location: login.php');
		exit;
	}else{
		if (!empty($_GET['id'])) {
			$nim = $_SESSION['login'];
		    $id_buku = $_GET['id'];
		    // Mengambil tanggal sekarang
			$tanggalSekarang = date('Y-m-d');
			// Membuat objek DateTime dengan tanggal sekarang
			$dateTime = new DateTime($tanggalSekarang);
		    $tgl_pinjam = $dateTime->format('Y-m-d');
		    $tgl_kembali = null;
		    $status = '0';
		    $denda = '0';

		    $query = "INSERT INTO transaksi (nim, id_buku, tgl_pinjam, tgl_kembali, status, denda) VALUES ('$nim', '$id_buku', '$tgl_pinjam', '$tgl_kembali', '$status', '$denda')";
		    $result = mysqli_query($koneksi, $query);
		    
		    if ($result) {
		        header('Location: daftar_buku.php?pesan=berhasil');
		    	exit;
		    } else {
		        header('Location: daftar_buku.php?pesan=gagal');
		    	exit;
		    }
		}else{
			header('Location: daftar_buku.php');
		    exit;
		}
	}

	


?>