
<?php if ($type == "register") { ?>
    <div class="control-group">
        <label class="control-label">Generated Identity Number</label>
        <div class="controls">
            <?php
            $this->widget(
                    'bootstrap.widgets.TbToggleButton', array(
                'name' => 'options[register_is_generate_code]',
                'value' => (isset($model->options->register_is_generate_code)) ? $model->options->register_is_generate_code : 0,
                    )
            );
            ?>
        </div>        
    </div>
    <div class="control-group">
        <label class="control-label">Generated Password</label>
        <div class="controls">
            <?php
            $this->widget(
                    'bootstrap.widgets.TbToggleButton', array(
                'name' => 'options[register_is_generate_password]',
                'value' => (isset($model->options->register_is_generate_password)) ? $model->options->register_is_generate_password : 0,
                    )
            );
            ?>
        </div>        
    </div>

    <div class="control-group">
        <label class="control-label">Set Enabled</label>
        <div class="controls">
            <?php
            $this->widget(
                    'bootstrap.widgets.TbToggleButton', array(
                'name' => 'options[status_register]',
                'value' => (isset($model->options->status_register)) ? $model->options->status_register : 0,
                    )
            );
            ?>
        </div>        
    </div>
    <div class="control-group">
        <label class="control-label">Set Roles</label>
        <div class="controls">
            <?php
            echo CHtml::dropDownList('options[roles_id]', (isset($model->options->roles_id)) ? $model->options->roles_id : '', CHtml::listData(Roles::model()->listRoles(), 'id', 'name'), array(
                'empty' => t('choose', 'global'),
            ));
            ?>
        </div>        
    </div>

    <div class="control-group">
        <label class="control-label">Initial Saldo</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on">Rp.</span>
                <?php echo CHtml::textField('options[saldo]', (isset($model->options->saldo)) ? $model->options->saldo : '', array('class' => 'span2')); ?>
            </div>
        </div>        
    </div>
    <div class="control-group reply-all">
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Sudah Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
<?php } elseif ($type == "update") { ?>
    <div class="control-group">
        <label class="control-label">Generated Password</label>
        <div class="controls">
            <?php
            $this->widget(
                    'bootstrap.widgets.TbToggleButton', array(
                'name' => 'options[is_generate_password]',
                'value' => (isset($model->options->is_generate_password)) ? $model->options->is_generate_password : 0,
                    )
            );
            ?>
        </div>        
    </div>
    <div class="control-group reply-all">
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Password Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_password]', (isset($model->autoreplys->failed_password)) ? $model->autoreplys->failed_password : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
<?php } elseif ($type == "saldo") { ?>

    <div class="control-group reply-saldo">
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>

<?php } elseif ($type == "transfer") { ?>
    <div class="control-group reply-transfer" >
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Nomer Tujuan Tidak Ada)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_wrong_destination]', (isset($model->autoreplys->failed_wrong_destination)) ? $model->autoreplys->failed_wrong_destination : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Saldo Tidak Mencukupi)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[saldo_not_enough]', (isset($model->autoreplys->saldo_not_enough)) ? $model->autoreplys->saldo_not_enough : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Password Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_password]', (isset($model->autoreplys->failed_password)) ? $model->autoreplys->failed_password : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>

<?php } elseif ($type == "2d") {
    ?>
    <div class="control-group reply-play2d" >
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Saldo Tidak Mencukupi)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[saldo_not_enough]', (isset($model->autoreplys->saldo_not_enough)) ? $model->autoreplys->saldo_not_enough : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Salah Digit)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[wrong_digit]', (isset($model->autoreplys->wrong_digit)) ? $model->autoreplys->wrong_digit : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Keluaran tidak tersedia)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[wrong_output]', (isset($model->autoreplys->wrong_output)) ? $model->autoreplys->wrong_output : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Password Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_password]', (isset($model->autoreplys->failed_password)) ? $model->autoreplys->failed_password : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
<?php } elseif ($type == "3d") { ?>
    <div class="control-group reply-play2d" >
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Saldo Tidak Mencukupi)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[saldo_not_enough]', (isset($model->autoreplys->saldo_not_enough)) ? $model->autoreplys->saldo_not_enough : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Salah Digit)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[wrong_digit]', (isset($model->autoreplys->wrong_digit)) ? $model->autoreplys->wrong_digit : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Keluaran tidak tersedia)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[wrong_output]', (isset($model->autoreplys->wrong_output)) ? $model->autoreplys->wrong_output : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Password Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_password]', (isset($model->autoreplys->failed_password)) ? $model->autoreplys->failed_password : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
<?php } elseif ($type == "4d") {
    ?>
    <div class="control-group reply-play2d" >
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Saldo Tidak Mencukupi)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[saldo_not_enough]', (isset($model->autoreplys->saldo_not_enough)) ? $model->autoreplys->saldo_not_enough : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Salah Digit)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[wrong_digit]', (isset($model->autoreplys->wrong_digit)) ? $model->autoreplys->wrong_digit : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Keluaran tidak tersedia)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[wrong_output]', (isset($model->autoreplys->wrong_output)) ? $model->autoreplys->wrong_output : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Password Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_password]', (isset($model->autoreplys->failed_password)) ? $model->autoreplys->failed_password : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
<?php } elseif ($type == "deposit") { ?>
    <div class="control-group reply-deposit" >
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr

                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
<?php } elseif ($type == "withdrawal") { ?>
    <div class="control-group reply-withdrawal" >
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_register]', (isset($model->autoreplys->failed_register)) ? $model->autoreplys->failed_register : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Password Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_password]', (isset($model->autoreplys->failed_password)) ? $model->autoreplys->failed_password : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Berhasil</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[success]', (isset($model->autoreplys->success)) ? $model->autoreplys->success : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
            </table>
        </div>        
    </div>
<?php } elseif ($type == "playresult") { ?>
    <div class="control-group reply-playresult" >
        <label class="control-label">Auto Reply</label>
        <div class="controls">
            <table class="table table-striped">
                <tr>
                    <th>Kondisi</th>
                    <th>Balasan</th>
                </tr>
                <tr>
                    <td>Gagal <br/> (Keyword Salah)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_keyword]', (isset($model->autoreplys->failed_keyword)) ? $model->autoreplys->failed_keyword : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal <br/> (Nomor Belum Terdaftar)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[failed_any_number]', (isset($model->autoreplys->failed_any_number)) ? $model->autoreplys->failed_any_number : '', array('class' => 'span4')); ?>
                    </td>
                </tr>
                <tr>
                    <td>Gagal<br>(Keluaran tidak tersedia)</td>
                    <td>: 
                        <?php echo CHtml::textArea('autoreplys[wrong_output]', (isset($model->autoreplys->wrong_output)) ? $model->autoreplys->wrong_output : '', array('class' => 'span4')); ?>
                    </td>
                </tr>

            </table>
        </div>        
    </div>
<?php } ?>

