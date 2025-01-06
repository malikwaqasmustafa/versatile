<?php

class User extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    public function getData() {
        $stmt = $this->connection->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
