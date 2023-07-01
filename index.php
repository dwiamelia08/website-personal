<?php

	session_start();

	if (isset($_SESSION['login'])) {
	  // Jika session 'login' ada, redirect ke dashboard.php
	  header('Location: pages/dashboard.php');
	  exit;
	} else {
	  // Jika session 'login' tidak ada, redirect ke login.php
	  header('Location: pages/login.php');
	  exit;
	}

?>
