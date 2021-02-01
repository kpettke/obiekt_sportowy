<!DOCTYPE html>
<html lang="pl">
    <?php
    session_start();
    require_once('template.php');

    ?>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </head>
    
    <div class="container-fluid">
        <div class="row stat_margin">
            <div class="col-2">
                <!-- lewa kolumna-->          
            </div>
            <div class="col-8 ">
                <div class="row justify-content-around stat_row rounded-top">
        
                    <div class="col-4 ">
                
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-lg btn-block sale_margin_btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h1>Karnet</h1>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="customerSaleRegistry.php">Nowy klient</a>
                                <a class="dropdown-item" onclick="getCustomerIdCard();" href="#">Obecny klient</a>
                            </div>
                        </div>
                
                    </div>
                    <div class="col-4 ">

                        <div class="dropdown">
                            
                            <a href="customers_no_card.php" class="btn btn-info dropdown-toggle btn-lg btn-block sale_margin_btn" type="button">
                            <h1>Bez karnetu</h1>
                            </a>
                            
                        </div>

                    </div>
                </div>
                    
                <div class="row justify-content-around stat_row ">
                    <div class="col-4"></div>
                </div>
                <div class="row justify-content-around stat_row rounded-bottom ">
                    <div class="col-4"></div>
                </div>
            
            </div>
        </div>
        
        <script type="text/javascript">
        
          
                    
        </script>
        
     </div>

      