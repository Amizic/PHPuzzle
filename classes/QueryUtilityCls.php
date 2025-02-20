<?php
class QueryUtilityCls {

    private ConnectionCls $connectionObj;
    public array $results;
    public int $resultCount;


    public function __construct(ConnectionCls $connectionObj) {
        $this->connectionObj = $connectionObj;
        $this->resultCount = 0;
        $this->results = [];
    }

    //PREPARED STATEMENT QUERY WITH PARAMETER BINDINGS
        //First prepare statement from the Parrent Class. Then, in the Child Class, bind parameters.
        //After binding parameters, call ExecuteStatement from Parrent Class.
    protected function PrepareStatement(string $sql){
        $stmt = $this->connectionObj->connection->prepare($sql);
        return $stmt;
    }

    protected function ExecuteActiveStatement($stmt){
        return $this->ExecuteStatement($stmt, true);
    }

    protected function ExecuteRegularStatement($stmt){
        return $this->ExecuteStatement($stmt, false);
    }

    protected function ExecuteStatement($stmt, bool $isActiveStatement){
        $stmt->execute();
        if(!$isActiveStatement){
            $result = $stmt->get_result();
            $this->results = $result->fetch_all(MYSQLI_ASSOC);
            $this->resultCount = count($this->results);
            return $this->results;

            return $stmt->affected_rows;

        } else {
            // If there is a problem preparing the query
            echo "Error: " . $this->connectionObj->connection->error;
            return false;
        }
    }

    //REGULAR QUERY
        // Method for executing active queries (INSERT, UPDATE, DELETE)
    protected function executeActiveQuery(string $sql): int {
        return $this->executeQuery($sql, true);
    }

        // Method for executing regular queries (SELECT)
    protected function executeRegularQuery(string $sql): array {
        return $this->executeQuery($sql, false);
    }


        // Internal method to execute queries
    private function executeQuery(string $sql, bool $isActiveQuery): mixed {

        if ($stmt = $this->connectionObj->connection->prepare($sql)) {

            $stmt->execute();

            // For regular queries (SELECT), fetch and return results
            if (!$isActiveQuery) {
                $result = $stmt->get_result();
                $this->results = $result->fetch_all(MYSQLI_ASSOC);
                $this->resultCount = count($this->results);
                return $this->results;
            }

            // For active queries (INSERT, UPDATE, DELETE), return affected rows
            return $stmt->affected_rows;
        } else {
            // If there is a problem preparing the query
            echo "Error: " . $this->connectionObj->connection->error;
            return false;
        }
    }

    // Method to get the number of retrieved results
    public function getResultCount(): int {
        return $this->resultCount;
    }
}
?>
