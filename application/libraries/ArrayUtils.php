<?php
/**
 * Created by PhpStorm.
 * User: noxymon
 * Date: 09/12/17
 * Time: 7:12
 */

class ArrayUtils
{
    protected $CI;

    public function __construct()
    {
        $this->CI = get_instance();
    }

    function arrayToObject($array, $obj){
        $this->CI->load->library("popo/$obj");
        $object = new $obj();
        foreach($array as $key=>$value)
        {
            $object->$key = $value;
        }
        return $object;
    }
}