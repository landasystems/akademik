<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      exam_id		</th>
 		<th width="80px">
		      number		</th>
 		<th width="80px">
		      question		</th>
 		<th width="80px">
		      answer		</th>
 		<th width="80px">
		      type		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->exam_id; ?>
		</td>
       		<td>
			<?php echo $row->number; ?>
		</td>
       		<td>
			<?php echo $row->question; ?>
		</td>
       		<td>
			<?php echo $row->answer; ?>
		</td>
       		<td>
			<?php echo $row->type; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
