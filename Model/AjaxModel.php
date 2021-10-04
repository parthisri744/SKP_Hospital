<?php 
require_once('Database.php');
require_once('Model.php');
$logfile ='log/'. date('Y-m-d').'.txt';
ini_set("error_log",$logfile);
//$id=$_GET['id'];
error_reporting(E_ALL);
$db= new Model();
$database = new Database();
$getmethod = $_GET['functionname'];
if($getmethod == 'deletepatients'){
        $ids = isset($_POST["users_arr"]) ? $_POST["users_arr"] : "";
        $ids = implode(',',$ids);
        $query = $database->config()->prepare("DELETE FROM patientdetails WHERE ID IN ( $ids )");
        $query->execute();
        echo "Deleted Successfully";
}elseif($getmethod == 'deletedoctors'){
       $ids = isset($_POST["users_arr"]) ? $_POST["users_arr"] : "";
        $ids = implode(',',$ids);
        $query = $database->config()->prepare("DELETE FROM doctorsdetails WHERE ID IN ( $ids )");
        $query->execute();
        echo "Deleted Successfully";
}elseif($getmethod == 'doctorsdata'){
       $cond ='Docname="'.$_GET['Docname'].'"';
       $data=$db->getDbData("doctorsdetails","docname",$cond,TRUE,$select=NULL);
       echo json_encode($data);
      // echo json_encode(array_shift($data));
}elseif($getmethod == 'deleteusers'){
        $ids = isset($_POST["users_arr"]) ? $_POST["users_arr"] : "";
        $ids = implode(',',$ids);
        $query = $database->config()->prepare("DELETE FROM users WHERE ID IN ( $ids )");
        $query->execute();
        echo "Deleted Successfully";    
}elseif($getmethod  == 'getdata_for_edit'){
        $cond ='ID="'.$_GET['id'].'"';
        $data=$db->getDbData("feesdeatils","docname",$cond,TRUE,$select=NULL);
        echo json_encode($data);
}elseif($getmethod == 'deletefeesdetails'){
        $ids = isset($_POST["users_arr"]) ? $_POST["users_arr"] : "";
        $ids = implode(',',$ids);
        $query = $database->config()->prepare("DELETE FROM feesdeatils WHERE ID IN ( $ids )");
        $query->execute();
        echo "Deleted Successfully";      
}elseif($getmethod == 'getdata_for_feesedit'){
        $cond ='ID="'.$_GET['id'].'"';
        $data=$db->getDbData("patinetsfeesdeatils","patinetID",$cond,TRUE,$select=NULL);
        echo json_encode($data);
}elseif($getmethod == 'deletepatientsfeesdetails'){
        $ids = isset($_POST["users_arr"]) ? $_POST["users_arr"] : "";
        $ids = implode(',',$ids);
        $query = $database->config()->prepare("DELETE FROM patinetsfeesdeatils WHERE ID IN ( $ids )");
        $query->execute();
        echo "Deleted Successfully";
}elseif($getmethod=='get_amount_data'){
        $cond ='feesname="'.$_GET['id'].'"';
        $data=$db->getDbData("feesdeatils","patinetID",$cond,TRUE,"feesamount");
        echo json_encode($data);
}