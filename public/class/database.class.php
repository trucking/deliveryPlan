<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-9-29
 * Time: ����2:08
 */

class Database {

    private static $sql = '';
    private static function conn()
    {
        $server = '192.168.32.200';
        $username = 'root';
        $password = 'wqdxyf5305';
        $database = 'TD_OA';
        $conn = mysql_connect($server,$username,$password,$database);
        mysql_select_db($database);
        return  $conn;
    }

    private function objToArr($obj)
    {
        $line = 0;

        while($arr[$line] = mysql_fetch_assoc($obj))
        {
            $line++;
        }
        //�����������һ����ֵ����ջ
        array_pop($arr);
        return $arr;
    }

    public static function select($item,$table,$condition=NULL)
    {
        if(empty($condition))
        {
            self::$sql = 'select '.$item.' from '.$table;
        }else{
            self::$sql = 'select '.$item.' from '.$table.' where '.$condition;
        }
        $conn = self::conn();
        $objResult = mysql_query(self::$sql,$conn);

        return $result = self::objToArr($objResult);
    }

    public static function selectOne($item,$table,$condition=NULL)
    {
        if(empty($condition))
        {
            self::$sql = 'select '.$item.' from '.$table;
        }else{
            self::$sql = 'select '.$item.' from '.$table.' where '.$condition;
        }
        $conn = self::conn();
        $objResult = mysql_query(self::$sql,$conn);
        $result = mysql_fetch_array($objResult);
        return $result[0][0];
    }

    public static function insert($table,$value)
    {
        $item = '';
        //value1������ת�ַ������ֵ
        $value1 = '';
        if(is_array($value))
        {
            foreach ($value as $key=>$v)
            {
                $item .= $key.',';
                $value1 .='\''.$v.'\',';
            }
        }else{
            throw new Exception("����ֵ����������");
        }
        //ȥ��ĩβ����
        $item = rtrim($item,',');
        $value1 = rtrim($value1,',');
        self::$sql = 'insert into '.$table.'('.$item.') values('.$value1.')';
        $conn = self::conn();
		
        $result = mysql_query(self::$sql,$conn);

        if($result == false){
            throw new Exception("�����������!");
        }

        return $result;
    }

    public static function update($table,$item,$condition)
    {
        self::$sql = 'update '.$table.' set ';
        //item����������ʽ����Ŀ��Ϊ���������ֵΪ�����ֵ
        if(is_array($item))
        {
            foreach($item as $key=>$val)
            {
                self::$sql .= $key.'=\''.$val.'\',';
            }
            //ȥ��ĩβ�Ķ���
            self::$sql = rtrim(self::$sql,',');
            self::$sql .= ' where '.$condition;
        }else
        {
            throw new Exception('�������󣬲�������');
        }
        $conn = self::conn();
        $result = mysql_query(self::$sql,$conn);
        if($result == false)
        {
            throw new Exception('���³���');
        }
        return $result;
    }

    public static function delete($table,$condition)
    {
        self::$sql = 'delete from '.$table.' where '.$condition;
        $conn = self::conn();
        $result = mysql_query(self::$sql,$conn);
        if($result == false)
        {
            throw new Exception('ɾ������');
        }
        return $result;
    }

    public static function showItem($table)
    {
        self::$sql = 'show columns from '.$table;
        $conn =self::conn();
        $objResult = mysql_query(self::$sql,$conn);
        $result= self::objToArr($objResult);
        //print_r($result);
        $i = 0;
        foreach($result as $v)
        {
            $arr[$i] = $v[0];
            $i++;
        }
        return $arr;
    }

    public static function echoSql()
    {
        echo self::$sql;
    }
}