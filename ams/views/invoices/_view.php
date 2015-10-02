<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('payment')); ?>:</b>
    <?php echo CHtml::encode($data->payment); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('due_date')); ?>:</b>
    <?php echo CHtml::encode($data->due_date); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('client')); ?>:</b>
    <?php echo CHtml::encode($data->client); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
    <?php echo CHtml::encode($data->created); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
    <?php echo CHtml::encode($data->modified); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('created_user_id')); ?>:</b>
    <?php echo CHtml::encode($data->created_user_id); ?>
    <br />
  
</div>