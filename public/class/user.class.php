<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-10-17
 * Time: ионГ11:37
 */

class user {
    public function getNameById($id)
    {
        $condition = 'USER_ID = \''.$id.'\'';
        $name = Database::select('USER_NAME','user',$condition);
        return $name;
    }
} 