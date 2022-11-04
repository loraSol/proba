<?php

class Manage{


    private $con;

    function  __construct(){
        include_once("../database/db.php");
        $db = new Database();
        $this->con =  $db->connect();
    }


    public function manageRecord($table){
        if($table == "category"){
            $sql = "SELECT * FROM category";
        } 
        
        else if($table == "products"){
            $sql = "SELECT * FROM products";
        } 
        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo("eeej");
                $rows[] = $row;   
            }
        }
        return $rows;
    }


    public function deleteRecord($table,$id){
        if($table == "category"){
            // proveram da li postoji neki proizvod koji se nalazi u kategoriji koju pokusavam da obrisem
            $prep_stat = $this->con->prepare("SELECT * FROM category c LEFT JOIN products p ON c.cid = p.cid 
                                                WHERE p.cid = ?");
            $prep_stat->bind_param("i",$id);
            $prep_stat->execute()  or die($this->con->error);
            $res_check = $prep_stat->get_result();

            // ako postoji bar jedan proizvod u kategoriji, brisanje kategorije nije dozvoljeno
            if($res_check->num_rows > 0){
                return "DELETE_RESTRICTED";
            } else{
            // ako ne postoji nijedan proizvod u toj kategorija, onda nastavi sa brisanjem
            $prepared_statement = $this->con->prepare("SELECT cid FROM category WHERE cid = ?");
            $prepared_statement->bind_param("i",$id);
            $prepared_statement->execute()  or die($this->con->error);
            $result = $prepared_statement->get_result();

            if($result->num_rows == 1){
                //return "MOZE BRISANJE";
                $prepared_statement = $this->con->prepare("DELETE FROM category WHERE cid = ?");
                $prepared_statement->bind_param("i",$id);
                $result = $prepared_statement->execute() or die($this->con->error);;
                if($result){
                    return "CATEGORY_DELETED";
                } else{
                    return "ERROR_DELETE_CATEGORY";
                }
            } 
        }

        //  BRISANJE PROIZVODA (nema nikakva ogranicenja)
        } else if($table == "products"){
            // Ako nije tabela category, nego Products
            $prepared_statement = $this->con->prepare("DELETE FROM products WHERE pid = ?");
            $prepared_statement->bind_param("i",$id);
            $result = $prepared_statement->execute() or die($this->con->error);
            if($result){
                return "PRODUCT_DELETED";
            } else{
                return "ERROR_DELETE_PRODUCT";
            }
        }
    }



    // Vrati naziv kategorije na osnovu id
    public function getCategoryName($cid){
        $sql = "SELECT c.name_category FROM category c LEFT JOIN products p ON c.cid=p.cid WHERE c.cid =".$cid;
        $result = $this->con->query($sql) or die($this->con->error);
        $name = $result->fetch_assoc();
        return $name["name_category"];
    }


    // get singleRecord
    public function getSingleRecord($table,$id){
        if($table == "category"){

            $prepared_statement = $this->con->prepare("SELECT * FROM category WHERE cid = ?");
            $prepared_statement->bind_param("i",$id);
            $prepared_statement->execute() or die($this->con->error);
            $result = $prepared_statement->get_result();

            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
            }
            return $row;

        } else if($table == "products"){
            $prepared_statement = $this->con->prepare("SELECT * FROM products WHERE pid = ?");
            $prepared_statement->bind_param("i",$id);
            $prepared_statement->execute() or die($this->con->error);
            $result = $prepared_statement->get_result();

            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
            }
            return $row;

        }
    }



    // Update bilo sta
    // $where je niz, $fields isto niz
    // $where su uslovi, gde da menjam(id=5,name=Pera ...) a $fields su polja u koja zelim da unesem nove vrednosti
    public function update_record($table,$where,$fields){
        $sql="";
        $condition="";
        foreach($where as $key=>$value){
            // mora da stoji , umesto AND jer kad je AND javlja gresku  u bazi: ERROR 1292 (22007): Truncated incorrect DOUBLE value
            $condition .= $key . "='" . $value."' , ";
        }
        // kad se izvrsi petlja ostaje mi space,space da visi, moram to da sklonim pa kratim string sa kraja za 3 polja
        // originalno je bilo -5 jer je u kodu stajalo AND, posto je sad zarez ide -3
        $condition = substr($condition,0,-3);

        foreach($fields as $key=>$value){
            // ovde isto, ide , umesto AND
            $sql .= $key . "='" . $value ."' , ";
        }
        $sql = substr($sql,0,-3);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
        //echo($sql);
        if(mysqli_query($this->con,$sql)) {
            return "UPDATED";
        }
        return "UPDATE_FAILED";
    }



    // Ubacivanje nove porudzbine u bazu

    public function storeOrder($order_date,$employee_name,$rows_tqty,$rows_qty,$rows_price,$rows_name ,$sub_total,
                                $gst,$net_total,$payment_type){
  
        $prepared_statement = $this->con->prepare("INSERT INTO invoice(employee_name,order_date,
                                sub_total,gst,neto_total,payment_type) VALUES(?,?,?,?,?,?)");
        $prepared_statement->bind_param("ssddds",$employee_name,$order_date,$sub_total,$gst,$net_total,$payment_type);
        $prepared_statement->execute() or die($this->con->error);
        $invoice_id = $prepared_statement->insert_id;            // vraca invoice_id kreiranog objekta

        if($invoice_id != NULL){
            for($i = 0; $i < count($rows_name) ; $i++){
                $insert_product_statement = $this->con->prepare("INSERT INTO invoice_details(invoice_id,product_name,
                                        price,qty) VALUES(?,?,?,?);");
                $insert_product_statement->bind_param("isdd",$invoice_id,$rows_name[$i],$rows_price[$i],$rows_qty[$i]);
                $insert_product_statement->execute() or die($this->con->error);
            }
            return "INVOICE_INSERTED";
        } else{
            return "INVOICE_INSERT_FAILED";
        }


    }

}



//$obj = new Manage();
//echo "<pre>";
//print_r($obj->manageRecord("category"));
//echo $obj->deleteRecord("category",2);
//print_r($obj->getSingleRecord("category",6));
//print_r($obj->getSingleRecord("products",3));
//echo $obj->update_record("products",["pid"=>5],["product_name"=>"Samsung Galaxy 11"]);
 //echo $obj->getCategoryName(11);
//echo $obj->storeOrder("25-02-2019","zika",[111],[10],[23.3],["coko"],100,2,20,"cek",);

?>