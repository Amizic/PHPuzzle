<?php

class ConnectionCls {
    private $host;
    private $username;
    private $password;
    private $dbname;

    public $connection;

    // Constructor to initialize the connection parameters
    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        //$this->connect(); // Automatically connect on initialization
    }

    public function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function disconnect(){
        $this->connection->close();
    }
    
    public function close() {
        $this->connection->close();
    }

    public function LoadParametersFromJSON($filePath) {
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $data = json_decode($jsonData, true);

            // Assign data to private attributes
            $this->host = $data['host'] ?? '';
            $this->username = $data['username'] ?? '';
            $this->password = $data['password'] ?? '';
            $this->dbname = $data['dbname'] ?? '';
        } else {
            echo "JSON file not found.";
        }
    }
    
    public function LoadParametersFromXML($filePath) {
        if (file_exists($filePath)) {
            $xmlData = simplexml_load_file($filePath);

            $this->host = (string) $xmlData->host;
            $this->username = (string) $xmlData->username;
            $this->password = (string) $xmlData->password;
            $this->dbname = (string) $xmlData->dbname;
        } else {
            echo "XML file not found.";
        }
    }
}

?>
