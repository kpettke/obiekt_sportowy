function card_enter() //enter customer with card ALERTBOX
{
    swal({
        title: "Wprowadź karte",
        type: "input",
        confirmButtonText: "Wprowadź",
        cancelButtonText: "Anuluj",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Wprowadz ID karty"
    },
            function (inputValue) {
                if (inputValue === false)
                    return false;

                if (inputValue === "") {
                    swal.showInputError("Musisz wprowadzić ID karty!");
                    return false
                }

                $.ajax({
                    url: "ajax/check_card.php",
                    type: "POST",
                    data: {id_card: inputValue},
                    dataType: "html",
                    success: function (data)
                    {
                        if (data != 0)
                        {
                           swal.close();
      
                            
                            $("#exampleModal").modal();
                            $('#id_card').val(data);
                            getCardService();
                            getCardCustomerName();
                                                                        
                       }
                        else
                            swal('Brak dostępu', '', 'error');
                    }
                });

            }
    );
}


function getCardService() { //get acces info

    var id = $("#id_card").val();
   


    if (id != "")
    {
        $.ajax({
            url: "ajax/getCardService.php",
            type: "POST",
            data: {id: id},
            dataType: "html",
            success: function (data)
            {
                $('#zone').val(data);

            }
        });
    }
}

function getCardCustomerName() { //get acces info

    var id = $("#id_card").val();



    if (id != "")
    {
        $.ajax({
            url: "ajax/getCardCustomerName.php",
            type: "POST",
            data: {id: id},
            dataType: "html",
            success: function (data)
            {
                $('#name').val(data);

            }
        });
    }
}



function customerExit() //exit customer card and noCard ALERTBOX
{
    swal({
        title: "Wprowadź nr szafki",
        type: "input",
        confirmButtonText: "Wprowadź",
        cancelButtonText: "Anuluj",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "nr szafki"
    },
            function (inputValue) {

                if (inputValue === false)
                    return false;

                if (inputValue === "") {
                    swal.showInputError("Musisz wprowadzić nr szafki!");
                    return false
                }

                $.ajax({
                    url: "ajax/customerExit.php",
                    type: "POST",
                    data: {deposit: inputValue},
                    dataType: "html",
                    success: function (data)
                    {
                       if (data != 0)
                        {
                            swal({
                                type: 'success',
                                title: 'Klient został wylogowany'

                            });
                          setTimeout(function () {document.location.href = "main.php"; }, 1200);

                        } else
                            swal('Nie ma takiego klienta', '', 'error');
                        
 
                    }
                });
            }
    );
}


function getService() { //get service name and tarif

    var name = $("#name").val();
    var tariff = $('#tariff').val();


    if (name != "" && tariff != "")
    {
        $.ajax({
            url: "ajax/get_servicePrice.php",
            type: "POST",
            data: {name: name, tariff: tariff},
            dataType: "html",
            success: function (data)
            {
                $('#price').val(data);
               
             
            }
        });
    }
}



function getServiceId() { //get service id

    var name = $("#name").val();
    var tariff = $('#tariff').val();


    if (name != "" && tariff != "")
    {
        $.ajax({
            url: "ajax/get_serviceId.php",
            type: "POST",
            data: {name: name, tariff: tariff},
            dataType: "html",
            success: function (data)
            {
                $('#id_service').val(data);
            }
        });
    }
}

function userEditTable() //onclick table in user edit
{

    var table = document.getElementById('table');

    for (var i = 1; i < table.rows.length; i++)
    {
        table.rows[i].onclick = function ()
        {
            document.getElementById("id").value = this.cells[1].innerHTML;
            document.getElementById("login").value = this.cells[2].innerHTML;
            document.getElementById("mail").value = this.cells[3].innerHTML;
            document.getElementById("name").value = this.cells[4].innerHTML;
            document.getElementById("lastname").value = this.cells[5].innerHTML;
            document.getElementById("position").value = this.cells[6].innerHTML;
            document.getElementById("permission").value = this.cells[7].innerHTML;

        };
    }
}

function customerEditTable() //onclick table in customer edit
{

    var table = document.getElementById('table');

    for (var i = 1; i < table.rows.length; i++)
    {
        table.rows[i].onclick = function ()
        {
            document.getElementById("id").value = this.cells[1].innerHTML;
            document.getElementById("id_card").value = this.cells[2].innerHTML;
            document.getElementById("id_card_old").value = this.cells[2].innerHTML;
            document.getElementById("name").value = this.cells[3].innerHTML;
            document.getElementById("lastname").value = this.cells[4].innerHTML;
            document.getElementById("sex").value = this.cells[5].innerHTML;
            document.getElementById("mail").value = this.cells[6].innerHTML;
            
        };
    }
}

function customerInsideTable() //onclick table in customer inside
{

    var table = document.getElementById('table');

    for (var i = 1; i < table.rows.length; i++)
    {
        table.rows[i].onclick = function ()
        {
            document.getElementById("id_card").value = this.cells[1].innerHTML;
            document.getElementById("name").value = this.cells[4].innerHTML;
            document.getElementById("lastname").value = this.cells[5].innerHTML;
            document.getElementById("zone").value = this.cells[3].innerHTML;
            document.getElementById("deposit").value = this.cells[2].innerHTML;
           
        };
    }
}

function serviceEditTable() //onclick table in service edit
{

    var table = document.getElementById('table');

    for (var i = 1; i < table.rows.length; i++)
    {
        table.rows[i].onclick = function ()
        {
            document.getElementById("id").value = this.cells[1].innerHTML;
            document.getElementById("name").value = this.cells[2].innerHTML;
            document.getElementById("tariff").value = this.cells[3].innerHTML;
            document.getElementById("type").value = this.cells[4].innerHTML;
            document.getElementById("price").value = this.cells[5].innerHTML;

        };
    }
}


function searchUser() { //search box in user edit
    var input, filter, table, tr, td, i;
    input = document.getElementById("searchBox");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
    var td2 = tr[i].getElementsByTagName("td")[3];
    var td3 = tr[i].getElementsByTagName("td")[4];
    var td4 = tr[i].getElementsByTagName("td")[5];
    var td5 = tr[i].getElementsByTagName("td")[6];
    var td6 = tr[i].getElementsByTagName("td")[7];
       
    
        if (td) {
            if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1 ) || (td3.innerHTML.toUpperCase().indexOf(filter) > -1) ||
                    (td4.innerHTML.toUpperCase().indexOf(filter) > -1) || (td5.innerHTML.toUpperCase().indexOf(filter) > -1) || (td6.innerHTML.toUpperCase().indexOf(filter) > -1) ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function searchCustomer() { //search box in customer edit
    var input, filter, table, tr, td, i;
    input = document.getElementById("searchBox");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        var td2 = tr[i].getElementsByTagName("td")[3];
        var td3 = tr[i].getElementsByTagName("td")[4];
        var td4 = tr[i].getElementsByTagName("td")[5];
        var td5 = tr[i].getElementsByTagName("td")[6];
       

        if (td) {
            if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) || (td3.innerHTML.toUpperCase().indexOf(filter) > -1) ||
                    (td4.innerHTML.toUpperCase().indexOf(filter) > -1) || (td5.innerHTML.toUpperCase().indexOf(filter) > -1)) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function searchCustomerInside() { //search box in customer inside
    var input, filter, table, tr, td, i;
    input = document.getElementById("searchBox");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        var td2 = tr[i].getElementsByTagName("td")[4];
        var td3 = tr[i].getElementsByTagName("td")[5];
        
        if (td) {
            if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) || (td3.innerHTML.toUpperCase().indexOf(filter) > -1) ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}


function searchCustomerId() { //search box in customer edit by ID CARD
    var input, filter, table, tr, td, i;
    input = document.getElementById("searchBoxId");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        var td2 = tr[i].getElementsByTagName("td")[3];
       

        if (td) {
            if ((td.innerHTML.toUpperCase().indexOf(filter) > -1)) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function searchService() { //search box in service edit
    var input, filter, table, tr, td, i;
    input = document.getElementById("searchBox");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        var td2 = tr[i].getElementsByTagName("td")[3];
        var td3 = tr[i].getElementsByTagName("td")[4];
        var td4 = tr[i].getElementsByTagName("td")[5];
        


        if (td) {
            if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) || (td3.innerHTML.toUpperCase().indexOf(filter) > -1) ||
                    (td4.innerHTML.toUpperCase().indexOf(filter) > -1)) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}


$(function () {   //datepicker in new card pass
    $("#datepicker_to").datepicker({yearRange: "c:c+1"});
    $("#datepicker_from").datepicker({yearRange: "c:c+1", minDate: "D"}).bind("change", function () {
        var minValue = $(this).val();
        var maxDate = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate() + 30);
        maxDate = $.datepicker.parseDate("yy-mm-dd", maxDate);
        maxDate.setDate(maxDate.getDate() + 30);
        $("#datepicker_to").datepicker("option", "minDate", minValue);
        $("#datepicker_to").datepicker("option", "maxDate", maxDate);
      
      
    })
});

function getCustomerIdCard() //get id from scaner for sale pass
{
    swal({
        title: "Zeskanuj Karte",
        type: "input",
        confirmButtonText: "Wprowadź",
        cancelButtonText: "Anuluj",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "ID KARTY"
    },
            function (inputValue) {

                if (inputValue === false)
                    return false;

                if (inputValue === "") {
                    swal.showInputError("Musisz zeskanowac karte!");
                    return false
                }

                $.ajax({
                    url: "ajax/customerCurrentPassSale.php",
                    type: "POST",
                    data: {id_card: inputValue},
                    dataType: "html",
                    success: function (data)
                    {
                             if (data == 1)
                            location.href = "newCardPass.php"; 

                        else{
                            swal({
                            type: 'error',
                            title: 'Nie ma takiej karty'

                        });}
           
                    }
                });
            }
    );
           
}
