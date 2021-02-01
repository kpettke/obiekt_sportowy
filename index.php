<!DOCTYPE html>
<html lang="pl">
    <?php
    session_start();
    
    ?>
   
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Centrum Sportowe</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        
        <link href="js/sweetalert.css" rel="stylesheet" />
        <!--  SweetAlerts js Plugins    -->
        <script src="js/sweetalert.min.js"></script>
    
    </head>

    <body class="body_login">
        <div class="container">

            <div class="page-header">
                <h1>Centrum Sportowe</h1>
            </div>
                           
            <div class="row align-items-center justify-content-center col_login_margin">

                <div class="col col-4 align-middle col_login ">
                    <h3>Panel logowania</h3>
                    <br>
                    <form action="login.php" method="post">

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Login</label>
                            <div class="col-8">
                                <input class="form-control" type="text" placeholder="Login" name="login">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">Hasło</label>
                            <div class="col-8">
                                <input class="form-control" type="password" placeholder="Hasło" name="password">
                            </div>
                        </div>

                        <div class="form-group row ">

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary  btn-block">Zaloguj</button>
                            </div>
                           
                        </div>
                        
                       <?php
                                             
                       if ((isset($_SESSION['pwd_error']))&& $_SESSION['pwd_error'] == TRUE)
                       {
                           echo ' <div class="col-12 alert alert-danger justify-content-center align-items-center" role="alert">
                            <strong>Błąd logowania </strong>Błędny login lub hasło
                        </div>';
                           $_SESSION['pwd_error']=FALSE;
                       }
                        else 
                       {
                            
                       }
                       
                       ?>

                      
                    </form>
                    <a href= "#" onclick="swal('Skontaktuj się z administratorem systemu','','error')">Nie pamietasz hasła ?</a>

                </div>
 
            </div>
            
            <center><h4>© Krzysztof Pettke WSZ 712</h></center>   

    </body>
</html>
