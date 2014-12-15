<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Редактирование локации</h1>
				</div>
				<div class="btn-group">
					<a href="/admin/servers/index?locationid=<?php echo $location['location_id'] ?>"" class="btn btn-default"><span class="glyphicon glyphicon-hdd"></span> Сервера локации</a>
					<a href="/admin/locations/edit/delete/<?php echo $location['location_id'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Удалить локацию</a>
				</div>
				<form class="form-horizontal" action="#" id="editForm" method="POST">
					<h3>Основная информация</h3>
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Название:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="name" name="name" placeholder="Введите название" value="<?php echo $location['location_name'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="ip" class="col-sm-3 control-label">IP:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="ip" name="ip" placeholder="Введите IP" value="<?php echo $location['location_ip'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="user" class="col-sm-3 control-label">Имя пользователя:</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="user" name="user" placeholder="Введите имя пользователя" value="<?php echo $location['location_user'] ?>">
						</div>
					</div>
					<h3>Пароль</h3>
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
							<input type="password" class="form-control" id="password" name="password" placeholder="Пароль" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="col-sm-3 control-label">Повторите пароль:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите пароль" disabled>
						</div>
					</div>
					<h3>Дополнительная информация</h3>
					<div class="form-group">
						<label for="status" class="col-sm-3 control-label">Статус:</label>
						<div class="col-sm-3">
							<select class="form-control" id="status" name="status">
								<option value="0"<?php if($location['location_status'] == 0): ?> selected="selected"<?php endif; ?>>Выключена</option>
								<option value="1"<?php if($location['location_status'] == 1): ?> selected="selected"<?php endif; ?>>Включена</option>
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
						url: '/admin/locations/edit/ajax/<?php echo $location['location_id'] ?>',
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
