<?php
session_start();

require_once('class/class_login.php');
$logon = new Login();

if (isset($_POST['login']))
{
    //print_r($_POST);

    $login = $_POST['login'];
    $password = $_POST['password'];
    
    //user login
    $_SESSION['login_user'] = $login;

    if ($logon->getIn($login, $password))
    {
        
        if($logon->getPermission($login) == 1) // normal user
        {
            $_SESSION['permission'] = 1;
        }
        if ( $logon->getPermission($login) == 0) //admin
        {
            print $logon->getPermission($login);
            $_SESSION['permission'] = 0;
            
        }


        header('Location: main.php');

        // global user logon session
        $_SESSION['logon_session'] = TRUE;
        //to print error message
        $_SESSION['pwd_error'] = FALSE;
    }
    
    else
    {
        header('Location: index.php');
        $_SESSION['pwd_error'] = TRUE;
    }
        
}
?>