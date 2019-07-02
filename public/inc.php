<?php
    //error_reporting(E_ALL^E_NOTICE^E_WARNING);
    include_once('inc/auth.php');
    include_once('./public/./Smarty/libs/Smarty.class.php');
    //include_once('../public/./session.php');
    include_once('./public/./class/database.class.php');
    include_once('./public/./class/filter.class.php');
    include_once('./public/./class/record.class.php');
    include_once('./public/./class/user.class.php');
    include_once('./public/./class/export.class.php');
    include_once('./public/./class/delivery.class.php');

    $smarty = new Smarty();
    $smarty->template_dir       = './public./temp/';
    $smarty->compile_dir        = './public./temp_c/';
    $smarty->config_dir         = './public./configs/';
    $smarty->cache_dir          = './public./cache/';
    $smarty->left_delimiter     = "{<";
    $smarty->right_delimiter    = ">}";

