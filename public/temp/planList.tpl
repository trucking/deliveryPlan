{<include file='head.tpl'>}
<div class="head">
    <h1><img src="./public/temp/images/logo.png">��ҩ���������ҩҵ���޹�˾</h1>
</div>

<h3>�����ƻ��б�</h3>
<table>
    <thead>
        <th>��ˮ��</th>
        <th>���ݺ�</th>
        <th>��ҵ��</th>
        <th>��ͬ��</th>
        <th>��Ʒ</th>
        <th>����</th>
        <th>��λ</th>
        <th>��������</th>
        <th>�����ͻ�</th>
        <th>״̬</th>
        <th>����</th>

    </thead>
    <tbody>
    {<foreach $para as $item>}
    {<if $item['prcs'] eq 1>}
    <tr class="prcs1">
        <td>{<$item['run_id']>}</td>
        <td>{<$item['run_name']>}</td>
        <td>{<$item['department']>}</td>
        <td>{<$item['contractNo']>}</td>
        <td>{<$item['product']>}</td>
        <td>{<$item['amount']>}</td>
        <td>{<$item['unit']>}</td>
        <td>{<$item['country']>}</td>
        <td>{<$item['custom']>}</td>
        <td>��д�ƻ�</td>
        <td><a href="http://oa.weiqida.com:2000/general/workflow/list/print.php?RUN_ID={<$item['run_id']>}&FLOW_ID=172&FLOW_VIEW=1234">����</a></td>
    </tr>
    {<elseif $item['prcs'] eq 2>}
    <tr class="prcs2">
        <td>{<$item['run_id']>}</td>
        <td>{<$item['run_name']>}</td>
        <td>{<$item['department']>}</td>
        <td>{<$item['contractNo']>}</td>
        <td>{<$item['product']>}</td>
        <td>{<$item['amount']>}</td>
        <td>{<$item['unit']>}</td>
        <td>{<$item['country']>}</td>
        <td>{<$item['custom']>}</td>
        <td>��ѡ����</td>
        <td><a href="http://oa.weiqida.com:2000/general/workflow/list/print.php?RUN_ID={<$item['run_id']>}&FLOW_ID=172&FLOW_VIEW=1234">����</a></td>
    </tr>
    {<elseif $item['prcs'] eq 3>}
    <tr class="prcs3">
        <td>{<$item['run_id']>}</td>
        <td>{<$item['run_name']>}</td>
        <td>{<$item['department']>}</td>
        <td>{<$item['contractNo']>}</td>
        <td>{<$item['product']>}</td>
        <td>{<$item['amount']>}</td>
        <td>{<$item['unit']>}</td>
        <td>{<$item['country']>}</td>
        <td>{<$item['custom']>}</td>
        <td>ά������</td>
        <td><a href="http://oa.weiqida.com:2000/general/workflow/list/print.php?RUN_ID={<$item['run_id']>}&FLOW_ID=172&FLOW_VIEW=1234">����</a></td>
    </tr>
    {<elseif $item['prcs'] eq 4>}
    <tr class="prcs4">
        <td>{<$item['run_id']>}</td>
        <td>{<$item['run_name']>}</td>
        <td>{<$item['department']>}</td>
        <td>{<$item['contractNo']>}</td>
        <td>{<$item['product']>}</td>
        <td>{<$item['amount']>}</td>
        <td>{<$item['unit']>}</td>
        <td>{<$item['country']>}</td>
        <td>{<$item['custom']>}</td>
        <td>ά������</td>
        <td><a href="http://oa.weiqida.com:2000/general/workflow/list/print.php?RUN_ID={<$item['run_id']>}&FLOW_ID=172&FLOW_VIEW=1234">����</a></td>
    </tr>
    {<elseif $item['prcs'] eq 5>}
    <tr class="prcs5">
        <td>{<$item['run_id']>}</td>
        <td>{<$item['run_name']>}</td>
        <td>{<$item['department']>}</td>
        <td>{<$item['contractNo']>}</td>
        <td>{<$item['product']>}</td>
        <td>{<$item['amount']>}</td>
        <td>{<$item['unit']>}</td>
        <td>{<$item['country']>}</td>
        <td>{<$item['custom']>}</td>
        <td>���</td>
        <td><a href="http://oa.weiqida.com:2000/general/workflow/list/print.php?RUN_ID={<$item['run_id']>}&FLOW_ID=172&FLOW_VIEW=1234">����</a></td>
    </tr>
    {</if>}
    {</foreach>}
    </tbody>
</table>
<div class="page">
    <ul>
    {<for $val= 1 to $page>}
        <li><a href="?page={<$val>}">{<$val>}</a></li>
    {</for>}
    </ul>
    ��{<$count>}��/��{<$page>}ҳ  ��{<$nowPage>}ҳ
</div>
