<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Управление сервером</h1>
				</div>
				<div class="panel panel-success">
					<div class="panel-heading">Информация о сервере</div>
					<table class="table">
						<tr>
							<th>Игра:</th>
							<td><?php echo $server['game_name'] ?></td>
						</tr>
						<tr>
							<th>Локация:</th>
							<td><?php echo $server['location_name'] ?></td>
						</tr>
						<tr>
							<th>Адрес:</th>
							<td><?php echo $server['location_ip'] ?>:<?php echo $server['server_port'] ?></td>
						</tr>
						<tr>
							<th>Слоты:</th>
							<td><?php echo $server['server_slots'] ?></td>
						</tr>
						<tr>
							<th>Дата окончания оплаты:</th>
							<td><?php echo date("d.m.Y", strtotime($server['server_date_end'])) ?></td>
							<td>
								<a href="/servers/pay/index/<?php echo $server['server_id'] ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-usd"></span> Оплатить</a>
							</td>
						</tr>
						<tr>
							<th>Статус:</th>
							<td>
								<?php if($server['server_status'] == 0): ?> 
								<span class="label label-warning">Заблокирован</span>
								<?php elseif($server['server_status'] == 1): ?> 
								<span class="label label-danger">Выключен</span>
								<?php elseif($server['server_status'] == 2): ?> 
								<span class="label label-success">Включен</span>
								<?php elseif($server['server_status'] == 3): ?> 
								<span class="label label-warning">Установка</span>
								<?php endif; ?> 
							</td>
							<td>
								<div class="btn-group btn-group-xs">
									<?php if($server['server_status'] == 1): ?> 
									<button type="button" class="btn btn-success" onClick="sendAction(<?php echo $server['server_id'] ?>,'start')"><span class="glyphicon glyphicon-off"></span> Включить</button>
									<button type="button" class="btn btn-warning" onClick="sendAction(<?php echo $server['server_id'] ?>,'reinstall')"><span class="glyphicon glyphicon-refresh"></span> Переустановить</button>
									<?php elseif($server['server_status'] == 2): ?> 
									<button type="button" class="btn btn-danger" onClick="sendAction(<?php echo $server['server_id'] ?>,'stop')"><span class="glyphicon glyphicon-off"></span> Выключить</button>
									<button type="button" class="btn btn-info" onClick="sendAction(<?php echo $server['server_id'] ?>,'restart')"><span class="glyphicon glyphicon-refresh"></span> Перезапустить</button>
									<?php endif; ?>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<?php if($server['server_status'] == 2): ?>
				<div class="panel panel-default">
					<div class="panel-heading">Статистика сервера</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-5">
								<table class="table">
									<?php if($query): ?> 
									<tr>
										<th>Название:</th>
										<td><?php echo $query['hostname'] ?></td>
									</tr>
									<tr>
										<th>Игроки:</th>
										<td><?php echo $query['players'] ?> из <?php echo $query['maxplayers'] ?></td>
									</tr>
									<tr>
										<th>Игровой режим:</th>
										<td><?php echo $query['gamemode'] ?></td>
									</tr>
									<tr>
										<th>Карта:</th>
										<td><?php echo $query['mapname'] ?></td>
									</tr>
									<?php endif; ?>
									<tr>
										<th>Нагрузка CPU</th>
										<td>~ <?php echo $server['server_cpu_load'] ?>%</td>
									</tr>
									<tr>
										<th>Нагрузка RAM</th>
										<td>~ <?php echo $server['server_ram_load'] ?>%</td>
									</tr>
								</table>
							</div>
							<div class="col-md-7">
								<div id="statsGraph" style="height: 220px;"></div>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="panel panel-default">
					<div class="panel-heading">FTP доступ</div>
					<table class="table">
						<tr>
							<th>Хост:</th>
							<td><?php echo $server['location_ip'] ?></td>
						</tr>
						<tr>
							<th>Логин:</th>
							<td>gs<?php echo $server['server_id'] ?></td>
						</tr>
						<tr>
							<th>Пароль:</th>
							<td><?php echo $server['server_password'] ?></td>
						</tr>
					</table>
				</div>
				<h2>Редактирование</h2>
				<form class="form-horizontal" action="#" id="editForm" method="POST">
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<div class="checkbox">
								<label><input type="checkbox" id="editpassword" name="editpassword" onChange="togglePassword()"> Изменить пароль</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Пароль:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="col-sm-3 control-label">Повтор пароля:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите пароль" disabled>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Сохранить</button>
						</div>
					</div>
				</form>
				<script>
					var serverStats = [
						<?php foreach($stats as $item): ?> 
						[<?php echo strtotime($item['server_stats_date'])*1000 ?>, <?php echo $item['server_stats_players'] ?>],
						<?php endforeach; ?> 
					];
					$.plot($("#statsGraph"), [serverStats], {
						xaxis: {
							mode: "time",
							timeformat: "%H:%M"
						},
						yaxis: {
							min: 0,
							max: <?php echo $server['server_slots'] ?>
						},
						series: {
							lines: {
								show: true,
								fill: true
							},
							points: {
								show: true
							}
						},
						grid: {
							borderWidth: 0
						},
						colors: [ "#428BCA" ]
					});
					$('#editForm').ajaxForm({ 
						url: '/servers/control/ajax/<?php echo $server['server_id'] ?>',
						dataType: 'text',
						success: function(data) {
							console.log(data);
							data = $.parseJSON(data);
							switch(data.status) {
								case 'error':
									showError(data.error);
									$('button[type=submit]').prop('disabled', false);
									break;
								case 'success':
									showSuccess(data.success);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
					
					function sendAction(serverid, action) {
						switch(action) {
							case "reinstall":
							{
								if(!confirm("Вы уверенны в том, что хотите переустановить сервер? Все данные будут удалены.")) return;
								break;
							}
						}
						$.ajax({ 
							url: '/servers/control/action/'+serverid+'/'+action,
							dataType: 'text',
							success: function(data) {
								console.log(data);
								data = $.parseJSON(data);
								switch(data.status) {
									case 'error':
										showError(data.error);
										$('#controlBtns button').prop('disabled', false);
										break;
									case 'success':
										showSuccess(data.success);
										setTimeout("reload()", 1500);
										break;
								}
							},
							beforeSend: function(arr, options) {
								if(action == "reinstall") showWarning("Сервер будет переустановлен в течении 10 минут!");
								$('#controlBtns button').prop('disabled', true);
							}
						});
					}
					
					function togglePassword() {
						var status = $('#editpassword').is(':checked');
						if(status) {
							$('#password').prop('disabled', false);
							$('#password2').prop('disabled', false);
						} else {
							$('#password').prop('disabled', true);
							$('#password2').prop('disabled', true);
						}
					}
				</script>
<?php echo $footer ?>
