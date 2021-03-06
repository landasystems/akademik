<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="Landa - Profesional Website Development" />
        <meta name="application-name" content="Application Default" />
        <link rel="shortcut icon" href="<?php echo bu() ?>/images/favicon.ico" />

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?php
        landa()->loginRequired();
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCssFile(bu() . '/css/icons.css');
        $cs->registerCssFile(bu() . '/css/main.css');
        ?>     
        <script type="text/javascript">
            //adding load class to body and hide page
            document.documentElement.className += 'loadstate';
        </script>
    </head>
    <body>
        <img src="<?php echo bu("images/loaders/horizontal/004.gif") ?>" id="loader" />
        <!-- loading animation -->
        <div id="qLoverlay"></div>
        <div id="qLbar"></div>

        <div id="header">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="brand" href="<?php echo url('dashboard') ?>">
                            <?php
                            $siteConfig = SiteConfig::model()->listSiteConfig();
                            echo $siteConfig->client_name;
                            ?>
                        </a>
                        <div class="nav-no-collapse">

                            <ul class="nav">
                                <?php if (user()->isSuperUser) { ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <span class="icon16 icomoon-icon-cog"></span> Settings
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="menu">
                                                <?php
                                                $this->widget('zii.widgets.CMenu', array(
                                                    'items' => array(
                                                        array('label' => '<span class="icon16 iconic-icon-new-window"></span>Site config', 'url' => array('/siteConfig/update', 'id' => param('id'))),
                                                        array('visible' => in_array('inventory', param('menu')), 'label' => '<span class="icon16 minia-icon-office"></span>Unit Kerja', 'url' => array('/departement')),
                                                        array('label' => '<span class="icon16 entypo-icon-users"></span>Access', 'url' => array('/landa/roles')),
                                                    ),
                                                    'encodeLabel' => false,
                                                ));
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                

                            </ul>

                            
                        </div><!-- /.nav-collapse -->
                    </div>
                </div><!-- /navbar-inner -->
            </div><!-- /navbar --> 
        </div><!-- End #header -->

        <div id="wrapper">


            <!--Body content-->
            <div id="content" class="clearfix" style="margin-left: 0px;">
                <div class="contentwrapper"><!--Content wrapper-->

                    <div class="heading">

                        <h3><?php echo CHtml::encode($this->pageTitle); ?></h3>                    



                        <div class="search">
                            <?php // $this->widget('common.extensions.landa.widgets.LandaSearch', array('url' => url('user/searchJson'), 'class' => 'input-text')); ?>
                        </div><!-- End search -->

                        <?php if (isset($this->breadcrumbs)): ?>
                            <?php
                            $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links' => $this->breadcrumbs,
                                'htmlOptions' => array('class' => 'breadcrumb'),
                                'separator' => '<span class="divider"><span class="icon16 icomoon-icon-arrow-right"></span></span>',
                                'homeLink' => '<a href="/site/index" class="tip" title="back to dashboard"><span class="icon16 icomoon-icon-screen"></span></a>'
                            ));
                            ?><!-- breadcrumbs -->
                        <?php endif ?>

                    </div><!-- End .heading-->
                    <div class="clearfix"></div>
                    <!-- Build page from here: -->
                    <?php echo $content; ?>
                    <!-- End Build page -->
                </div><!-- End contentwrapper -->
                <div id="footer" class="span12">
                    <?php echo app()->name . ' ' . param('appVersion') ?>  ©  2013 All Rights Reserved. Designed and Developed by : <a href="http://www.landa.co.id" target="_blank">Landa Systems</a>
                </div>
            </div>
            <!-- End #content -->
        </div><!-- End #wrapper -->
        
        <?php
        $cs->registerScriptFile(bu() . '/js/main.js', CClientScript::POS_END);
        ?>
    </body>
</html>
