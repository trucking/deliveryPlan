<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-10-8
 * Time: ÉÏÎç11:32
 */

class Filter {
    private $post;
    private $get;
    function __construct()
    {
        print_r($_POST);
    }

    public function post()
    {
        return ;
    }

    public function get()
    {
        return $this->$get;
    }

    public static function filterDate($val)
    {

    }
} 