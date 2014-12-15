<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Все сервера</h1>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Игра</th>
							<th>Локация</th>
							<th>IP</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($servers as $item): ?> 
						<tr onClick="redirect('/admin/servers/control/index/<?php echo $item['server_id'] ?>')">
							<td>#<?php echo $item['server_id'] ?></td>
							<td>
							<?php if($item['server_status'] == 0): ?> 
								<span class="label label-warning">Заблокирован</span>
							<?php elseif($item['server_status'] == 1): ?> 
								<span class="label label-danger">Выключен</span>
							<?php elseif($item['server_status'] == 2): ?> 
								<span class="label label-success">Включен</span>
							<?php elseif($item['server_status'] == 3): ?> 
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
							<td colspan="5" class="text-center">На данный момент нет серверов.</td>
						<tr>
						<?php endif; ?> 
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
