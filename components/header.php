<?php
include_once('../config/app.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="../assets/css/style.css">
	<script src="../assets/js/main.js"></script>
	<script src="https://kit.fontawesome.com/c32adfdcda.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body>
	<header>
		<div class="header-container">
			<div class="logo">Real Estate</div>
			<nav id="menu">
				<ul>
					<li><a href="<?= base_url('index.php') ?>">Home</a></li>
					<li><a href="<?= base_url('about.php') ?>">About Us</a></li>
					<li><a href="<?= base_url('contact-us.php') ?>">Contact Us</a></li>
					<?php if (isset($_SESSION['user_id'])): ?>
						<li><a href="<?= base_url('dashboard.php') ?>">Dashboard</a></li>
					<?php endif; ?>
					<?php if (isset($_SESSION['user_id'])): ?>
						<li>
							<form action="<?= base_url('logout.php') ?>" method="POST">
								<button type="submit" class="logout" value="Logout"> Logout </button>
							</form>
						</li>
					<?php else: ?>
						<li><a href="<?= base_url('login.php') ?>">Login</a></li>
						<li><a href="<?= base_url('register.php') ?>">Sign Up</a></li>
					<?php endif; ?>
				</ul>
			</nav>
			<svg onclick="menuShow()" onblur="menuClose()" id="burger" fill="black" viewBox="0 0 448 512" title="bars">
				<path
					d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" />
			</svg>
		</div>
	</header>