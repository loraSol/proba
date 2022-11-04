$(document).ready(function(){
    var DOMAIN = "http://localhost:8080/PrviDomaci";


    // Brisanje kategorije
    // Nece da radi ako stoji samo body bez ''
    $('body').delegate(".del_cat","click",function(){
        var did = $(this).attr("did");               // vrati vrednost atributa did u klasi koju oznacava this
        if(confirm("Are you sure you want to delete this element?")){
            //console.log("delete-test1");
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: {deleteCategory:1,cid:did},
                success: function(data){
                    //console.log("delete-test2");
                    if(data == "CATEGORY_DELETED"){
                        alert("Category is deleted.");
                        window.location.href = "";
                    } else if(data == "DELETE_RESTRICTED"){
                        //console.log("delete-test3");
                        alert("You cannot delete this category because it still contains products.");
                    } else{
                        //console.log("delete-test4");
                        alert("An error occurred while trying to delete");
                    }
                }
            })
        }else{
            // necu nista da radim ako korisnik nece da izbrise element
        }
    })

    // Update Category - da iskoci modal za izmenu podataka
    $('body').delegate(".edit_cat","click", function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: {updateCategory:1, cid:eid},
            success: function(data){
                //alert(data);
                //alert(data["cid"]);
                //alert(data["name_category"]);
                //console.log(data);
                //alert(data["cid"]);
                $("#cid").val(data["cid"]);
                //console.log("update-test1");
                $("#update_category").val(data["name_category"]);
                window.location.href = "";
            }
        })
    })


    // Update category - izmena u bazi kad se klikne na Update category
    $("#update_category_form").on("submit",function(){
        if($("#update_category").val() == ""){
            $("#update_category").addClass("border-ranger");
            $("#cat_error").html("<span class='text-danger'>Please enter category name</span>");
        }else{
            //console.log("jjjjj");
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#update_category_form").serialize(),
                success: function(data){
                    //console.log("hhhhhj");
                    //alert(data);
                    
                }
            })
        }
    })


    


    // Brisanje proizvoda
    $('body').delegate(".del_product","click",function(){
        var did = $(this).attr("did");               // vrati vrednost atributa did u klasi koju oznacava this
        if(confirm("Are you sure you want to delete this element?")){
            //console.log("delete-test1");
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: {deleteProduct:1,pid:did},
                success: function(data){
                    //console.log("delete-test2");
                    if(data == "PRODUCT_DELETED"){
                        alert("Product is deleted.");
                        window.location.href = "";
                    } else if(data == "ERROR_DELETE_PRODUCT"){
                        //console.log("delete-test3");
                        alert("An error occurred while trying to delete product.");
                    } 
                }
            })
        }else{
            // necu nista da radim ako korisnik nece da izbrise element
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
                //console.log("dva");
            }

        })
    }
   


    // Update product - da se pojavi forma za izmenu proizvoda
    $("body").delegate(".edit_product","click",function(){
        var eid = $(this).attr("eid");
        //console.log("djhddhdhhdhdhhd");
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: {updateProduct:1,pid:eid},
            success: function(data){
                //console.log("ffdddff");
                //alert(data);                        // vraca sve OK 
                //alert(data["product_name"]);       // vraca ok
                $("#pid").val(data["pid"]);
                $("#update_product").val(data["product_name"]);
                $("#select_cat").val(data["cid"]);
                $("#product_price").val(data["product_price"]);
                $("#product_stock").val(data["product_stock"]);
            }
        })
    })



    // Update product - izmena u bazi kad se klikne na Update product
    $("#update_product_form").on("submit",function(){
        if($("#update_product").val() == ""){
            $("#update_product").addClass("border-ranger");
            $("#pro_error").html("<span class='text-danger'>Please enter category name</span>");
        }else{
            //console.log("jjjjj");
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#update_product_form").serialize(),
                success: function(data){
                    //console.log("hhhhhj");
                    if(data == "UPDATED"){
                        alert("Product updated successfully.")
                    } else{
                        alert(data);
                    }
                    window.location.href = "";
                }
            })
        }
    })
})