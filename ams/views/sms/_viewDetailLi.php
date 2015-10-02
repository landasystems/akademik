
<li class="<?php echo $type ?> clearfix h<?php echo $userMessageDetail->id ?> msgDet">
    <form action="/berkas-buat-pesan/" method="post">
        <a href="#" class="avatar">
            <img src="<?php echo $img['small'] ?>" width="40" class="img-polaroid"/>            
        </a>

        <div class="message">
            <div class="head clearfix">
                <span class="name"><strong><?php echo $name ?></strong> says : </span>
                <span class="time">
                    <?php
                    echo CHtml::ajaxLink(
                            '<i class="icon-trash"></i>', url('smsDetail/delete', array('id' => $userMessageDetail->id)), array(// ajaxOptions
                        'type' => 'POST',
                        'success' => 'function( data )
                                        {
                                          $(".h' . $userMessageDetail->id . '").fadeOut();
                                        }',
                            )
                    );
                    ?>
                </span>
            </div>
            <input type="hidden" name="isi_pesan" id="isi_pesan" value="{messages}"/>
            <?php
            if ($type == 'admin') {
                echo '<div style="float:left">'.SmsDetail::model()->labelStatus($userMessageDetail->status).'</div>';
            }
            ?>
            <div style="<?php echo ($type == 'admin') ? 'float:right;text-align: right;' : '' ?>" class="span8">
                <?php echo $userMessageDetail->message ?>
                <?php
                if (empty($userMessageDetail->date_received))
                    $date = $userMessageDetail->created;
                else
                    $date = $userMessageDetail->date_received;
                ?>
                <br/><small>-- <?php echo Yii::app()->landa->ago($date) ?> --</small>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
</li>



