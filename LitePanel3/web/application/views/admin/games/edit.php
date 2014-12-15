<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Редактирование игры</h1>
				</div>
				<div class="btn-group">
					<a href="/admin/servers/index?locationid=<?php echo $game['game_id'] ?>"" class="btn btn-default"><span class="glyphicon glyphicon-hdd"></span> Сервера игры</a>	<a class="btn btn-danger pull-right" href="/admin/games/edit/delete/<?php echo $game['game_id'] ?>">Удалить игру</a>
					</div>
				<form class="form-horizontal" action="#" id="editForm" method="POST">
					<h3>Основная информация</h3>
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Название:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="name" name="name" placeholder="Введите название" value="<?php echo $game['game_name'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="code" class="col-sm-3 control-label">Код:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="code" name="code" placeholder="Введите код" value="<?php echo $game['game_code'] ?>">
						</div>
					</div>
					<div class="form-group">
							<!-- Query -->
							<label class="col-sm-3 control-label" for="query">Query-драйвер</label>
							<div class="col-sm-4">
								<input type="text" id="query" name="query" class="form-control" value="<?php echo $game['game_query'] ?>">
							</div>
					</div>
					<h3>Дополнительная информация</h3>
					<div class="form-group">
						<label for="minslots" class="col-sm-3 control-label">Слоты:</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">от</span>
								<input type="text" class="form-control" id="minslots" name="minslots" value="<?php echo $game['game_min_slots'] ?>">
								<span class="input-group-addon">до</span>
								<input type="text" class="form-control" id="maxslots" name="maxslots" value="<?php echo $game['game_max_slots'] ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="minport" class="col-sm-3 control-label">Порты:</label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon">от</span>
								<input type="text" class="form-control" id="minport" name="minport" value="<?php echo $game['game_min_port'] ?>">
								<span class="input-group-addon">до</span>
								<input type="text" class="form-control" id="maxport" name="maxport" value="<?php echo $game['game_max_port'] ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-sm-3 control-label">Стоимость:</label>
						<div class="col-sm-3">
							<div class="input-group">
								<input type="text" class="form-control" id="price" name="price" value="<?php echo $game['game_price'] ?>">
								<span class="input-group-addon">руб.</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="status" class="col-sm-3 control-label">Статус:</label>
						<div class="col-sm-3">
							<select class="form-control" id="status" name="status">
								<option value="0"<?php if($game['game_status'] == 0): ?> selected="selected"<?php endif; ?>>Выключена</option>
								<option value="1"<?php if($game['game_status'] == 1): ?> selected="selected"<?php endif; ?>>Включена</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Изменить</button>
						</div>
					</div>
				</form>
				<script>
					$('#editForm').ajaxForm({ 
						url: '/admin/games/edit/ajax/<?php echo $game['game_id'] ?>',
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
				</script>
<?php echo $footer ?>
