{<include file='head.tpl'>}
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
    {<foreach $para as $item>}
    <tr>
        <td>{<$item['run_id']>}</td>
        <td>{<$item['run_name']>}</td>
        <td>{<$item['department']>}</td>
        <td>{<$item['contractNo']>}</td>
        <td>{<$item['product']>}</td>
        <td>{<$item['amount']>}</td>
        <td>{<$item['unit']>}</td>
        <td>{<$item['country']>}</td>
        <td>{<$item['custom']>}</td>
        <td>
            {<foreach $item['patch'] as $subItem>}
                {<$subItem['patch']>},
            {</foreach>}
        </td>
        <td><a href="http://oa.weiqida.com:2000/general/workflow/list/print.php?RUN_ID={<$item['run_id']>}&FLOW_ID=172&FLOW_VIEW=1234">详情</a></td>
    </tr>
    {</foreach>}
    </tbody>
</table>

<div class="page">

    <ul>
        {<for $val= 1 to $page>}
        <li><a href="?page={<$val>}">{<$val>}</a></li>

        {</for>}
    </ul>
    共{<$count>}条/共{<$page>}页  第{<$nowPage>}页
</div>

