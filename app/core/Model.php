<?php

class Model {
    protected $table;
    protected $primaryKey = 'id';
    protected $connection;

    // Query state
    protected $query = '';
    protected $bindings = [];

    public function __construct() {
        // Initialize database connection
        require_once __DIR__ . '/../../config/config.php';
        $this->connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Infer table name from class name if not set
        if (!$this->table) {
            $this->table = strtolower((new ReflectionClass($this))->getShortName()) . 's';
        }
    }

    /**
     * Find a record by its primary key.
     */
    public function find($id) {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Insert a new record.
     */
    public function save($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $stmt = $this->connection->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    /**
     * Update a record by its primary key.
     */
    public function update($id, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');

        $stmt = $this->connection->prepare("UPDATE {$this->table} SET {$fields} WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }

    /**
     * Delete a record by its primary key.
     */
    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Execute a raw SQL query.
     *
     * @param string $sql The raw SQL query.
     * @param array $params Optional query parameters.
     * @return mixed Query result.
     */
    public function rawQuery($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue(is_int($key) ? $key + 1 : ":$key", $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function last() {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} ORDER BY {$this->primaryKey} DESC LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function count() {
        $stmt = $this->connection->prepare("SELECT COUNT(*) AS total FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function exists($id) {
        $stmt = $this->connection->prepare("SELECT COUNT(*) AS count FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'] > 0;
    }

    public function pluck($column) {
        $stmt = $this->connection->prepare("SELECT {$column} FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function findBy($column, $value) {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$column} = :value LIMIT 1");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function whereIn($column, array $values) {
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$column} IN ({$placeholders})");
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function orderBy($column, $direction = 'ASC') {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} ORDER BY {$column} {$direction}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function paginate($limit, $offset) {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function truncate() {
        $stmt = $this->connection->prepare("TRUNCATE TABLE {$this->table}");
        return $stmt->execute();
    }

    public function toJson($data) {
        return json_encode($data, JSON_PRETTY_PRINT);
    }


    /**
     * Add a WHERE condition to the query.
     */
    public function where($column, $operator, $value = null) {
        // Handle shorthand 'where' calls like where('name', 'value')
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        $clause = "$column $operator ?";
        if (empty($this->query)) {
            $this->query = "SELECT * FROM {$this->table} WHERE $clause";
        } else {
            $this->query .= " AND $clause";
        }

        $this->bindings[] = $value;

        return $this;
    }

    /**
     * Fetch the first record.
     */
    public function first() {
        $this->query .= " LIMIT 1";
        $stmt = $this->connection->prepare($this->query);
        $stmt->execute($this->bindings);

        // Reset query state after execution
        $this->resetQuery();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch all matching records.
     */
    public function all() {
        $stmt = $this->connection->prepare($this->query ?: "SELECT * FROM {$this->table}");
        $stmt->execute($this->bindings);

        // Reset query state after execution
        $this->resetQuery();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Reset the query state.
     */
    protected function resetQuery() {
        $this->query = '';
        $this->bindings = [];
    }


}
