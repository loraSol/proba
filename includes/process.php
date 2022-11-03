<?php

include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperations.php");
include_once("manage.php");


// FOR LOGIN
if(isset($_POST["log_email"]) AND isset($_POST["log_password"])){
    $user = new User();
    $result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
    //echo "test";
    echo $result;
    exit();
}

/* TO GET CATEGORY */
if(isset($_POST["getCategory"])){
    $obj = new DBOperations();
    $rows = $obj->getAllRecord("category");
    foreach($rows as $row){
        echo "<option value='".$row["cid"]."'>".$row["name_category"]."</option>";    // iz nekog razloga ovde je ostalo
    }                                                                               // name_category, tako je prvo bilo u bazi
    exit();
}


// Add Category
if(isset($_POST["category_name"])){
    $obj = new DBOperations();
    $result = $obj->addCategory($_POST["category_name"]);
    echo $result;
    exit();
}


// Add Product
if(isset($_POST["product_name"])){
    $obj = new DBOperations();
    $result = $obj->addProduct($_POST["select_cat"],$_POST["product_name"],$_POST["product_price"],$_POST["product_stock"]);
    echo $result;
    exit();
}


// Manage category
if(isset($_POST["manageCategory"])){
    $m = new Manage();
    $result = $m->manageRecord("category");
    $rows = $result;

    if(count($rows) > 0){
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $row["cid"] ?></td>
                    <td><?php echo $row["name_category"]; ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did = "<?php echo $row["cid"]; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
                        <a href="#" eid = "<?php echo $row["cid"]; ?>" data-toggle="modal" data-target="#form_category" class="btn btn-info btn-sm edit_cat">Edit</a>
                    </td>
                </tr>
            <?php
        }
    }
}


// Delete category
if(isset($_POST["deleteCategory"])){
    $m = new Manage();
    $result = $m->deleteRecord("category",$_POST["cid"]);
    echo $result;
    exit();

}


// Update category - da nadjem red koji zelim da izmenim
if(isset($_POST["updateCategory"])){
    $m = new Manage();
    $result = $m->getSingleRecord("category",$_POST["cid"]);
    echo json_encode($result);
    exit();
}


// Update record after getting data
if(isset($_POST["update_category"])){
    $m = new Manage();
    $cid = $_POST["cid"];
    $name = $_POST["update_category"];
    $result = $m->update_record("category",["cid"=>$cid],["name_category"=>$name]);
    echo $result;
    exit();
}



// Manage Product
if(isset($_POST["manageProducts"])){
    $m = new Manage();
    $result = $m->manageRecord("products");
    $rows = $result;

    if(count($rows) > 0){
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $row["pid"] ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <!-- Ovu funkciju getCategoryName sam rucno napisala -->
                    <td><?php echo $m->getCategoryName($row["cid"]); ?></td>
                    <td><?php echo $row["product_price"]; ?></td>
                    <td><?php echo $row["product_stock"]; ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                    <td>
                        <a href="#" did = "<?php echo $row["pid"]; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
                        <!-- GRESKA JE BILA STO PISE data_togle, UMESTO data-toggle; isto vazi i za data-target -->
                        <a href="#" eid = "<?php echo $row["pid"]; ?>" data-toggle="modal" data-target="#form_products" class="btn btn-info btn-sm edit_product">Edit</a>
                    </td>
                </tr>
            <?php
        }
    }
}


// Delete product
if(isset($_POST["deleteProduct"])){
    $m = new Manage();
    $result = $m->deleteRecord("products",$_POST["pid"]);
    echo $result;
    exit();

}


// Update product
if(isset($_POST["updateProduct"])){
    $m = new Manage();
    $result = $m->getSingleRecord("products",$_POST["pid"]);
    echo json_encode($result);
    exit();
}


// Update record after getting data
if(isset($_POST["update_product"])){
    $m = new Manage();
    $pid = $_POST["pid"];
    $cat = $_POST["select_cat"];
    $name = $_POST["update_product"];
    $price = $_POST["product_price"];
    $stock = $_POST["product_stock"];
    $result = $m->update_record("products",["pid"=>$pid],["product_name"=>$name,"cid"=>$cat,"product_price"=>$price,"product_stock"=>$stock]);
    echo $result;
    exit();
}


?>