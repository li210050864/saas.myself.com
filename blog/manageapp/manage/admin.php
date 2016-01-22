<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to LMX Blog</title>
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
	<script type="text/javascript" src="/js/jquery-1.11.3.js"></script>
	<script type="text/javascript" src="/js/admin.js"></script>
</head>
<body>
<div id="container">
	<div id="login">
		<form action="<?php echo site_url('admin/login'); ?>" method="post" name="loginForm" id="loginForm">
			<p>
				<label>用户名</label>
				<input type="text" name="account" value="" id="l-account"/> <span><?php echo validation_errors();?></span>
			</p>
			<p>
				<label>密&nbsp;码</label>
				<input type="password" name="pw" value="" id="l-pw"/>
			</p>
			<p>
				<input type="submit" name="Submit" value="登&nbsp;录" id="submit" />
			</p>
		</form>
	</div>
</div>
</body>
</html>