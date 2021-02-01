<!DOCTYPE html>
<html lang="pl">
    <?php
    session_start();
    require_once('template.php');
    require_once('class/class_user.php');
    require_once('class/class_customer.php');
    require_once('class/class_system.php');

    $customers = new Customer();
    $settings = new System ();
    
    
    
    
if ((isset($_SESSION['logon_session']) == false)) {
        header('location: index.php');
    }
    ?>

    <head>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        
    </head>

    <div class="container-fluid">

        <div class="row stat_margin  ">
            <div class="col-2">
                <!-- lewa kolumna-->          
            </div>
            <div class="col-8 ">

                <div class="row justify-content-around stat_row rounded-top">

                    <div class="col-4 stat_margin">

                        <center><br><h1>Klientów dzisiaj:
                                <br>
                                <b><?php echo $customers->customerToday(); ?></b></h></center>

                    </div>
                    <div class="col-4 stat_margin">
                        <center><br><h1>Klientów teraz:
                                <br>
                                <b><?php echo $customers->customerInside();  ?></b></h></center>
                    </div>
                </div>

                <div class="row justify-content-around stat_row ">
                    <div class="col-4">
                        <center> <h1>Wolnych szafek:
                                <br>
                                <b><?php  echo $settings->getDeposit()- $customers->customerInside(); ?></b></h></center>
                    </div>
                    <div class="col-4">
                        <center> <h1>

                                <span id="date_time"></span>

                                <script type="text/javascript" src="js/date_time.js"></script>
                                <script type="text/javascript">window.onload = date_time('date_time');</script>

                            </h></center>
                    </div>
                </div>

                <div class="row justify-content-around stat_row rounded-bottom ">
                    <div class="col-4">

                        <button type="button" onclick='card_enter();' class="btn btn-primary btn-lg btn-block" id="customerEnter">
                            &nbsp;<br>WEJŚCIE KLIENTA<br>&nbsp;
                        </button>
               
                        
                        <?php
                                         
                        require_once('modals/cardEnter.php');
                        ?>
               
                    </div>
                    <div class="col-4">

                        <button type="button" onclick="customerExit();" class="btn btn-info btn-lg btn-block">&nbsp;<br>WYJŚCIE KLIENTA<br>&nbsp;</button>

                    </div>
                </div>

            </div>

            <div class="col-2 ">
                <div class="row rounded">
                    <div class="col-1"></div>

                    <div class="col-9 profile_style rounded">
                        <br>
                        <center>

                            <?php
                            // right user panel
                            $userInfo = new User();
                            $login = $_SESSION['login_user'];
                            $userInfo->getUserInfo($login);
                            ?>
                            <br></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


</body>

</html>

