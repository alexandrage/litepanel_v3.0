<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Добро пожаловать, <?php echo $user_firstname ?>!</h1>
				</div>
    			<div class="panel panel-success">
					<div class="panel-heading">Информация о вашем аккаунте</div>
					<table class="table">
						<tr>
							<th>Фамилия:</th>
							<td><?php echo $user_lastname ?></td>
						</tr>
						<tr>
							<th>Имя:</th>
							<td><?php echo $user_firstname ?></td>
						</tr>
						<tr>
							<th>E-Mail:</th>
							<td><?php echo $user_email ?></td>
						</tr>
						<tr>
							<th>Баланс:</th>
							<td><?php echo $user_balance ?> рублей</td>
						</tr>
					</table>
				</div>
				<h2>Ваши сервера</h2>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Игра</th>
							<th>Локация</th>
							<th>Адрес</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($servers as $item): ?> 
						<tr onClick="redirect('/servers/control/index/<?php echo $item['server_id'] ?>')">
							<td>#<?php echo $item['server_id'] ?></td>
							<td>
							<?php if($item['server_status'] == 0): ?> 
								<span class="label label-warning">Заблокирован</span>
							<?php elseif($item['server_status'] == 1): ?> 
								<span class="label label-danger">Выключен</span>
							<?php elseif($item['server_status'] == 2): ?> 
								<span class="label label-success">Включен</span>
							<?php elseif($server['server_status'] == 3): ?> 
								<span class="label label-warning">Установка</span>
							<?php endif; ?> 
							</td>
							<td><?php echo $item['game_name'] ?></td>
							<td><?php echo $item['location_name'] ?></td>
							<td><?php echo $item['location_ip'] ?>:<?php echo $item['server_port'] ?></td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($servers)): ?> 
						<tr>
							<td colspan="5" style="text-align: center;">На данный момент у вас нет серверов.</td>
						<tr>
						<?php endif; ?> 
					</tbody>
				</table>
				<h2>Ваши запросы</h2>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Тема</th>
							<th>Дата создания</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($tickets as $item): ?> 
						<tr onClick="redirect('/tickets/view/index/<?php echo $item['ticket_id'] ?>')">
							<td>#<?php echo $item['ticket_id'] ?></td>
							<td>
								<?php if($item['ticket_status'] == 0): ?> 
								<span class="label label-danger">Закрыт</span>
								<?php elseif($item['ticket_status'] == 1): ?> 
								<span class="label label-success">Открыт</span>
								<?php endif; ?> 
							</td>
							<td><?php echo $item['ticket_name'] ?></td>
							<td><?php echo date("d.m.Y в H:i", strtotime($item['ticket_date_add'])) ?></td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($tickets)): ?> 
						<tr>
							<td colspan="4" style="text-align: center;">На данный момент у вас нет запросов.</td>
						<tr>
						<?php endif; ?> 
					</tbody>
				</table>
<?php echo $footer ?>
