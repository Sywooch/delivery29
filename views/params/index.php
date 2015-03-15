<div class="container">
<h1>Параметры</h1>
<hr>
	<table class="table">
		<thead>
			<tr>
				<th>Имя</th>
				<th>Значение</th>
			</tr>
		</thead>
		<tbody class="js-add-row">
			<?php 
				foreach ($data as $key => $value) {
					?>
					<tr>
					<td><?php echo $key?></td>
					<td class="js-edit-param" data-name="<?php echo $key?>"><?php echo $value?></td>
					</tr>
					<?php
				}
			?>
		</tbody>
	</table>
	<button class="btn btn-success" onclick="addParam()">+</button>
</div>
<script src="/js/admin/params.js"></script>