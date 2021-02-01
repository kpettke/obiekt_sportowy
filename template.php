<!DOCTYPE HTML>

<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once('class/class_system.php');
$settings = new System();

if ((isset($_SESSION['logon_session']) == false)) 
    {
    header('location: index.php');
    }
    
    
?>

<!DOCTYPE html>
<html lang="pl">
 
    <head>
        <title>Centrum Sportowe</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" href="jquery//jquery-ui.css">
        
        
        
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <script src="jquery/jquery-1.12.4.js"></script>
        <script src="jquery/jquery-ui.js"></script>
        
        <script src="js/all_function.js"></script>
        
        <link href="css/sweetalert.css" rel="stylesheet" />
        <!--  SweetAlerts js Plugins    -->
        <script src="js/sweetalert.min.js"></script>
        
    </head>

    <body class="body_template d-flex flex-column">

        <nav class="navbar sticky-top navbar-expand navbar-dark bg-primary">

            <a class="navbar-brand" href="main.php"><b>Centrum Sportowe</b></a>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="main.php"><i class="icon-home"></i> Strona Główna </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sale.php">Sprzedaż</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="controlPanel.php">Obsługa</a>
                    </li>
                </ul>
            </div>

            <ul class="navbar-nav">

                <li class="nav-item active ">
                    <a class="nav-link"> <?php echo "zalogowany:&nbsp<b>" . $_SESSION['login_user'];
    "</b>" ?> </a>
                </li>
                <li class="nav-item active ">
                 <a class="nav-link" href="logout.php"><i class="icon-logout"></i></a>
                </li>
            </ul>
        </nav>
    </body>
    <footer>

        <h5><b><center><?php $settings->getUser_info(); ?></center></b></h>

    </footer>