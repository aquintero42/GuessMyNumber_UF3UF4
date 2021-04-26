<?php
include_once 'DatabaseConnection.php';

/**
 * Implementació de la clase DatabaseConnection segons el model Procedimental.
 *
 * @author Pep
 */
class DatabaseProc extends DatabaseConnection {
    
    private $database;

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

    public function connect(): void {
        $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        try {
            if (!$this->connection) {
                die("Connection failed: " . mysqli_connect_error());
                $this->connection = null;
            }
        } catch (mysqli_sql_exception $error) {
            throw new Exception($error->getMessage());
        }

    }

    public function insert($modalitat, $nivell, $intents): int {
        $sql = "INSERT INTO estadistiques (modalitat, nivell, intents) VALUES ('$modalitat', '$nivell', '$intents')";
        try {
            if ($this->connection != null) {
                if (mysqli_query($this->connection, $sql)) {
                    return mysqli_insert_id($this->connection);
                } else {
                    return -1;
                }
            }
        } catch(mysqli_sql_exception $error) {
            throw new Exception($error->getMessage());
        }

    }

    public function selectAll() {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques";
        try {
            $result = null;
            if ($this->connection != null) {
                $result = mysqli_query($this->connection, $sql);
            }
            return $result; 
        } catch(mysqli_sql_exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function delete($id) {
        $sql = "DELETE id FROM estadistiques WHERE id = '$id'";
        try {
            $result = null;
            if ($this->connection != null) {
                $result = mysqli_query($this->connection, $sql);
            }
            return $result; 
        } catch(mysqli_sql_exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function findById($id) {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE id = '$id'";
        try {
            $result = null;
            if ($this->connection != null) {
                $result = mysqli_query($this->connection, $sql);
            }
            return $result; 
        } catch(mysqli_sql_exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function update($estadistica) {
        
    }    

}
