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
							<th>IP</th>
							<th>Пользователь</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($locations as $item): ?> 
						<tr onClick="redirect('/admin/locations/edit/index/<?php echo $item['location_id'] ?>')">
							<td>#<?php echo $item['location_id'] ?></td>
							<td>
								<?php if($item['location_status'] == 0): ?> 
								<span class="label label-danger">Выключена</span>
								<?php elseif($item['location_status'] == 1): ?> 
								<span class="label label-success">Включена</span>
								<?php endif; ?> 
							</td>
							<td><?php echo $item['location_name'] ?></td>
							<td><?php echo $item['location_ip'] ?></td>
							<td><?php echo $item['location_user'] ?></td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($locations)): ?> 
						<tr>
							<td colspan="5" class="text-center">На данный момент нет локаций.</td>
						<tr>
						<?php endif; ?> 
						<tr>
							<td colspan="5" class="text-center"><a href="/admin/locations/create" class="btn btn-default">Создать локацию</a></td>
						<tr>
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
