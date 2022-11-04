<?php

include("../database/constants.php");

if(!isset($_SESSION["id"])){
    header("location: ./index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    <script src = "../js/order.js"></script>
    

</head>


<body>

    <div class="overlay"><div class="loader"></div></div>


    <!-- -->
    <nav class="navbar" style="background-color: beige;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Inventory system</a>
            <!-- dugme koje treba da se pojavi kad se smanji rezolucija pa meni treba da bude padajuci, NE RADI KAKO TREBA
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            -->
            <br>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> 
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-home"></i>Home</a>

                    <!-- Vrati korisnika na Login kad pritisne Logout dugme -->
                    <?php
                        if(isset($_SESSION["id"])){
                    ?>
                    <!-- korisnik moze da vidi opciju Izloguj se, jedino ako je vec ulogovan -->
                        <a class="nav-link active" aria-current="page"href="../templates/logout.php"><i class="fa fa-user"></i>Logout</a>
                    <?php
                        }
                    ?>

                    
                </div>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row" >
            <!-- za centriranje bi trebalo koristiti mx-auto ali nece da radi-->
            <div class="col-md-10">
                <div class="card" style="box-shadow: 0 0 15px;">
                    <div class="card-header">
                        <h3>New Orders</h3>
                    </div>
                    <div class="card-body">
                        <form id="get_order"  onsubmit="return false">
                            <div class="form-group row">
                                <label  class="col-sm-3" align="right">Order date</label>
                                <div class="col-sm-6">
                                    <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3" align="right">Employee Name*</label>
                                <div class="col-sm-6">
                                    <input type="text" id="employee_name" name="employee_name" class="form-control form-control-sm" placeholder="Enter your name" required>
                                </div>
                            </div>

                            <div class="card" style="background-color: beige; box-shadow: 0 0 6px; " >
                                <div class="card-body">
                                    <h4>Make a order list</h4>
                                    <table align="center" style="width:800px;">
                                        <thead>
                                            
                                            <tr>
                                                <th>#</th>
                                                <td style="text-align:center;">Item Name</td>
                                                <td style="text-align:center;">Total Quantity</td>
                                                <td style="text-align:center;">Quantity</td>
                                                <td style="text-align:center;">Price</td>
                                                <td></td>
                                                <th>Total</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody id="invoice_item" style="text-align:center;">
                                        <!--
                                            <tr>
                                                <td><b id="number">1</b></td>
                                                <td>
                                                    <select name="pid[]" id="form-control form-control-sm" required>
                                                        <option>Washing machine</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="tqty[]" class="form-control form-control-sm" readonly></td>
                                                <td><input type="text" name="qty[]" class="form-control form-control-sm" required></td>
                                                <td><input type="text" name="price[]" class="form-control form-control-sm" readonly ></td>
                                                <td>3003</td>
                                            </tr>
                                        -->

                                        </tbody>
                                    </table>
                                    <center style="margin: 20px 10px">
                                        <button id = "add" class="btn btn-success" style="width:150px;">Add</button>
                                        <button id = "remove" class="btn btn-danger" style="width:150px;">Remove</button>
                                    </center>
                                </div>
                            </div>    
                            <!--  Zavrsava se card Make a order list -->

                            <p></p>
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-3" align="right">Sub total</label>
                                <div class="col-sm-6">
                                    <input type="text" name="sub_total" class="form-control form-control-sm" id="sub_total" readonly>
                                </div>
                            </div>

                            <p></p>
                            <div class="form-group row">
                                <label for="gst" class="col-sm-3" align="right">GST (20%)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="gst" class="form-control form-control-sm" id="gst">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="net_total" class="col-sm-3" align="right">Net total</label>
                                <div class="col-sm-6">
                                    <input type="text" name="net_total" class="form-control form-control-sm" id="net_total" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="payment-type" class="col-sm-3" align="right">Payment method</label>
                                <div class="col-sm-6">
                                    <select name="payment_type" id="payment_type" class="form-control form-control-sm">
                                        <option>Cash</option>
                                        <option>Card</option>
                                        <option>Cheque</option>
                                    </select>
                                </div>
                            </div>

                            <center>
                                <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
                            </center>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>