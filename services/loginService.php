<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
} else {
    session_unset();
    session_destroy();
    session_start();
}

    require_once('../config/configuration.php');
    $connectionObj = new ConnectionCls(null, null, null, null);
    $connectionObj->LoadParametersFromXML('../utilities/connection.xml');
    $connectionObj->connect();

    //Example provided by the Form's field names (email and password)
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $userObj = new UserCls($connectionObj);
    $userObj->GetUserByLoginCredentialsPrepared($email, $password);

    $connectionObj->disconnect();

    if($userObj->resultCount==1){
        $_SESSION['username'] = $userObj->username;
        $_SESSION['rolename'] = $userObj->roleName;
        header("Location:../index.php");
        exit;
    }

    header("Location:../login.php");
    exit;
?>