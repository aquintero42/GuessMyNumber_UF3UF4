<?php
include_once 'DatabaseConnection.php';

/**
 * Implementació de la clase DatabaseConnection segons el model OOP,
 * Object Oriented Programming.
 *
 * @author Pep
 */
class DatabaseOOP extends DatabaseConnection {
    
    const TABLE_START = "<table style='border: solid 1px black;'><tr style='background: grey;'><th>Id</th><th>Modalitat</th><th>Nivell</th><th>Data</th><th>Intents</th></tr>";
    const TABLE_END = "</table>";

    private $database;

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

    public function connect(): void {
        try {
            $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
                $this->connection = null;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insert($modalitat, $nivell, $intents): int {
        $sql = "INSERT INTO estadistiques (modalitat, nivell, intents) VALUES ('$modalitat', '$nivell', '$intents')";
        try {
            if ($this->connection != null) {
                if ($this->connection->query($sql) === TRUE) {
                    return $this->connection->insert_id;
                } else {
                    return -1;
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function selectAll() {
        try {
            $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques";
            $result = null;
            if ($this->connection != null) {
                $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
            }
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function selectByModalitat($modalitat) {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE modalitat = '$modalitat'";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }

    public function delete($id) {
        $sql = "DELETE id FROM estadistiques WHERE id = '$id'";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }

    public function findById($id) {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE id = '$id'";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }

    public function update($estadistica) {
        
    }

}
