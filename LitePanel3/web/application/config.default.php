<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
$config = array(
	// Название компании.
	// Пример: ExampleHost
	'title'			=>		'ExampleHost',
	
	// Описание компании (meta description).
	// Пример: Game Hosting ExampleHost
	'description'	=>		'ExampleHost Game Hosting',
	
	// Ключевые слова (meta keywords).
	// Пример: game hosting, game servers
	'keywords'		=>		'game hosting, game servers',
	
	// URL панели управления.
	// Обратите внимание на то, что панель управления должна располагаться в корне (под)домена.
	// http://example.com/, http://cp.example.com/, http://panel.example.com/ - правильно.
	// http://example.com/panel/ - неправильно.
	'url'			=>		'http://example.com/',
	
	// Токен.
	// Используется для запуска скриптов из Cron`а.
	'token'			=>		'mytoken123',
	
	// Тип СУБД.
	// По умолчанию поддерживается только СУБД MySQL (mysql).
	'db_type'		=>		'mysql',
	
	// Хост БД.
	// Пример: localhost, 127.0.0.1, db.example.com и пр.
	'db_hostname'	=>		'localhost',
	
	// Имя пользователя СУБД.
	'db_username'	=>		'username',
	
	// Пароль пользователя СУБД.
	'db_password'	=>		'password',
	
	// Название БД.
	'db_database'	=>		'database',
	
	// E-Mail отправителя.
	// Пример: support@example.com, noreply@example.com
	'mail_from'		=>		'support@example.com',
	
	// Имя отправителя.
	// Пример: ExampleHost Support
	'mail_sender'	=>		'ExampleHost Support',
	
	// URL мерчанта.
	// Для активированных аккаунтов - https://merchant.roboxchange.com
	// Для неактивированных аккаунтов - http://test.robokassa.ru/Index.aspx
	'rk_server'		=>		'https://merchant.roboxchange.com',
	
	// Логин в системе ROBOKASSA.
	'rk_login'		=>		'login',
	
	// Пароль №1 в системе ROBOKASSA.
	'rk_password1'	=>		'pass1',
	
	// Пароль №2 в системе ROBOKASSA.
	'rk_password2'	=>		'pass2'
);
?>
