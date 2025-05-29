<?php

namespace app\core;

use app\core\Database;

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findAll() {
        return $this->db->fetchAll("SELECT * FROM {$this->table}");
    }

    public function getAll() {
        return $this->findAll();
    }

    public function findById($id) {
        return $this->db->fetch("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->update($this->table, $data, "id = :id", ['id' => $id]);
    }

    public function delete($id) {
        return $this->db->delete($this->table, "id = ?", [$id]);
    }

    public function where($condition, $params = []) {
        return $this->db->fetchAll("SELECT * FROM {$this->table} WHERE {$condition}", $params);
    }

    public function findWhere($condition, $params = []) {
        return $this->db->fetch("SELECT * FROM {$this->table} WHERE {$condition}", $params);
    }
}
