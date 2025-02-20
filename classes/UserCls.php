<?php

class UserCls extends QueryUtilityCls {
    // Class attributes for storing user data
    public string $username;
    public string $firstName;
    public string $lastName;
    public string $roleName;

    // Constructor calls the parent constructor to initialize the connection object
    public function __construct(ConnectionCls $connectionObj) {
        parent::__construct($connectionObj);
    }

    public function GetUserByLoginCredentialsPrepared(string $email, string $passwordHash): ?array{
        $sql = "
            SELECT 
                u.Username, 
                u.FirstName, 
                u.LastName, 
                r.RoleName
            FROM Users u
            JOIN Roles r ON u.RoleId = r.Id
            WHERE u.Email = ? AND u.PasswordHash = ?
        ";

        $stmt = $this->PrepareStatement($sql);
        $stmt->bind_param("ss", $email, $passwordHash);
        $results = $this->ExecuteRegularStatement($stmt);

        if (!empty($results)) {
            // Store the first user's data in the class attributes
            $this->username = $results[0]['Username'];
            $this->firstName = $results[0]['FirstName'];
            $this->lastName = $results[0]['LastName'];
            $this->roleName = $results[0]['RoleName'];
        }
        return null;
    }

    // Method to retrieve a user by their login credentials (email and password hash)
    public function GetUserByLoginCredentials(string $email, string $passwordHash): ?array {
        // SQL query to select user by email and password hash
        $sql = "
            SELECT 
                u.Username, 
                u.FirstName, 
                u.LastName, 
                r.RoleName
            FROM Users u
            JOIN Roles r ON u.RoleId = r.Id
            WHERE u.Email = '{$email}' AND u.PasswordHash = '{$passwordHash}'
        ";

        // Execute the query using the parent class's method for regular queries (SELECT)
        $results = $this->executeRegularQuery($sql);

        // If the query returns at least one result, return the user data
        if (!empty($results)) {
            // Store the first user's data in the class attributes
            $this->username = $results[0]['Username'];
            $this->firstName = $results[0]['FirstName'];
            $this->lastName = $results[0]['LastName'];
            $this->roleName = $results[0]['RoleName'];
        }

        // Return null if no user found
        return null;
    }
}

?>
