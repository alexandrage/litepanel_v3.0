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
	<script src="/application/public/js/bootstrap.min.js"></script>
	<script src="/application/public/js/main.js"></script>
	
	<style>
		body {
			padding-top: 72px;
			padding-bottom: 40px;
			background-color: #333;
		}
	</style>
</head>
<body>
	<!-- Powered by LitePanel -->
	<div id="content" class="container">
		<?php if(isset($error)): ?><div class="alert alert-danger"><strong>Ошибка!</strong> <?php echo $error ?></div><?php endif; ?> 
		<?php if(isset($warning)): ?><div class="alert alert-warning"><strong>Внимание!</strong> <?php echo $warning ?></div><?php endif; ?> 
		<?php if(isset($success)): ?><div class="alert alert-success"><strong>Выполнено!</strong> <?php echo $success ?></div><?php endif; ?> 
