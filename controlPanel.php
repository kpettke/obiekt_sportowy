<?php
session_start();
require_once('template.php');
?>
<head>

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
                            <h1>Klient</h1>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="customerRegistry.php">Nowy klient</a>
                            <a class="dropdown-item" href="customerEdit.php">Dane klienta</a>
                            <a class="dropdown-item" href="customerInside.php">Aktualnie na obiekcie</a>
                        </div>
                    </div>

                </div>

                <?php
                if ($_SESSION['permission'] == 0) { //admin

                    echo '<div class="col-4 ">';
                    echo '<div class = "dropdown">';
                    echo '<button class = "btn btn-info dropdown-toggle btn-lg btn-block sale_margin_btn" type = "button" id = "dropdownMenuButton" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">';
                    echo '<h1>Pracownik</h1>';
                    echo '</button>';
                    echo '<div class = "dropdown-menu" aria-labelledby = "dropdownMenuButton">';
                    echo '<a class = "dropdown-item" href = "userRegistry.php">Nowy pracownik</a>';
                    echo '<a class = "dropdown-item" href = "userEdit.php">Dane pracowników</a>';
                    echo '</div>';
                    echo '</div>';

                    echo '</div>';

                    echo '</div>';


                    echo '<div class = "row justify-content-around stat_row ">';

                    echo '<div class = "col-4">';
                    echo '<br>';
                    echo '<div class = "dropdown">';
                    echo '<button class = "btn btn-primary dropdown-toggle btn-lg btn-block sale_margin_btn" type = "button" id = "dropdownMenuButton" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">';
                    echo '<h1>Usługi</h1>';
                    echo '</button>';
                    echo '<div class = "dropdown-menu" aria-labelledby = "dropdownMenuButton">';
                    echo '<a class = "dropdown-item" href = "serviceNew.php">Nowa usługa</a>';
                    echo '<a class = "dropdown-item" href = "serviceEdit.php">Edycja usług</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';


                    echo '<div class = "col-4">';

                    echo '<div class = "dropdown">';
                    echo '<br>';
                    echo '<button class = "btn btn-info dropdown-toggle btn-lg btn-block sale_margin_btn" type = "button" id = "dropdownMenuButton" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">';
                    echo '<h1>System</h1>';
                    echo '</button>';
                    echo '<div class = "dropdown-menu" aria-labelledby = "dropdownMenuButton">';
                    echo '<a class = "dropdown-item" href = "systemSettings.php">Ustawienia systemu</a>';
                    echo '<a class = "dropdown-item" href = "newCurrentUserPwd.php">Zmień swoje hasło</a>';
                    //echo '<a class = "dropdown-item" href = "userRegistry.php">Statystyki klientów</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }


                if ($_SESSION['permission'] == 1) { //normal user

                    echo '<div class="col-4 ">';
                    echo '<div class = "dropdown">';
                    echo '<button class = "btn btn-info dropdown-toggle btn-lg btn-block sale_margin_btn" type = "button" id = "dropdownMenuButton" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style="opacity: 0.55;" >';
                    echo '<h1>Pracownik</h1>';
                    echo '</button>';

                    

                    echo '</div>';

                    echo '</div>';
                    echo '</div>';


                    echo '<div class = "row justify-content-around stat_row ">';
                    echo '<div class = "col-4">';
                    echo '<br>';



                    echo '<button class = "btn btn-primary  dropdown-toggle btn-lg btn-block sale_margin_btn" style="opacity: 0.55;"  >';
                    echo '<h1>Usługi</h1>';
                    echo '</button>';



                    echo '</div>';


                    echo '<div class = "col-4">';

                    echo '<div class = "dropdown">';
                    echo '<br>';
                    echo '<button class = "btn btn-info dropdown-toggle btn-lg btn-block sale_margin_btn"  type = "button" id = "dropdownMenuButton" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">';
                    echo '<h1>System</h1>';
                    echo '</button>';

                    echo '<div class = "dropdown-menu" aria-labelledby = "dropdownMenuButton">';
                    echo '<a class = "dropdown-item" href = "newCurrentUserPwd.php">Zmień swoje hasło</a>';

                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                }
                ?>



            </div>
            <div class="row justify-content-around stat_row rounded-bottom ">
                <div class="col-4">



                </div>
            </div>

        </div>
    </div>
</div>
