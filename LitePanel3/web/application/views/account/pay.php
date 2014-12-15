<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Пополнение баланса</h1>
				</div>
				<form class="form-horizontal" action="#" id="payForm" method="POST">
					<h3>Основная информация</h3>
					<div class="form-group">
						<label for="ammount" class="col-sm-3 control-label">Сумма:</label>
						<div class="col-sm-3">
							<div class="input-group">
								<input type="text" class="form-control" id="ammount" name="ammount" placeholder="Введите сумму">
								<span class="input-group-addon">руб.</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Продолжить</button>
						</div>
					</div>
				</form>
				<script>
					$('#payForm').ajaxForm({ 
						url: '/account/pay/ajax',
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
									redirect(data.url);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
				</script>
<?php echo $footer ?>
