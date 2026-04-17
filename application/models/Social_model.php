<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Social_model extends CO_Core_Model {

    protected $tableName = 'socialmedia';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function get_socialmedias($where = '') {
        return $this->select("*", $where);
    }

    public function get_socialmedia($id, $active = '') {
        $where = "id='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

    public function update($data, $id) {
        $where = "id='$id'";
        return $this->insert($data, $where);
    }

}
