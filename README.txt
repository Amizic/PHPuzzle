Small PHP Library created to simplify development process.

Folder structure overview:

RootFolderExample/
|
|-->classes/
|        ConnectionCls.php
|        QueryUtilityCls.php
|        UserCls.php
|
|-->database/
|        myDB.sql
|
|-->services/
|        loginService.php
|
|-->config/
|        configuration.php
|
|-->utilities/
|        connection.json
|        connection.xml
|
|index.php
|___________________________________|

HOW TO USE:

classes  folder:
    ConnectionCls.php is intended to be used as dependency injection on QueryUtilityCls.php (Look the example of ConnectionCls.php)
    QueryUtilityCls is designed for query execution and handling of prepared statements. (Look the example of QueryUtilityCls.php)
    UserCls.php as well as the other classes that developers will make are intended to inherit QueryUtilityCls.php (Look the example of UserCls.php)
    
config folder:
    Config folder holds teh configuration.php file which performs class autoloader mechanism from the root and services directory. (Look the example of configuration.php)

database folder:
    Database folder contains myDB.sql which is example of database for users to test functionality. (Look the example of dbExample.sql)
           
services folder:
    Services folder is designed to hold services that are performed by Forms, dictated by Form's action and Form's method. (Look the example of loginService.php)

utilities folder:
    Utilities folder is designed to hold connection information and similar data. (Look the example of connection.json and connection.xml)

EXAMPLE OF USAGE:

|For the correct usage and class implementation, look the example of loginService.php
|
|->
    1. configuration.php is called so that classes can be registered.
    2. ConnectionCls object is set (for now, constructor should be null).
    2. Function to retrieve connection info is called (Either from XML or JSON)
    3. Function for connection establishment is called.
    4. Retrieve information from form submission.
    5. Perform query for login.
    6. Close connection.
    7. Based on the results performed by the query, continue as desired.
