<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      created_user_id		</th>
 		<th width="80px">
		      last_date		</th>
 		<th width="80px">
		      last_message		</th>
 		<th width="80px">
		      count_message		</th>
 		<th width="80px">
		      is_read		</th>
 		<th width="80px">
		      phone		</th>
 		<th width="80px">
		      type		</th>
 		<th width="80px">
		      type_phones		</th>
 		<th width="80px">
		      type_roles_ids		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->created_user_id; ?>
		</td>
       		<td>
			<?php echo $row->last_date; ?>
		</td>
       		<td>
			<?php echo $row->last_message; ?>
		</td>
       		<td>
			<?php echo $row->count_message; ?>
		</td>
       		<td>
			<?php echo $row->is_read; ?>
		</td>
       		<td>
			<?php echo $row->phone; ?>
		</td>
       		<td>
			<?php echo $row->type; ?>
		</td>
       		<td>
			<?php echo $row->type_phones; ?>
		</td>
       		<td>
			<?php echo $row->type_roles_ids; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
