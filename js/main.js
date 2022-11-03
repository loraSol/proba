$( document ).ready(function() {


    var DOMAIN = "http://localhost:8080/PrviDomaci";

    $("#form_log").on("submit", function(){
        //alert("kkfk");
        var email = $("#log_email");
        var password = $("#log_password");
        var status = false;
        //alert("kkfk");
    
        //console.log("dkkdd");
        if(email.val() != "" && password.val() != ""){
            status = true;
        }
    
        if(status){
           //alert("Ovde ulazi u if - status je true");
           $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: $("#form_log").serialize(),
            success: function(data){
                if(data == "USER_DOES_NOT_EXIST"){
                    // napisi sta se desava ako mejl nije ispravan
                } else if(data == "PASSWORD_NOT_MATCHED"){
                    // napisi sta se desava ako lozinka nije ispravna
                } else{
                    window.location.href = encodeURI(DOMAIN + "/includes/dashboard.php");
                }
            }

           })
        }
    
    }) 
    

    fetch_category();
    function fetch_category(){
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            data: {getCategory: 1},
            success: function(data){
                var choose = "<option value=''>Choose category</option>";
                //console.log("jedan");
                $("#select_cat").html(choose + data);
                console.log("dva");
            }

        })
    }



    // Add category
    $("#category_form").on("submit",function(){
        if($("#category_name").val() == ""){
            $("#category_name").addClass("border-ranger");
            $("#cat_error").html("<span class='text-danger'>Please enter category name</span>");
        }else{
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#category_form").serialize(),
                success: function(data){
                    if(data == "CATEGORY_ADDED"){
                        $("#category_name").removeClass("border-ranger");
                        $("#cat_error").html("<span class='text-success'>New category added.</span>");
                        $("#category_name").val("");
                        //fetch_category(); // NE RADI BEZ NOVOG UCITVANJA.... a trebalo da prikaze novu kategoriju kod proizvoda
                    } else{
                        data(alert);
                    }
                }
            })
        }
    })


    // Add product
    $("#product_form").on("submit",function(){
        //console.log("test0");
        if($("#product_name").val() == ""){
            //console.log("test1");
            $("#product_name").addClass("border-ranger");
            $("#pro_error").html("<span class='text-danger'>Please enter product name</span>");
        }else{
            //console.log("test2");
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#product_form").serialize(),
                success: function(data){
                    if(data == "PRODUCT_ADDED"){
                        //console.log("test3");
                        $("#product_name").removeClass("border-ranger");
                        $("#pro_error").html("<span class='text-success'>New product added.</span>");
                        $("#product_name").val("");
                        $("#product_stock").val("");
                        $("#product_price").val("");
                        $("#select_cat").val("");
                    } else{
                        alert(data);
                    }
                }
            })
        }
    })

    // Manage category
    manageCategory();
    function manageCategory(){
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
                data: {manageCategory:1},
                success: function(data){
                    $("#get_category").html(data);
                }
        })
    }


    // Manage products
    manageProducts();
    function manageProducts(){
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
                data: {manageProducts:1},
                success: function(data){
                    //console.log("jdjjd");
                    $("#get_product").html(data);
                }
        })
    }


});



