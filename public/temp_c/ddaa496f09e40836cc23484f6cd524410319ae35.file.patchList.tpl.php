<?php /* Smarty version Smarty-3.1.19, created on 2019-07-02 16:53:08
         compiled from ".\public.\temp\patchList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203745d1b1b740f4244-20124668%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddaa496f09e40836cc23484f6cd524410319ae35' => 
    array (
      0 => '.\\public.\\temp\\patchList.tpl',
      1 => 1561971953,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203745d1b1b740f4244-20124668',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'para' => 0,
    'item' => 0,
    'subItem' => 0,
    'page' => 0,
    'val' => 0,
    'count' => 0,
    'nowPage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d1b1b741ee2b4_69891621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d1b1b741ee2b4_69891621')) {function content_5d1b1b741ee2b4_69891621($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="head">
    <h1><img src="./public/temp/images/logo.png">国药集团威奇达药业有限公司</h1>
</div>

<h3>发货计划列表<a class="buttonLink" href="./export.php">导出</a></h3>

<table>
    <thead>
    <th>流水号</th>
    <th>单据号</th>
    <th>事业部</th>
    <th>合同号</th>
    <th>产品</th>
    <th>数量</th>
    <th>单位</th>
    <th>发往国家</th>
    <th>发往客户</th>
    <th>批次</th>
    <th>操作</th>

    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['para']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['run_id'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['run_name'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['department'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['contractNo'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['product'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['amount'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['unit'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['country'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['custom'];?>
</td>
        <td>
            <?php  $_smarty_tpl->tpl_vars['subItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['patch']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subItem']->key => $_smarty_tpl->tpl_vars['subItem']->value) {
$_smarty_tpl->tpl_vars['subItem']->_loop = true;
?>
                <?php echo $_smarty_tpl->tpl_vars['subItem']->value['patch'];?>
,
            <?php } ?>
        </td>
        <td><a href="http://oa.weiqida.com:2000/general/workflow/list/print.php?RUN_ID=<?php echo $_smarty_tpl->tpl_vars['item']->value['run_id'];?>
&FLOW_ID=172&FLOW_VIEW=1234">详情</a></td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<div class="page">

    <ul>
        <?php $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['val']->step = 1;$_smarty_tpl->tpl_vars['val']->total = (int) ceil(($_smarty_tpl->tpl_vars['val']->step > 0 ? $_smarty_tpl->tpl_vars['page']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['page']->value)+1)/abs($_smarty_tpl->tpl_vars['val']->step));
if ($_smarty_tpl->tpl_vars['val']->total > 0) {
for ($_smarty_tpl->tpl_vars['val']->value = 1, $_smarty_tpl->tpl_vars['val']->iteration = 1;$_smarty_tpl->tpl_vars['val']->iteration <= $_smarty_tpl->tpl_vars['val']->total;$_smarty_tpl->tpl_vars['val']->value += $_smarty_tpl->tpl_vars['val']->step, $_smarty_tpl->tpl_vars['val']->iteration++) {
$_smarty_tpl->tpl_vars['val']->first = $_smarty_tpl->tpl_vars['val']->iteration == 1;$_smarty_tpl->tpl_vars['val']->last = $_smarty_tpl->tpl_vars['val']->iteration == $_smarty_tpl->tpl_vars['val']->total;?>
        <li><a href="?page=<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</a></li>

        <?php }} ?>
    </ul>
    共<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
条/共<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
页  第<?php echo $_smarty_tpl->tpl_vars['nowPage']->value;?>
页
</div>

<?php }} ?>
