<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="author" content="Landa - Profesional Website Development" />
        <meta name="application-name" content="Application Default" />
        <link rel="shortcut icon" href="<?php echo bt() ?>/images/favicon.ico" />

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?php
        landa()->loginRequired();
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCssFile(bt() . '/css/main.css');
        $cs->registerCssFile(bt() . '/css/icons.css');
        ?>     

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />

        <script type="text/javascript">
            //adding load class to body and hide page
            document.documentElement.className += 'loadstate';
        </script>
    </head>
    <body>
        <img src="<?php echo bt("images/loaders/horizontal/004.gif") ?>" id="loader" />
        <!-- loading animation -->
        <div id="qLoverlay"></div>
        <div id="wrapper">
            <!--Responsive navigation button-->  
            <div class="resBtn">
                <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
            </div>


            <!--Body content-->
            <div id="content" class="clearfix" style="">
                <div class="contentwrapper"><!--Content wrapper-->
                    <div class="heading">
                        <h3><?php echo CHtml::encode($this->pageTitle); ?></h3>                    
                        <div class="breadcrumb">
<a href="/site/index" class="tip" title="back to dashboard"><span class="icon16 icomoon-icon-user-2"></span></a><span class="divider"><span class="icon16 icomoon-icon-arrow-right"></span></span>
<span><?php echo user()->name ?></span></div>

                    </div><!-- End .heading-->
                    <div class="clearfix"></div>
                    <!-- Build page from here: -->
                    <?php echo $content; ?>
                    <!-- End Build page -->
                </div><!-- End contentwrapper -->
                <div id="footer" class="span12">
                    <?php echo app()->name . ' ' . param('appVersion') ?> ©  2013 All Rights Reserved. Designed and Developed by : <a href="http://www.landa.co.id" target="_blank">Landa Systems</a>
                </div>
            </div>
            <!-- End #content -->
        </div><!-- End #wrapper -->
        <?php
        $cs->registerScriptFile(bt() . '/js/main.js', CClientScript::POS_END);
        ?>
    </body>
</html>
