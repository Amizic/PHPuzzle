
CREATE DATABASE IF NOT EXISTS dbExample;
USE dbExample;

CREATE TABLE Roles (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    RoleName VARCHAR(50) NOT NULL UNIQUE,
    Description TEXT
);

INSERT INTO Roles (RoleName, Description)
VALUES 
    ('Admin', 'Has full access to all system features and settings.'),
    ('User', 'Has access to basic features and content, with limited permissions.');


CREATE TABLE Users (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    DateOfBirth DATE,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    RoleId INT,                            
    FOREIGN KEY (RoleId) REFERENCES Roles(Id)
);

--Admin PasswordHash corresponds to Admin
--User PasswordHash corresponds to User
INSERT INTO Users (Username, Email, PasswordHash, FirstName, LastName, DateOfBirth, RoleId)
VALUES 
    ('adminuser', 'admin@example.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'User', '1980-01-01', 1);


INSERT INTO Users (Username, Email, PasswordHash, FirstName, LastName, DateOfBirth, RoleId)
VALUES 
    ('regularuser', 'user@example.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 'User', '1990-05-15', 2);


