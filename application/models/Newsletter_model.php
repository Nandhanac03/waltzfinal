<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter_model extends CO_Core_Model
{

    protected $tableName = 'newsletter';

    public function __construct()
    {
        parent::__construct($this->tableName);
    }

    public function add($data)
    {
        return $this->insert($data);
    }


    public function get($email)
    {
        $query = "select email from newsletter where email='".$email."'";
        return $this->full_query($query);
    }
    public function get_all($filter = array(), $limit = "") {
        $fetch_row = FALSE;
        $order_by = '';
        $where = "active = '1'";
        
        $order_by = " created_at desc";
        return $this->select("*", $where, $fetch_row, $order_by, $limit);
    }

   
}
