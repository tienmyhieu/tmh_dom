<?php
namespace adapters;

class Db
{
    private $db;
    private $statement;
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function column($sql)
    {
        $this->execute($sql);
        return $this->statement->fetchColumn();
    }

    public function count($sql)
    {
        return $this->column($sql) ?? 0;
    }

    public function insert($sql)
    {
        $this->execute($sql);
    }

    public function quote($dirty)
    {
        return $this->db->quote($dirty);
    }

    public function select($sql)
    {
        if ($this->db) {
            $this->execute($sql);
            return $this->statement->fetchAll();
        }
        return [];
    }

    private function execute($sql)
    {
        $this->statement = $this->db->prepare($sql);
        $this->statement->execute();
    }
}
