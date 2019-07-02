<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17-5-4
 * Time: 上午8:45
 */
include_once('database.class.php');
class record
{
    private $flowIdOfReport = 158;//ͻ��ά�ޱ��浥�������ͺţ�ԭͻ��ά�ޱ���flow_id=145
    private $flowIdOfSheet = 157;//��ίά��֪ͨ���������ͺ�
    private $reportNo;
    private $department;
    private $reportName;
    private $applicationTime;

    public function getReport($runId)
    {

        $item       = 'flow_run_data.ITEM_ID,
                        flow_run_data.ITEM_DATA';
        $table      = 'flow_run_data
                        INNER JOIN flow_run
                        ON flow_run_data.RUN_ID = flow_run.RUN_ID';
        $condition  = 'flow_run.FLOW_ID = '.$this->flowIdOfReport.' and
                        flow_run.run_id = '.$runId.' and
                        DEL_FLAG = 0
                        ORDER BY BEGIN_TIME DESC ';
        $result = Database::select($item,$table,$condition);
        //�����������ݵ����ԭ�򣬼�¼ֵ��һ�����У�����ֻ�ܲ����ֵ��Ӧ��ID�Ž�����ֵ����
        /*
         * 1    ���浥��
         * 2    �������ݣ�û�е��������ƣ���ʱȡ�����е�ֵ��,���������̣������������˱������
         * 4    �򱨸�Ĳ���
         * 6    ����ʱ��
         * */
        foreach($result as $k=>$v){
            switch ($v['ITEM_ID']){
                case 1 : $this->reportNo        = $v['ITEM_DATA'];break;
                case 2 : $this->reportName      = $v['ITEM_DATA'];break;
                case 4 : $this->department      = $v['ITEM_DATA'];break;
                case 6 : $this->applicationTime = $v['ITEM_DATA'];break;
            }
        }
        $arr = array(
            'runId'=>$runId,
            'reportNo'=>$this->reportNo,
            'reportName'=>$this->reportName,
            'department'=>$this->department,
            'applicationTime'=>$this->applicationTime
        );
        return $arr;
    }

    public function getSheet($reportNo)
    {
        $item       = 'flow_run.run_id';
        $table      = 'flow_run_data
                        INNER JOIN flow_run
                        on flow_run.run_id =flow_run_data.RUN_ID';
        $condition  = 'flow_run_data.ITEM_DATA = \''.$reportNo.'\' and
                        flow_run.FLOW_ID = '.$this->flowIdOfSheet;
        $result     = Database::select($item,$table,$condition);

        $item       = '*';
        $table      = 'flow_run_data';
        $condition  = 'run_id = \''.$result[0]['run_id'].'\'';
        $result     = Database::select($item,$table,$condition);
        /*
           * 1    ����Ĳ���
           * 2    ί�е�λ
           * 3    Ԥ������
           * 4    ʩ����������
           * 5    ί��ʱ��
           * 6    ά����ʱ
           * 7-14 ��ίά����Ŀ��ѡ���أ�ѡ�����on��ʾ
           * 15   ���浥��
           * 16   ��ίά������
           * 17   ��Ŀ������
           * 18   ��������
           * ...  ������쵼ǩ�ֺ�ʱ��
           * */
        //����$result����һ�����⣬���ǲ鲻����������鲻�����������Ҫ����Ϊ�����顣
        if($result){
            foreach($result as $v){
                switch($v['ITEM_ID']){
                    case 2  : $arr['client']         = $v['ITEM_DATA'];break;
                    case 3  : $arr['estimateCost']   = $v['ITEM_DATA'];break;
                    case 5  : $arr['delegateTime']   = $v['ITEM_DATA'];break;
                    case 17 : $arr['chargePerson']   = $v['ITEM_DATA'];break;
                }
            }
        }else{
            $arr['client']          = '';
            $arr['estimateCost']    = '';
            $arr['delegateTime']    = '';
            $arr['chargePerson']    = '';
        }
        return $arr;
    }

    public function getList($date)
    {
        $item       = 'DISTINCT(flow_run.RUN_ID)';
        $table      = 'flow_run
                      inner join flow_run_prcs
                      on flow_run.run_id = flow_run_prcs.run_id';
        $condition  = 'FLOW_ID = '.$this->flowIdOfReport.' and
                      flow_prcs = 5 and
                      DEL_FLAG = 0 and
                      BEGIN_TIME LIKE \''.$date.'%\'
                      ORDER BY begin_time ASC';
        $arr    = Database::select($item,$table,$condition);
        $i      = 0;
        $result = array();
        foreach ($arr as $v)
        {
            $reportResult   = $this->getReport($v['RUN_ID']);
            $checkResult    = $this->getCheck($v['RUN_ID']);
            $result[$i]     = array_merge($reportResult,$this->getSheet($reportResult['reportNo']),$checkResult);
            $i++;
        }
        return $result;
    }

    public function getCheck($runId = '')
    {

        $item       = 'run_id,finish_date,status,contract_cost';
        $table      = 'wxtj_check';
        $condition  = 'run_id = '.$runId;
        $result     = Database::select($item,$table,$condition);
        if($result){
            $arr['finishDate']      = $result[0]['finish_date'];
            $arr['status']          = $this->transCheckStatus($result[0]['status']);
            $arr['contractCost']    = $result[0]['contract_cost'];
            $arr['isRecord']        = 1;//��־�Ƿ������ռ�¼,1Ϊ��
        }else{
            $arr['finishDate']      = '';
            $arr['status']          = '';
            $arr['contractCost']    = '';
            $arr['isRecord']        = 0;//��־�Ƿ������ռ�¼,0Ϊû��
        }
        return $arr;
    }

    private function transCheckStatus($status)
    {
        /*
         * wxtj_chek����status���õ�tinyint���ͣ���ֵȡ����ת��
         * 0    δ��ʼ
         * 1    �ϸ�
         * 2    ���ϸ�
         * */
        switch($status){
            case 0 : $result = 'δ��ʼ';break;
            case 1 : $result = '�ϸ�';break;
            case 2 : $result = '���ϸ�';break;
        }
        return $result;
    }

    public function insertCheck(array $arr)
    {
        $table = 'wxtj_check';
        return Database::insert($table,$arr);
    }

    public function updateCheck($item,$condition)
    {
        $table = 'wxtj_check';
        return Database::update($table,$item,$condition);
    }
} 