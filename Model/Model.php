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
            $words = array(0 => '', 1 => 'one', 2 => 'two',
                3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
                7 => 'seven', 8 => 'eight', 9 => 'nine',
                10 => 'ten', 11 => 'eleven', 12 => 'twelve',
                13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
                19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
                40 => 'forty', 50 => 'fifty', 60 => 'sixty',
                70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
            $digits = array('', 'hundred','thousand','lakh', 'crore');
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