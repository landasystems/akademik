<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      sms_id		</th>
 		<th width="80px">
		      message		</th>
 		<th width="80px">
		      created_user_id		</th>
 		<th width="80px">
		      created		</th>
 		<th width="80px">
		      modified		</th>
 		<th width="80px">
		      is_process		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->sms_id; ?>
		</td>
       		<td>
			<?php echo $row->message; ?>
		</td>
       		<td>
			<?php echo $row->created_user_id; ?>
		</td>
       		<td>
			<?php echo $row->created; ?>
		</td>
       		<td>
			<?php echo $row->modified; ?>
		</td>
       		<td>
			<?php echo $row->is_process; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
