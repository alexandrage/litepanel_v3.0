<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Заказать сервер</h1>
				</div>
				<form class="form-horizontal" action="#" id="orderForm" method="POST">
					<h3>Основная информация</h3>
					<div class="form-group">
						<label for="game" class="col-sm-3 control-label">Игра:</label>
						<div class="col-sm-5">
							<select class="form-control" id="gameid" name="gameid" onChange="updateForm()">
								<?php foreach($games as $item): ?> 
								<option value="<?php echo $item['game_id'] ?>"><?php echo $item['game_name'] ?></option>
								<?php endforeach; ?> 
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="location" class="col-sm-3 control-label">Локация:</label>
						<div class="col-sm-5">
							<select class="form-control" id="locationid" name="locationid">
								<?php foreach($locations as $item): ?> 
								<option value="<?php echo $item['location_id'] ?>"><?php echo $item['location_name'] ?></option>
								<?php endforeach; ?> 
							</select>
						</div>
					</div>
					<h3>Дополнительная информация</h3>
					<div class="form-group">
						<label for="months" class="col-sm-3 control-label">Период оплаты:</label>
						<div class="col-sm-3">
							<select class="form-control" id="months" name="months" onChange="updateForm()">
								<option value="1">1 месяц</option>
								<option value="3">3 месяца (-5%)</option>
								<option value="6">6 месяцев (-10%)</option>
								<option value="12">12 месяцев (-15%)</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="months" class="col-sm-3 control-label">Количество слотов:</label>
						<div class="col-sm-2">
							<div class="input-group">
								<span class="input-group-btn"><button class="btn btn-default" type="button" onClick="minusSlots()">-</button></span>
								<input type="text" class="form-control" id="slots" name="slots">
								<span class="input-group-btn"><button class="btn btn-default" type="button" onClick="plusSlots()">+</button></span>
							</div>
						</div>
					</div>
					<h3>Пароль</h3>
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Пароль:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="col-sm-3 control-label">Повторите пароль:</label>
						<div class="col-sm-4">
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите пароль">
						</div>
					</div>
					<h3>Стоимость</h3>
					<div class="form-group">
						<label for="price" class="col-sm-3 control-label">Итого:</label>
						<div class="col-sm-5">
							<p class="lead" id="price">0.00 руб.</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Заказать</button>
						</div>
					</div>
				</form>
				<script>
					var gameData = {
					<?php foreach($games as $item): ?> 
						<?php echo $item['game_id'] ?>: {
							'minslots': <?php echo $item['game_min_slots'] ?>,
							'maxslots': <?php echo $item['game_max_slots'] ?>,
							'price': <?php echo $item['game_price'] ?>
						},
					<?php endforeach; ?> 
					};
					
					$('#orderForm').ajaxForm({ 
						url: '/servers/order/ajax',
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
									setTimeout("redirect('/servers/control/index/" + data.id + "')", 1500);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
							showWarning("Проверяем параметра сервера и счёта");
						}
					});
					
					$(document).ready(function() {
						updateForm();
					});
					
					function updateForm() {
						var gameID = $("#gameid option:selected").val();
						var slots = $("#slots").val();
						if(slots < gameData[gameID]['minslots']) {
							slots = gameData[gameID]['minslots'];
							$("#slots").val(slots);
						}
						if(slots > gameData[gameID]['maxslots']) {
							slots = gameData[gameID]['maxslots'];
							$("#slots").val(slots);
						}
						var price = gameData[gameID]['price'] * slots;
						var months = $("#months option:selected").val();
						switch(months) {
							case "3":
								price = 3 * price * 0.95;
								break;
							case "6":
								price = 6 * price * 0.90;
								break;
							case "12":
								price = 12 * price * 0.85;
								break;
						}
						$('#price').text(price.toFixed(2) + ' руб.');
					}
					
					function plusSlots() {
						value = parseInt($('#slots').val());
						$('#slots').val(value+1);
						updateForm();
					}
					function minusSlots() {
						value = parseInt($('#slots').val());
						$('#slots').val(value-1);
						updateForm();
					}
				</script>
<?php echo $footer ?>
