<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-9-29
 * Time: 下午2:08
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
        //将解析的最后一个空值弹出栈
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
        //value1是数组转字符串后的值
        $value1 = '';
        if(is_array($value))
        {
            foreach ($value as $key=>$v)
            {
                $item .= $key.',';
                $value1 .='\''.$v.'\',';
            }
        }else{
            throw new Exception("插入值必须是数组");
        }
        //去除末尾逗号
        $item = rtrim($item,',');
        $value1 = rtrim($value1,',');
        self::$sql = 'insert into '.$table.'('.$item.') values('.$value1.')';
        $conn = self::conn();
		
        $result = mysql_query(self::$sql,$conn);

        if($result == false){
            throw new Exception("数据添加有误!");
        }

        return $result;
    }

    public static function update($table,$item,$condition)
    {
        self::$sql = 'update '.$table.' set ';
        //item采用数组形式，项目名为数组键名，值为数组键值
        if(is_array($item))
        {
            foreach($item as $key=>$val)
            {
                self::$sql .= $key.'=\''.$val.'\',';
            }
            //去掉末尾的逗号
            self::$sql = rtrim(self::$sql,',');
            self::$sql .= ' where '.$condition;
        }else
        {
            throw new Exception('参数错误，不是数组');
        }
        $conn = self::conn();
        $result = mysql_query(self::$sql,$conn);
        if($result == false)
        {
            throw new Exception('更新出错');
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
            throw new Exception('删除出错');
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