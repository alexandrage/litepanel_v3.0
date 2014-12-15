<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $description ?>">
	<meta name="keywords" content="<?php echo $keywords ?>">
	<meta name="generator" content="LitePanel">
	
	<title><?php echo $title ?> | <?php echo $description ?></title>
    
    <link href="/application/public/css/main.css" rel="stylesheet">
	<link href="/application/public/css/bootstrap.min.css" rel="stylesheet">
	<!--link href="/application/public/css/bootstrap-theme.min.css" rel="stylesheet"-->
	
	<script src="/application/public/js/jquery.min.js"></script>
	<script src="/application/public/js/jquery.form.min.js"></script>
	<script src="/application/public/js/jquery.flot.min.js"></script>
	<script src="/application/public/js/jquery.flot.time.min.js"></script>
	<script src="/application/public/js/bootstrap.min.js"></script>
	<script src="/application/public/js/main.js"></script>
</head>
<body>
	<!-- Powered by LitePanel -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">TopSkript.Ru</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li<?php if($activesection == "main"): ?> class="active"<?php endif; ?>><a href="/main/index">Главная</a></li>
					<li<?php if($activesection == "servers"): ?> class="active"<?php endif; ?>><a href="/servers/index">Сервера</a></li>
					<li<?php if($activesection == "tickets"): ?> class="active"<?php endif; ?>><a href="/tickets/index">Поддержка</a></li>
				</ul>
			</div>
		</div>
    </div>
    <div class="container">
    	<div class="row">
    		<div class="col-md-3">
    			<?php if($user_access_level >= 2): ?>
    			<div class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-default<?php if($activesection != "admin"): ?> active<?php endif; ?>" id="userNavModeBtn" onClick="setNavMode('user')">Пользователь</button>
						<button type="button" class="btn btn-default<?php if($activesection == "admin"): ?> active<?php endif; ?>" id="administratorNavModeBtn" onClick="setNavMode('administrator')">Администратор</button>
					</div>
    			</div>
    			<?php endif; ?> 
    			<div id="userNavMode"<?php if($activesection == "admin"): ?> style="display: none;"<?php endif; ?>>
					<h3>Сервера</h3>
					<div class="list-group">
						<a href="/servers/index" class="list-group-item<?php if($activesection == "servers" && $activeitem == "index"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-hdd"></span> Мои сервера</a>
						<a href="/servers/order" class="list-group-item<?php if($activesection == "servers" && $activeitem == "order"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-plus"></span> Заказать сервер</a>
					</div>
					<h3>Поддержка</h3>
					<div class="list-group">
						<a href="/tickets/index" class="list-group-item<?php if($activesection == "tickets" && $activeitem == "index"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-headphones"></span> Мои запросы</a>
						<a href="/tickets/create" class="list-group-item<?php if($activesection == "tickets" && $activeitem == "create"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-plus"></span> Создать запрос</a>
					</div>
					<h3>Аккаунт</h3>
					<div class="list-group">
						<a href="/account/pay" class="list-group-item<?php if($activesection == "account" && $activeitem == "pay"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-usd"></span> Пополнение баланса</a>
						<a href="/account/invoices" class="list-group-item<?php if($activesection == "account" && $activeitem == "invoices"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-list"></span> Счета</a>
						<a href="/account/edit" class="list-group-item<?php if($activesection == "account" && $activeitem == "edit"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-wrench"></span> Настройки</a>
						<a href="/account/logout" class="list-group-item"><span class="glyphicon glyphicon-log-out"></span> Выход</a>
					</div>
				</div>
				<?php if($user_access_level >= 2): ?>
    			<div id="administratorNavMode"<?php if($activesection != "admin"): ?> style="display: none;"<?php endif; ?>>
    				<?php if($user_access_level >= 2): ?> 
					<h3>Поддержка</h3>
					<div class="list-group">
						<a href="/admin/servers/index" class="list-group-item<?php if($activesection == "admin" && $activeitem == "servers"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-hdd"></span> Все сервера</a>
						<a href="/admin/tickets/index" class="list-group-item<?php if($activesection == "admin" && $activeitem == "tickets"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-headphones"></span> Все запросы</a>
						<a href="/admin/users/index" class="list-group-item<?php if($activesection == "admin" && $activeitem == "users"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-user"></span> Все пользователи</a>
						<a href="/admin/invoices/index" class="list-group-item<?php if($activesection == "admin" && $activeitem == "invoices"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-list"></span> Все счета</a>
					</div>
					<?php endif; ?> 
					<?php if($user_access_level >= 3): ?> 
					<h3>Управление</h3>
					<div class="list-group">
						<a href="/admin/games/index" class="list-group-item<?php if($activesection == "admin" && $activeitem == "games"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-tower"></span> Все игры</a>
						<a href="/admin/locations/index" class="list-group-item<?php if($activesection == "admin" && $activeitem == "locations"): ?> active<?php endif; ?>"><span class="glyphicon glyphicon-globe"></span> Все локации</a>
					</div>
					<?php endif; ?> 
				</div>
				<?php endif; ?>
    		</div>
    		<div id="content" class="col-md-9">
				<?php if(isset($error)): ?><div class="alert alert-danger"><strong>Ошибка!</strong> <?php echo $error ?></div><?php endif; ?> 
				<?php if(isset($warning)): ?><div class="alert alert-warning"><strong>Внимание!</strong> <?php echo $warning ?></div><?php endif; ?> 
				<?php if(isset($success)): ?><div class="alert alert-success"><strong>Выполнено!</strong> <?php echo $success ?></div><?php endif; ?> 
