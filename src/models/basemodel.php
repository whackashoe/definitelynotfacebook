<?php

abstract class BaseModel {
    protected $db;
    protected $table = null;

    public function __construct($db) {
        $this->db = $db;
    }

    public function exists($id) {
        $sql = sprintf('SELECT COUNT(*) FROM %s WHERE id=:id', $this->table);
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetchColumn() > 0;
    }

    public function get($id) {
        $sql = sprintf('SELECT * FROM %s WHERE id=:id', $this->table);
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert(array $data) {
        $tilded = array_map(function($m) { return "`$m`"; }, array_keys($data));
        $prefixed = array_map(function($m) { return ":$m";  }, array_keys($data));

        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)',
            $this->table, 
            implode(', ', $tilded),
            implode(', ', $prefixed)
        );

        $stmt = $this->db->prepare($sql);

        $stmt->execute(array_combine($prefixed, array_values($data)));

        return $this->db;
    }
}
