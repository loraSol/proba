$( document ).ready(function() {


    var DOMAIN = "http://localhost:8080/PrviDomaci";

    //alert("order-test1");


    // -------------------------------------------- Dodavanje nove stavke u porudzbinu ------------------------------
    addNewRow();
    $("#add").click(function(){
        addNewRow();
    })


    function addNewRow(){
        //console.log("addNewRow-test1");
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: {getNewOrderItem:1},
            success: function(data){
                $("#invoice_item").append(data);

                // da bi se redni broj stavke porudzbine automatski povecao
                var n = 0;
                $(".number").each(function(){
                    $(this).html(++n);
                })
            }
        })
    }


    // --------------------------------------- Brisanje stavke iz porudzbine --------------------------------------

    $("#remove").click(function(){
        $("#invoice_item").children("tr:last").remove();      // izbrisi poslednji red koji je dodat u tabelu
    })



    // ----------------------- Automatska promena id kada neko izabere proizvod iz padajuce liste --------------------

    $("#invoice_item").delegate(".pid","change",function(){
        var pid = $(this).val();
        // $(this) je ono gde se ja trenutno nalazim - ja sam u <select></select> tagu sa klasom pid
        // <select> tag je deo <td> taga, a <td> je u okviru <tr> taga
        // do "roditelja"  stizem pomocu funkcije parent()
        var tr = $(this).parent().parent();    // ovako stizem do onog reda koji sadrzi moj <select> tag
        $(".overlay").show();
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: {getPriceAndQty:1,id:pid},
            success: function(data){
                tr.find(".tqty").val(data["product_stock"]);    // ukupna vrednost proizvoda mi je ono sto vec ima na zalihama, povlacim iz baze
                tr.find(".pro_name").val(data["product_name"]);  // ne znam sta ce nam ovo, polje je hidden
                tr.find(".qty").val(1);                         // kolicina koju porucujem, default 1
                tr.find(".price").val(data["product_price"]);   // cena proizvoda, povlacim iz baze
                tr.find(".amount").html(tr.find(".qty").val() * tr.find(".price").val());   // racunam koliko kosta porudzbina

            }
        })
    })


    //------------------- Provera koja sprecava da se u polje za kolicinu unese slovo ili tekst ------------------
    $("#invoice_item").delegate(".qty","keyup",function(){
        // keyup je event koji oznacava pritisak bilo kog tastera za unos u datom polju
        var qty = $(this);                               // sta je uneto u polje Quantity
        var tr = $(this).parent().parent();              // nadji red u kom je uneta kolicina
        
    
    })


})