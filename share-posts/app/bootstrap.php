<?php 
//Load config
require_once 'config/config.php';
require_once 'helpers/helpers.php';
//autoload core libraries https://www.php.net/manual/en/function.spl-autoload-register.php
spl_autoload_register(function($className){
    require_once 'libraries/'.$className.'.php';
});