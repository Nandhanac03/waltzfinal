<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Settings_model extends CO_Core_Model {

    protected $tableName = 'settings';

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

    public function get($id) {
        $where = "id='$id'";
        return $this->select("*", $where, TRUE);
    }

}
