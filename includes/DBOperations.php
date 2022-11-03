<?php

    class DBOperations{
        private $con;

        function  __construct(){
            include_once("../database/db.php");
            $db = new Database();
            $this->con =  $db->connect();
        }


        public function addCategory($name_category){
            // NE PISI '' KOD NAZIVA TABELE ILI KOLONA
            $prepared_statement = $this->con->prepare("INSERT INTO category(name_category,status) 
                                                        VALUES(?,?)" );
            $status = 1;
            $prepared_statement->bind_param("si", $name_category, $status);   // prvo se unosi name, sto je String(s) a onda status, sto je Enum, tj. int --> si

            $result = $prepared_statement->execute() or die($this->con->error);


            if($result){
                return "CATEGORY_ADDED";
            } else{
                return 0;
            }
        }

        public function getAllRecord($table){
            $prepared_statement = $this->con->prepare("SELECT * FROM ".$table);
            $prepared_statement->execute() or die($this->con->error);
            $result = $prepared_statement->get_result();

            $rows = array();
            // dodavanje elemenata u niz
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
            return "NO_DATA";

        }


        public function addProduct($cid,$product_name,$product_price,$product_stock){
            // NE PISI '' KOD NAZIVA TABELE ILI KOLONA
            $prepared_statement = $this->con->prepare("INSERT INTO products(cid,product_name,product_price,product_stock,p_status) 
                                                        VALUES(?,?,?,?,?)" );
            $p_status = 1;
            $prepared_statement->bind_param("isdii", $cid, $product_name,$product_price,$product_stock,$p_status);   
            $result = $prepared_statement->execute() or die($this->con->error);


            if($result){
                return "PRODUCT_ADDED";
            } else{
                return 0;
            }
        }

    }

    


// $op = new DBOperations();
//   echo $op->addCategory("Mobiles");
//  print_r($op->getAllRecord("category"));

?>