<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      classroom_id		</th>
 		<th width="80px">
		      exam_id		</th>
 		<th width="80px">
		      name		</th>
 		<th width="80px">
		      description		</th>
 		<th width="80px">
		      date_test		</th>
 		<th width="80px">
		      time_start		</th>
 		<th width="80px">
		      time_end		</th>
 		<th width="80px">
		      exam_total		</th>
 		<th width="80px">
		      created		</th>
 		<th width="80px">
		      created_user_id		</th>
 		<th width="80px">
		      modified		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->classroom_id; ?>
		</td>
       		<td>
			<?php echo $row->exam_id; ?>
		</td>
       		<td>
			<?php echo $row->name; ?>
		</td>
       		<td>
			<?php echo $row->description; ?>
		</td>
       		<td>
			<?php echo $row->date_test; ?>
		</td>
       		<td>
			<?php echo $row->time_start; ?>
		</td>
       		<td>
			<?php echo $row->time_end; ?>
		</td>
       		<td>
			<?php echo $row->exam_total; ?>
		</td>
       		<td>
			<?php echo $row->created; ?>
		</td>
       		<td>
			<?php echo $row->created_user_id; ?>
		</td>
       		<td>
			<?php echo $row->modified; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
