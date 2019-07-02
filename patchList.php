<?php
include_once('./public/inc.php');
$sellList = new delivery();
$para = $sellList->getList($_GET['page']);
$count = $sellList->getCount();
$page = $sellList->getPage();
$smarty->assign('para',$para);
$smarty->assign('count',$count);
$smarty->assign('page',$page);
$smarty->display('patchList.tpl');