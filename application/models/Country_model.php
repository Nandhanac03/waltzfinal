<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Country_model extends CO_Core_Model {

    protected $tableName = 'country';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function get_countries() {
        $order_by = "name ASC";
        return $this->select('*', '', '', $order_by);
    }

    public function get_country($id) {
        $where = " id='$id'";
        return $this->select('*', $where, TRUE);
    }

}
