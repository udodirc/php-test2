<?php

namespace core;

use PDO;
use PDOStatement;

class Model
{
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();  // Get the singleton DB instance
    }

    public function fetch(string $query): array|false
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function save(string $tableName, array $data): bool
    {
        $query = static::insert($tableName, $data);
        $stmt = $this->db->prepare($query);
        static::bindParams($stmt, $data);

        // Execute the statement
        return $stmt->execute();
    }

    public function store(string $tableName, array $data): bool
    {
        return $this->save($tableName, $data);
    }

    public static function bindParams(PDOStatement $stmt, array $data): void
    {
        // Bind parameters
        foreach ($data as $param => &$value) {
            // Bind parameters to the placeholders
            $stmt->bindParam(':'.$param, $value);
        }
    }

    public static function insert(string $tableName, array $data): string
    {
        $query = "";

        if (!empty($data)) {
            $query = "INSERT INTO `{$tableName}` ";
            $lastElement = end($data);
            $fields = "";
            $values = "";

            foreach ($data as $field => $value) {
                $fields.= ($value == $lastElement) ? "`{$field}`" : "`{$field}`, ";
                $values.= ($value == $lastElement) ? ":{$field}" : ":{$field}, ";
            }

            $query.= "({$fields}) VALUES ({$values})";
        }

        return $query;
    }

    public function getLastRow(string $tableName): array|false
    {
        $query = "SELECT * FROM `{$tableName}` ORDER BY `id` DESC LIMIT 1";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkIfExist(string $tableName, array $data): array|false
    {
        $query = "";

        if (!empty($data)) {
            $query = "SELECT * FROM `{$tableName}` ";
            end($data);
            $lastElement = key($data);
            $fields = "";

            foreach ($data as $field => $value) {
                $fields.= ($field == $lastElement) ? "`{$field}` = :{$field}" : "`{$field}` = :{$field} and ";
            }

            $query.= "WHERE {$fields} LIMIT 1";
        }

        $stmt = $this->db->prepare($query);
        static::bindParams($stmt, $data);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}