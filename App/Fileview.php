<?php
require_once("../Model/Model.php");
  $id = filter_input(INPUT_GET, "ID", FILTER_VALIDATE_INT);
  if (!$id)
       header("HTTP/1.1 400 Bad Request");
       $cond="t3.ID=".$_GET['ID'];
       $table = "patientdetails t1 INNER JOIN patients t2 ON t2.pid=t1.ID INNER JOIN fileupload t3 ON t3.patientID=t2.ID";
       $select=" t2.ID as PID,t3.filepath as fileloc";
      $result= Model::getDbData($table,"ID",$cond,FALSE,$select);
      var_dump($result);
      $temp ='';$pid = '';
      foreach($result as $data){
        $temp = $data['fileloc'];
        $pid = $data['PID'];
      }
  if (! $result)
       header("HTTP/1.0 404 Not Found");
 $path =dirname(__DIR__).DIRECTORY_SEPARATOR."temp/data/".$pid.'/'.$temp; //
 echo "Path".$path;
$file = $path;
$filename = $temp;  
// Header content type
header('Content-type: application/pdf');
  
header('Content-Disposition: inline; filename="' . $filename . '"');
  
header('Content-Transfer-Encoding: binary');
  
header('Accept-Ranges: bytes');
  
// Read the file
@readfile($file);
?>