<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Все игры</h1>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Название</th>
							<th>Код</th>
							<th>Слоты</th>
							<th>Порты</th>
							<th>Стоимость</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($games as $item): ?> 
						<tr onClick="redirect('/admin/games/edit/index/<?php echo $item['game_id'] ?>')">
							<td>#<?php echo $item['game_id'] ?></td>
							<td>
								<?php if($item['game_status'] == 0): ?> 
								<span class="label label-danger">Выключена</span>
								<?php elseif($item['game_status'] == 1): ?> 
								<span class="label label-success">Включена</span>
								<?php endif; ?>
							</td>
							<td><?php echo $item['game_name'] ?></td>
							<td><?php echo $item['game_code'] ?></td>
							<td><?php echo $item['game_min_slots'] ?> - <?php echo $item['game_max_slots'] ?></td>
							<td><?php echo $item['game_min_port'] ?> - <?php echo $item['game_max_port'] ?></td>
							<td><?php echo $item['game_price'] ?> руб.</td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($games)): ?> 
						<tr>
							<td colspan="7" class="text-center">На данный момент нет игр.</td>
						<tr>
						<?php endif; ?> 
						<tr>
							<td colspan="7" class="text-center"><a href="/admin/games/create" class="btn btn-default">Создать игру</a></td>
						</tr>
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
