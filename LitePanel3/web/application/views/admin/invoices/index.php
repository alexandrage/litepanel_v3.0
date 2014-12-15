<?php
/*
* @LitePanel
* @Developed by QuickDevel
*/
?>
<?php echo $header ?>
				<div class="page-header">
					<h1>Все счета</h1>
				</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Пользователь</th>
							<th>Сумма</th>
							<th>Дата создания</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($invoices as $item): ?> 
						<tr>
							<td>#<?php echo $item['invoice_id'] ?></td>
							<td>
								<?php if($item['invoice_status'] == 0): ?> 
								<span class="label label-warning">Не оплачен</span>
								<?php elseif($item['invoice_status'] == 1): ?> 
								<span class="label label-success">Оплачен</span>
								<?php endif; ?> 
							</td>
							<td><?php echo $item['user_firstname'] ?> <?php echo $item['user_lastname'] ?></td>
							<td><?php echo $item['invoice_ammount'] ?> руб.</td>
							<td><?php echo date("d.m.Y в H:i", strtotime($item['invoice_date_add'])) ?></td>
						</tr>
						<?php endforeach; ?> 
						<?php if(empty($invoices)): ?> 
						<tr>
							<td colspan="5" style="text-align: center;">На данный момент нет счетов.</td>
						<tr>
						<?php endif; ?> 
					</tbody>
				</table>
				<?php echo $pagination ?> 
<?php echo $footer ?>
