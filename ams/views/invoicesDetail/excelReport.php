<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      invoices_id		</th>
 		<th width="80px">
		      description		</th>
 		<th width="80px">
		      price		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->invoices_id; ?>
		</td>
       		<td>
			<?php echo $row->description; ?>
		</td>
       		<td>
			<?php echo $row->price; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
