<?php
/*
 *发货计划管理
 *
 */
include_once('database.class.php');

class Delivery
{
    //工作流flow_id为172
    private $flowidOFDelivery = 172;
	/* 	
	 *  获取发货计划
	 *  销售方面列表 ,获取一个主表信息，包括流水号、计划编号、事业部、合同号、产品、数量
	 */
	public function getList($page = 0)
	{
		$item = 'flow_run.run_id,flow_run.run_name,flow_run_data.item_data';
		$table = 'flow_run,flow_run_data';
        if($page == 0)
        {
            $condition = 'flow_run.flow_id = '.$this->flowidOFDelivery.' and flow_run.run_id = flow_run_data.run_id and flow_run.del_flag = 0 ';
        }else
        {
            $condition = 'flow_run.flow_id = '.$this->flowidOFDelivery.' and flow_run.run_id = flow_run_data.run_id and flow_run.del_flag = 0 order by run_id desc limit '. ($page-1) * 200 .', 200';
        }

		$result = Database::select($item,$table,$condition);
		$para = $this->mergeTwoTable($result);
        $para = $this->mergePrcs($para);

		return $para;
	}
    //此方法用于合并flow_run和flow_run_data两个表的数据
    private function mergeTwoTable($arr)
    {
        $para = array();
        $i = 0;
        $j = 0;
        foreach($arr as $val)
        {
            if($j % 20 == 0 && $j != 0)
            {
                $i++;
            }
            $case = $j % 20;
            switch ($case)
            {
                case 0 ://item_id 1 事业部
                    $para[$i]['run_id'] = $val['run_id'];
                    $para[$i]['run_name'] = $val['run_name'];
                    $para[$i]['department'] = $val['item_data'];
                    break;
                case 1 ://item_id 2 单据流水号
                    $para[$i]['planNo'] = $val['item_data'];
                    break;
                case 2 ://item_id 3 合同编号
                    $para[$i]['contractNo'] = $val['item_data'];
                    break;
                case 3 ://item_id 4 备注
                    $para[$i]['remark'] = $val['item_data'];
                    break;
                case 4 ://ITEM_ID 5 物料名称
                    $para[$i]['product'] = $val['item_data'];
                    break;
                case 5 ://ITEM_ID 6 计量单位
                    $para[$i]['unit'] = $val['item_data'];
                    break;
                case 6 ://ITEM_ID 7 发货数量
                    $para[$i]['amount'] = $val['item_data'];
                    break;
                case 7 ://ITEM_ID 8 发往国家
                    $para[$i]['country'] = $val['item_data'];
                    break;
                case 8 ://ITEM_ID 9 客户
                    $para[$i]['custom'] = $val['item_data'];
                    break;
                case 9 ://ITEM_ID 10 发货时间
                    $para[$i]['planTime'] = $val['item_data'];
                    break;
                case 10 ://ITEM_ID 11 标签要求
                    $para[$i]['label'] = $val['item_data'];
                    break;
                case 11 ://ITEM_ID 12 唛头内容
                    $para[$i]['mark'] = $val['item_data'];
                    break;
                case 12 ://ITEM_ID 13 质量要求
                    $para[$i]['quality'] = $val['item_data'];
                    break;
                case 13 ://ITEM_ID 14 报告要求
                    $para[$i]['reportRequirement'] = $val['item_data'];
                    break;
                case 14 ://ITEM_ID 15 包装要求
                    $para[$i]['package'] = $val['item_data'];
                    break;
                case 15 ://ITEM_ID 16 负责人
                    $para[$i]['ChargePerson'] = $val['item_data'];
                    break;
                case 16 ://ITEM_ID 17 通过调用方法将批次号合并
                    $para[$i]['patch'] = $this->getPathList($val['item_data']);
                    break;
                case 17 ://ITEM_ID 18 发运状态
                    $para[$i]['shipStatus'] = $val['item_data'];
                    break;
                case 18 ://ITEM_ID 19 发运时间
                    $para[$i]['shipDate'] = $val['item_data'];
                    break;
                case 19 ://ITEM_ID 20 报告状态
                    $para[$i]['reportStatus'] = $val['item_data'];
                    break;
            }
            $j++;
        }
        return $para;
    }
    //此方法用于将流程执行情况合并至输出数组
    private function mergePrcs($arr)
    {
        $result = array();
        $i = 0;
        foreach($arr as $v)
        {
            $result[$i] = $v;
            $result[$i]['prcs'] = $this->getStatus($v['run_id']);
            $i++;
        }
        return $result;
    }
    //获取批次信息，批次信息是一个可扩充条数的表格，每一行4项数据
    public function getPathList($strVal)
    {
        $arr = explode('`',$strVal);
        array_pop($arr);

        $i = 0;
        $j = 0;
        $result = array();
        foreach($arr as $v)
        {
            if($j % 4 == 0 && $j != 0)
            {
                $i++;
            }
            $case = $j % 4;
            switch ($case)
            {
                case 0 :
                    $result[$i]['no'] = $v;
                    break;
                case 1 :
                    $result[$i]['product'] = $v;
                    break;
                case 2 :
                    $result[$i]['patch'] = $v;
                    break;
                case 3 :
                    $result[$i]['amount'] = $v;
                    break;
            }
            $j++;
        }
        return $result;
    }
    //获取个单据状态，此函数涉及多次表查询，可能会对性能有影响
    private function getStatus($val)
    {
        //找出最大执行的步数
        $item = 'run_id,max(prcs_id)';
        $table = 'flow_run_prcs';
        $condition = 'run_id = \''.$val.'\' GROUP BY run_id';
        $result = Database::select($item,$table,$condition);
        //获取最大执行步数的阶段
        $item = 'flow_prcs';
        $table = 'flow_run_prcs';
        $condition = 'run_id = \''.$result[0]['run_id'].'\' and prcs_id = \'' . $result[0]['max(prcs_id)'] . '\'';
        $result = Database::selectOne($item,$table,$condition);
        return $result;
    }
    //获取条数
    public function getCount()
    {
        $item = 'count(run_id)';
        $table = 'flow_run';
        $condition = ' flow_id = '.$this->flowidOFDelivery.' and del_flag = 0';
        $count = Database::select($item,$table,$condition);

        return (int)$count[0]['count(run_id)'];
    }
    //获取页数
    public function getPage()
    {
        return ceil(($this->getCount())/10);
    }
}