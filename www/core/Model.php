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

    public function save(string $tableName, array $data, int $updateID = 0): bool
    {
        $query = ($updateID > 0)
            ? static::update($tableName, $data)
            : static::insert($tableName, $data);
        $stmt = $this->db->prepare($query);
        static::bindParams($stmt, $data, $updateID);

        // Execute the statements
        return $stmt->execute();
    }

    public static function bindParams(PDOStatement $stmt, array $data, int $updateID = 0): void
    {
        // Bind parameters
        foreach ($data as $param => &$value) {
            // Bind parameters to the placeholders
            $stmt->bindParam(':'.$param, $value);
        }

        if($updateID > 0){
            $stmt->bindParam(':update_id', $updateID);
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

    public static function update(string $tableName, array $data): string
    {
        $query = "";

        if (!empty($data)) {
            $query = "UPDATE `{$tableName}` SET ";
            $lastElement = end($data);
            $fields = "";

            foreach ($data as $field => $value) {
                $fields.= ($value == $lastElement) ? "`{$field}` = :{$field}" : "`{$field}` = :{$field}, ";
            }

            $query.= $fields." WHERE `id` = :update_id";
        }

        return $query;
    }

    public function delete(string $tableName, int $id): bool
    {
        $query = "DELETE FROM `{$tableName}` WHERE `id` = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);

        // Execute the statements
        return $stmt->execute();
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