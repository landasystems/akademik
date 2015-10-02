<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      payment		</th>
 		<th width="80px">
		      due_date		</th>
 		<th width="80px">
		      client		</th>
 		<th width="80px">
		      created		</th>
 		<th width="80px">
		      modified		</th>
 		<th width="80px">
		      created_user_id		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->payment; ?>
		</td>
       		<td>
			<?php echo $row->due_date; ?>
		</td>
       		<td>
			<?php echo $row->client; ?>
		</td>
       		<td>
			<?php echo $row->created; ?>
		</td>
       		<td>
			<?php echo $row->modified; ?>
		</td>
       		<td>
			<?php echo $row->created_user_id; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
