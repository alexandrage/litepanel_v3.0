<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Запрос в службу поддержки #<?php echo $ticket['ticket_id'] ?></h1>
				</div>
    			<div class="panel panel-success">
					<div class="panel-heading">Информация о запросе</div>
					<table class="table">
						<tr>
							<th>Тема:</th>
							<td><?php echo $ticket['ticket_name'] ?></td>
						</tr>
						<tr>
							<th>Автор</th>
							<td><?php echo $ticket['user_firstname'] ?> <?php echo $ticket['user_lastname'] ?></td>
						</tr>
						<tr>
							<th>Дата создания:</th>
							<td><?php echo date("d.m.Y в H:i", strtotime($ticket['ticket_date_add'])) ?></td>
						</tr>
						<tr>
							<th>Статус:</th>
							<td>
								<?php if($ticket['ticket_status'] == 0): ?> 
								<span class="label label-danger">Закрыт</span>
								<?php elseif($ticket['ticket_status'] == 1): ?> 
								<span class="label label-success">Открыт</span>
								<?php endif; ?> 
							</td>
						</tr>
					</table>
				</div>
				<?php foreach($messages as $item): ?> 
				<div class="panel panel-default">
					<div class="panel-body"><?php echo nl2br($item['ticket_message']) ?></div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-6 text-muted text-left">
								<span class="glyphicon glyphicon-calendar"></span> <?php echo date("d.m.Y в H:i", strtotime($item['ticket_message_date_add'])) ?> 
							</div>
							<div class="col-md-6 text-muted text-right">
								<span class="glyphicon glyphicon-user"></span> <?php echo $item['user_firstname'] ?> <?php echo $item['user_lastname'] ?> 
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?> 
				<?php if($ticket['ticket_status'] == 1): ?> 
				<h2>Отправить сообщение</h2>
				<form class="form-horizontal" id="sendForm" action="#" method="POST">
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">Текст:</label>
						<div class="col-sm-7">
							<textarea class="form-control" id="text" name="text" rows="3" placeholder="Введите текст сообщения"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<div class="checkbox">
								<label><input type="checkbox" id="closeticket" name="closeticket" onChange="toggleText()"> Закрыть запрос</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-primary">Отправить</button>
						</div>
					</div>
				</form>
				<script>
					$('#sendForm').ajaxForm({ 
						url: '/admin/tickets/view/ajax/<?php echo $ticket['ticket_id'] ?>',
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
									$('#text').val('');
									setTimeout("reload()", 1500);
									break;
							}
						},
						beforeSubmit: function(arr, $form, options) {
							$('button[type=submit]').prop('disabled', true);
						}
					});
					function toggleText() {
						var status = $('#closeticket').is(':checked');
						if(status) {
							$('#text').prop('disabled', true);
						} else {
							$('#text').prop('disabled', false);
						}
					}
				</script>
				<?php endif; ?>
<?php echo $footer ?>
