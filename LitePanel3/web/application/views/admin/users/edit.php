<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Редактирование пользователя</h1>
				</div>
				<div class="btn-group">
					<a href="/admin/servers/index?userid=<?php echo $user['user_id'] ?>"" class="btn btn-default"><span class="glyphicon glyphicon-hdd"></span> Сервера пользователя</a>
					<a href="/admin/tickets/index?userid=<?php echo $user['user_id'] ?>"" class="btn btn-default"><span class="glyphicon glyphicon-headphones"></span> Запросы пользователя</a>
					<a href="/admin/invoices/index?userid=<?php echo $user['user_id'] ?>"" class="btn btn-default"><span class="glyphicon glyphicon-list"></span> Счета пользователя</a>
				</div>
				<form class="form-horizontal" action="#" id="editForm" method="POST">
					<h3>Основная информация</h3>
					<div class="form-group">
						<label for="firstname" class="col-sm-3 control-label">Имя:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Введите имя" value="<?php echo $user['user_firstname'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-sm-3 control-label">Фамилия:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Введите фамилию" value="<?php echo $user['user_lastname'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="status" class="col-sm-3 control-label">Статус:</label>
						<div class="col-sm-3">
							<select class="form-control" id="status" name="status">
								<option value="0"<?php if($user['user_status'] == 0): ?> selected="selected"<?php endif; ?>>Заблокирован</option>
								<option value="1"<?php if($user['user_status'] == 1): ?> selected="selected"<?php endif; ?>>Разблокирован</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-sm-3 control-label">Баланс:</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="balance" name="balance" placeholder="Введите баланс" value="<?php echo $user['user_balance'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="accesslevel" class="col-sm-3 control-label">Уровень доступа:</label>
						<div class="col-sm-3">
							<select class="form-control" id="accesslevel" name="accesslevel">
								<option value="0"<?php if($user['user_access_level'] == 0): ?> selected="selected"<?php endif; ?>>Демонстрация</option>
								<option value="1"<?php if($user['user_access_level'] == 1): ?> selected="selected"<?php endif; ?>>Клиент</option>
								<option value="2"<?php if($user['user_access_level'] == 2): ?> selected="selected"<?php endif; ?>>Техническая поддержка</option>
								<option value="3"<?php if($user['user_access_level'] == 3): ?> selected="selected"<?php endif; ?>>Администрация</option>
							</select>
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
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Изменить</button>
						</div>
					</div>
				</form>
				<script>
					$('#editForm').ajaxForm({ 
						url: '/admin/users/edit/ajax/<?php echo $user['user_id'] ?>',
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
