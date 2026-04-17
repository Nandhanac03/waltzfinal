<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Newsroom_model extends CO_Core_Model {

    protected $tableName = 'newsroom';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function add($data) {
        return $this->insert($data);
    }

    public function update($data, $id) {
        $where = "id='$id'";
        return $this->insert($data, $where);
    }

    public function get_newsrooms($where = '') {
        return $this->select("*", $where);
    }

    public function get_newsroom($id, $active = FALSE) {
        $where = "id='$id'";
        if ($active == TRUE) {
            $where .= " AND active='1'";
        }
        return $this->select("*", $where, TRUE);
    }

}
