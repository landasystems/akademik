<?php

    /* @var $this SiteController */
    $this->pageTitle = 'Dashboard - Selamat Datang di Area Administrator';
    $siteConfig = SiteConfig::model()->listSiteConfig();
    ?>

    <div class="row-fluid">
        <div class="span8">
            <div class="row-fluid">


                <?php // } ?>
                <div class="box">
                    <div class="title">
                        <h4>
                            <span class="icon16 iconic-icon-bars"></span>
                            <span>Dokumen Terbaru</span>
                        </h4>
                        <a href="#" class="minimize" style="display: none;">Minimize</a>
                    </div>
                    <div class="content">

                        <?php
                        $this->widget('bootstrap.widgets.TbGridView', array(
                            'id' => 'download-grid',
                            'dataProvider' => new CActiveDataProvider(Download::model(), array('criteria' => array('order' => 'id desc'))),
                            'type' => 'striped bordered condensed',
                            'template' => '{pager}{items}{pager}',
                            'columns' => array(
                                'DownloadCategory.name',
                                array(
                                    'name' => 'File Name',
                                    'value' => '$data->url',
                                    'htmlOptions' => array('style' => 'text-align: left;')
                                ),
//                                'created',
                                /*
                                  'created_user_id',
                                  'modified',
                                 */
                                array(
                                    'value' => '"<a href=\"$data->urlFull\" class=\"btn btn-small icon-download\"></a>"',
                                    'type' => 'raw',
                                    'htmlOptions' => array('style' => 'width: 35px;')
                                ),
                            ),
                        ));
                        ?>      

                    </div>
                </div><!-- End .box -->  
            </div>
        </div>
        <div class="span4">
            <div class="row-fluid">
                <div class="box">
                    <div class="title">

                        <h4>
                            <span class="icon16 silk-icon-office"></span>
                            <span><?php echo $siteConfig->client_name ?></span>
                        </h4>
                    </div>
                    <div class="content">
                        <?php
                        $img = Yii::app()->landa->urlImg('site/', $siteConfig->client_logo, param('id'));
                        echo '<img src="' . $img['big'] . '" class="img-polaroid"/>';
                        ?>
                        <div class="clearfix"></div>
                        <dl>
                            <dt>Address</dt>
                            <dd><?php echo $siteConfig->fullAddress ?></dd>
                            <dt>Telephone</dt>
                            <dd><?php echo $siteConfig->phone ?></dd>
                            <dt>Email</dt>
                            <dd><?php echo $siteConfig->email ?></dd>
                        </dl>
                    </div>

                </div>
                <?php
                    $smsInfo = SmsInfo::model()->find(array('order' => 'id DESC'));
                    ?>
                    <div class="box">
                        <div class="title">
                            <h4>
                                <span class="icon16 minia-icon-mobile"></span>
                                <span>Celullar Information</span>
                            </h4>
                        </div>
                        <div class="content">
                            <div class="row-fluid">
                                <div class="span4"><b>Checking Date</b></div>
                                <div class="span8">: <?php if (!empty($smsInfo)) echo date('d F Y, H:i', strtotime($smsInfo->time_check)) ?></div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4"><b>Provider</b></div>
                                <div class="span8">: <?php if (!empty($smsInfo)) echo $smsInfo->provider ?></div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4"><b>Phone Number</b></div>
                                <div class="span8">: <?php if (!empty($smsInfo)) echo $smsInfo->phone ?></div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4"><b>Info</b></div>
                                <div class="span8">: <?php if (!empty($smsInfo)) echo $smsInfo->content ?></div>
                            </div>
                        </div>
                    </div>
                
                <div class="todo">
                    <h4>Latest Logged-in Users
                        <a href="#" class="icon tip" oldtitle="Configure" title=""><span class="icon16 iconic-icon-cog"></span></a>

                    </h4>
                    <ul>

                        <?php
                        $listUser = User::model()->listUser();
                        $oUserLogs = UserLog::model()->findAll(array('order' => 'created DESC', 'limit' => '5'));
                        foreach ($oUserLogs as $oUserLog) {
//                        if (isset($listUser[$oUserLog->user_id])) {
//                            echo '<li class="clearfix">' .
//                            $listUser[$oUserLog->user_id]['name'] . ' | ' . $listUser[$oUserLog->user_id]['roles_id'] . '
//                        <span class="label pull-right" style="margin-top: 6px;">' . landa()->ago($oUserLog->created) . '</span>
//                        </li> ';
//                        };
                            if (isset($oUserLog->User->Roles->name)) {
                                echo '<li class="clearfix">' .
                                $oUserLog->User->name . ' | ' . $oUserLog->User->Roles->name . '
                        <span class="label pull-right" style="margin-top: 6px;">' . landa()->ago($oUserLog->created) . '</span>
                        </li> ';
                            };
                        }
                        ?>

                    </ul>
                </div><!-- End .reminder -->
            </div>
        </div>
    </div>
