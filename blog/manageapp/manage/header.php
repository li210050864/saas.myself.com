<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>静夜思个人博客-管理后台</title>
		<meta name="keywords" content="IT,美文,咖啡,博客-静夜思" />
		<meta name="description" content="个人的工作感悟，难点分析，资讯发布" />
		<link rel="stylesheet" type="text/css" href="/css/admin.css" />
		<link rel="shortcut icon" href="/images/jys.ico" type="image/x-icon" />
		<script type="text/javascript" src="/js/jquery-1.11.3.js"></script>
		<script type="text/javascript" src="/js/admin.js"></script>
	</head>
	<body>
		<div id="header">
			<div class="snow"></div>
			<div class="sun"></div>
			<h3>个人网站管理后台</h3>
			<ul id="menu">
				<li class="class-a <?php if ($page == "ART_INDEX"):?> active <?php endif;?>">
					<a href="/article/index">文章管理</a>
				</li>
				<ul class="submenu <?php if ($page != "ART_INDEX"):?> none <?php endif;?>">
					<li><a href="/article/class" <?php if($subpage == "class"):?>class="active"<?php endif?>>文章分类</a></li>
					<li><a href="/article/list">文章列表</a></li>
				</ul>
				<li class="class-a">
					<a href="/account/index">帐号管理</a>
				</li>
				<ul class="submenu <?php if ($page != "ACC_INDEX"):?> none <?php endif;?>">
					<li><a href="/account/manage">管理员</a></li>
					<li><a href="/account/user">用户</a></li>
				</ul>
				<li class="class-a">
					<a href="/cartoon/philosophy">漫画管理</a>
				</li>
				<ul class="submenu <?php if ($page != "CAR_INDEX"):?> none <?php endif;?>">
					<li><a href="/cartoon/philosophy" <?php if($subpage == "philosophy"):?>class="active"<?php endif?>>哲理</a></li>
					<li><a href="/cartoon/comic">动漫</a></li>
					<li><a href="/cartoon/it">互联网</a></li>
				</ul>
				<li class="class-a"><a href="/ad/index">广告管理</a></li>
				<li class="class-a"><a href="/msg/index">留言管理</a></li>
			</ul>
		</div>