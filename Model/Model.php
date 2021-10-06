<?php
$logfile ='log/'. date('Y-m-d').'.txt';
ini_set("error_log",$logfile);
spl_autoload_register(function($className) {
    require_once $className.".php";
});
class model {
    
    public function post($param){ 
            $data = isset($_POST[$param]) ? trim($_POST[$param]) : "";           
            $data = trim($data);  
            $data = stripslashes($data);  
            $data = htmlspecialchars($data);  
            return $data;  
          
    }
    public function insert($table,$data) {
        $database = new Database();
        $insertData = (array)$data; 
        $keys = array_keys( $insertData);
        $sql = "INSERT INTO ".$table." ";
        $sql .= "(". implode(",", $keys)  .") VALUES (:". implode(", :", $keys).")";
         $stmt = $database->config()->prepare($sql);
        try{           
           // var_dump($stmt);
           error_log("SQL : <br/>,$sql");
            $data = $stmt->execute($insertData);
            $result = Database::config()->lastInsertId();
            return $result;
        } catch (PDOException $e){
             echo "sql = ".$sql."<br/>".$e->getMessage();
             error_log("SQL",$e->getMessage());
             return false;
        }

    }
    public function update($table,$data,$param,$value,$type=0){
        $database = new Database();
        // array keys
        $insertData = (array)$data; 
        $keys = array_keys( $insertData);
        $sql = "UPDATE ".$table." SET ";
        $temp = array();
        foreach($keys as $key) $temp[] = $key." = :".$key;
        $sql .= implode(", ",$temp);
        $sql .= " WHERE " . $param . " = '" . $value."'";
       //   echo "SQL :".$sql;
        error_log("SQL : <br/>,$sql");
         $stmt = $database->config()->prepare($sql);
        try{           
            $stmt->execute($insertData);
            $result = TRUE;
            return $result;
        } catch (PDOException $e){
             echo "sql = ".$sql."<br/>".$e->getMessage();
             error_log("SQL",$e->getMessage());
             return false;
        }
    }
    /*
    //  * retriving the data from a particular table
    //  */
    public function getDbData($table,$data,$sqlq,$single=False,$select=NULL){
        $database = new Database();
        $insertData = (array)$data;          
        $sql = "SELECT ";        
        $sql .= ($select!=NULL) ? $select:" * ";
        $sql.= " FROM ".$table."";      
        if($data !=NULL && $sqlq!=NULL) {
            $sql .= " WHERE " . $sqlq;     
        }
        // echo $sql;
        error_log("SQL : <br/>,$sql");
        $stmt = $database->config()->prepare($sql);
        try{
            $stmt->execute();
            if($single==FALSE) {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            else {
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            }
                 return $rows;
        } catch (PDOException $e) {
            error_log("SQL",$e->getMessage());
            echo $sql."<br/>".$e->getMessage();
            debug_print_backtrace();
            return NULL;
        }
       // return "";
       
    }
    public function doctors(){ 
        $database = new Database();
        $output = '';
        $query = "SELECT * FROM doctorsdetails  ORDER BY docname  ASC";
        error_log("SQL : <br/>,$query");
        $statement =$database->config()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row)
        {
        $output .= '<option value="'.$row["docname"].'">'.$row["docname"].'</option>';
        }
        return $output; 
        }
    public function select_option($table,$key,$value,$order){ 
        $database = new Database();
        $output = '';
        $query = "SELECT * FROM ".$table." GROUP BY ".$key." ORDER BY ".$order."  ASC ";
        //echo 'sql'.$query;
        error_log("SQL : <br/>,$query");
        $statement =$database->config()->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row)
        {
        $output .= '<option value="'.$row[$key].'">'.$row[$value].'</option>';
        }
        return $output; 
        }
      public function getIndianCurrency(float $number)
        {
            $decimal = round($number - ($no = floor($number)), 2) * 100;
            $hundred = null;
            $digits_length = strlen($no);
            $i = 0;
            $str = array();
            $words = array(0 => '', 1 => 'One', 2 => 'Two',
                3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
            $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
            while( $i < $digits_length ) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += $divider == 10 ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                } else $str[] = null;
            }
            $Rupees = implode('', array_reverse($str));
            $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
            return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
        }
       public function exesql($sql){
            $database = new Database(); 
            $stmt = $database->config()->prepare($sql);
            //$database->config()->$sql;
            error_log("SQL : <br/>,$sql");
            try{
                $stmt->execute();
                $rows = $stmt->fetchColumn();
                return $rows;
                } catch (PDOException $e) {
                echo $sql."<br/>".$e->getMessage();
                return NULL;
                }
        }
        public function count($parameter,$table,$condition){
            $database = new Database(); 
            $sql ="SELECT COUNT(".$parameter.") FROM ".$table." WHERE ".$condition;
            // echo  "SQL ".$sql;
            error_log("SQL : <br/>,$sql");
            $stmt = $database->config()->prepare($sql);
            try{
             $stmt->execute();
             $rows = $stmt->fetchColumn();
             return $rows;
             } catch (PDOException $e) {
             echo $sql."<br/>".$e->getMessage();
             return NULL;
             }
        }
        public function overallcount($parameter,$table){
            $database = new Database(); 
            $sql ="SELECT COUNT(".$parameter.") FROM ".$table;
           // echo  "SQL ".$sql;
           error_log("SQL : <br/>,$sql");

            $stmt = $database->config()->prepare($sql);
            try{
             $stmt->execute();
             $rows = $stmt->fetchColumn();
             return $rows;
             } catch (PDOException $e) {
             echo $sql."<br/>".$e->getMessage();
             return NULL;
             }
        }
        public function sum($parameter,$table,$condition){
            $database = new Database(); 
            $sql ="SELECT SUM(".$parameter.") FROM ".$table." WHERE ".$condition;
           // echo  "SQL ".$sql;
           error_log("SQL : <br/>,$sql");
            $stmt = $database->config()->prepare($sql);
            try{
             $stmt->execute();
             $rows = $stmt->fetchColumn();
             return $rows;
             } catch (PDOException $e) {
             echo $sql."<br/>".$e->getMessage();
             return NULL;
             }
        } 
        public function max($parameter,$table,$condition=NULL){
            $database = new Database(); 
            $sql ="SELECT MAX(".$parameter.") FROM ".$table." WHERE ".$condition;
           // echo  "SQL ".$sql;
           error_log("SQL : <br/>,$sql");
            $stmt = $database->config()->prepare($sql);
            try{
             $stmt->execute();
             $rows = $stmt->fetchColumn();
             return $rows;
             } catch (PDOException $e) {
             echo $sql."<br/>".$e->getMessage();
             return NULL;
             }
        } 
        public function overallmax($parameter,$table){
            $database = new Database(); 
            $sql ="SELECT MAX(".$parameter.") FROM ".$table;
           // echo  "SQL ".$sql;
           error_log("SQL : <br/>,$sql");
            $stmt = $database->config()->prepare($sql);
            try{
             $stmt->execute();
             $rows = $stmt->fetchColumn();
             return $rows;
             } catch (PDOException $e) {
             echo $sql."<br/>".$e->getMessage();
             return NULL;
             }
        } 
}

?>