<?php

include_once('./public/inc.php');
error_reporting(0);
//include_once('../class/export.class.php');
//include_once('../class/record.class.php');
$fileName = date('Y-m-d ah:i:s').'���۷����ƻ���';
$title = array(
    '��ˮ��',
    '���ݺ�',
    '��ҵ��',
    '��ͬ��',
    '��ע',
    '��Ʒ',
    '��λ',
    '����',
    '��������',
    '�����ͻ�',
    '�ƻ�����ʱ��',
    '��ǩҪ��',
    '��ͷ����',
    '����Ҫ��',
    '����Ҫ��',
    '������װҪ��',
    '������',
    '�������',
    '����ʱ��',
    '�������',
    '���κ�',
    '��������',
);
$obj = new delivery();
$result = $obj->getList();
$value = array();
$i = 0;
$j = 0;
foreach($result as $v)
{
    $value[$i]['run_id']                = $v['run_id'];
    $value[$i]['run_name']              = $v['run_name'];
    $value[$i]['department']            = $v['department'];
    $value[$i]['contractNo']            = $v['contractNo'];
    $value[$i]['remark']                = $v['remark'];
    $value[$i]['product']               = $v['product'];
    $value[$i]['unit']                  = $v['unit'];
    $value[$i]['amount']                = $v['amount'];
    $value[$i]['country']               = $v['country'];
    $value[$i]['custom']                = $v['custom'];
    $value[$i]['planTime']              = $v['planTime'];
    $value[$i]['label']                 = $v['label'];
    $value[$i]['mark']                  = $v['mark'];
    $value[$i]['quality']               = $v['quality'];
    $value[$i]['reportRequirement']     = $v['reportRequirement'];
    $value[$i]['package']               = $v['package'];
    $value[$i]['ChargePerson']          = $v['ChargePerson'];
    $value[$i]['shipStatus']            = $v['shipStatus'];
    $value[$i]['shipDate']              = $v['shipDate'];
    $value[$i]['reportStatus']          = $v['reportStatus'];
    foreach($v['patch'] as $val)
    {
        $value[$i]['subPath']           = $val['patch'];
        $value[$i]['subAmount']         = $val['amount'];
        $i++;
        $value[$i]['run_id']            = ' ';
        $value[$i]['run_name']          = ' ';
        $value[$i]['department']        = ' ';
        $value[$i]['contractNo']        = ' ';
        $value[$i]['remark']            = ' ';
        $value[$i]['product']           = ' ';
        $value[$i]['unit']              = ' ';
        $value[$i]['amount']            = ' ';
        $value[$i]['country']           = ' ';
        $value[$i]['custom']            = ' ';
        $value[$i]['planTime']          = ' ';
        $value[$i]['label']             = ' ';
        $value[$i]['mark']              = ' ';
        $value[$i]['quality']           = ' ';
        $value[$i]['reportRequirement'] = ' ';
        $value[$i]['package']           = ' ';
        $value[$i]['ChargePerson']      = ' ';
        $value[$i]['shipStatus']        = ' ';
        $value[$i]['shipDate']          = ' ';
        $value[$i]['reportStatus']      = ' ';
    }
    $i++;
}
new export($fileName,$title,$value);