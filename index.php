<?php
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// change the following paths if necessary
require_once(dirname(__FILE__).'/ams/config/akademik.smpplusalkautsar.php'); // change this line for configuration
require_once(dirname(__FILE__) . '/ams/globals.php');
require_once(dirname(__FILE__).'/ams/lib/yii/yii.php');


$config_app=require(dirname(__FILE__).'/ams/config/main.php');
$config_index = array('theme' => 'spr');
$config = CMap::mergeArray($config_index, $config_app);

Yii::createWebApplication($config)->run();


?>
