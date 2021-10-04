<?php 
if($param == "DoctorPatientVist"){
$cond ='t1.docname='.'"'.$GLOBALS['username'].'" AND t1.patstatus="Waiting For Doctor Process"';
//$data=$db->getDbData("patients","docname",$cond,$single=False,$select=NULL);  
//var_dump($data);
$table="patients t1 INNER JOIN patientdetails t2 ON t2.hpatientid=t1.patientID";
$select="t1.*,t1.ID as PID,t2.*";
$data=$db->getDbData($table,"ID",$cond,FALSE,$select);
?>
<?php echo   $obj->head("Waiting For Doctor Visit");   ?>
<div class="text-right p-3">
<button type="button" class="btn btn-warning" id="open"  >OPEN</button>
</div>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SI.No</th>
                <th>Patients Name</th>
                <th>Patients ID</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Updated Time</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)) {  $i=0;?>
                <?php foreach($data as $patient) { ?>
                    <tr>
                        <td><?php echo $i+1 ?></td>
                        <td><?php echo $patient['patientname']; ?></td>
                        <td><?php echo $patient['hpatientid']; ?></td>
                        <td><?php echo $patient['patientage']; ?></td>
                        <td><?php echo $patient['patientphno']; ?></td>
                        <td><?php echo $patient['patientadd']; ?></td>
                        <td><?php echo $patient['submitime']; ?></td>
                        <td><input type="checkbox" class="form-checkbox-control" id="checkbox" style="height:30px; width:30px" value="<?php echo $patient['PID']  ?>"></td>
                    </tr>
                <?php $i++; } ?>
            <?php } ?>
        </tbody>
 </table>
 <script>
$(document).ready(function() {
$('#example thead tr').clone(true).appendTo( '#example thead' );
$('#example thead tr:eq(1) th').each( function (i) {
var title = $(this).text();
$(this).html( '<input type="text" class="form-control " placeholder="Search '+title+'" />' );
$( 'input', this ).on( 'keyup change', function () {
if ( table.column(i).search() !== this.value ) {
table
.column(i)
.search(this.value )
.draw();
}
} );
} ); 
var table = $('#example').DataTable( {
orderCellsTop: true,
searching: true,
"scrollX": true
} );
});
$("#open").click(function() {
    var edit_users_arr = [];
    $("#checkbox:checked").each(function(){
        var userid = $(this).val();
        edit_users_arr.push(userid);
        });
    var length=edit_users_arr.length;
    if(length == '1' ){
   var url= "index.php?action=DoctorRemarks&ID="+edit_users_arr;
   window.location.href=url;
    }else{
        swal('error','Please Select One Patient To Process','error')
    }
});
</script>
<?php }elseif($param == "DoctorRemarks"){ ?>
<?php
  echo $obj->head("Patients Details");
  $cond ='ID='.$_GET['ID'];
$data=$db->getDbData("users","ID",$cond,TRUE,$select=NULL); require_once("App/DetailsDisplay.php") ?>
<div class="container table-responsive py-5">
<?php
function get_patient_name($db,$pid){
  $sql= "SELECT t1.hpatientid  FROM patientdetails t1 INNER JOIN patients t2 ON t2.pid=t1.ID WHERE t2.ID='$pid'";
  //echo "sql :".$sql;
  $patientid = $db->exesql($sql);
  return isset($patientid) ? $patientid : 0;
}
$pid =$_GET['ID'];
$result = get_patient_name($db,$pid);
$cond ='t1.patientID='.'"'.$result.'" AND patstatus="Completed"';
$table="patients t1 INNER JOIN patientdetails t2 ON t2.hpatientid=t1.patientID LEFT JOIN fileupload t3 ON t3.patientID=t1.ID";
$select="t1.*,t2.*,t3.ID as FID";
$data=$db->getDbData($table,"ID",$cond,FALSE,$select);
//var_dump($data);
if(!empty($data)) { $i=0;   ?>
<table class="table table-bordered table-hover">
  <thead class="thead-dark">
  <tr>
                <th>SI.No</th>
                <th>Patient Name</th>
                <th>Patient ID</th>
                <th>Doctor Name</th>
                <th>Doctor Remarks</th>
                <th>Last Visit Date</th>
                <th>View File</th>
            </tr>
</thead>
<tbody>
</tbody>
          <?php foreach($data as $patient) { ?>
              <tr>
                  <td><?php echo $i+1 ?></td>
                  <td><?php echo $patient['patientname']; ?></td>
                  <td><?php echo $patient['hpatientid']; ?></td>
                  <td><?php echo $patient['docproname']; ?></td>
                  <td><?php echo $patient['docdesc']; ?></td>
                  <td><?php echo $patient['docprotime']; ?></td>
                  <td> <button class="btn btn-warning" id='view<?php echo $i  ?>'>View File</button><?php echo "<script>'use strict'; $('#view$i').click(function(){open('http://[::1]/SKP-Hospital/App/Fileview.php?ID=".$patient['FID']."', 'test', `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1000,height=1000,left=-100,top=-100`); }); </script>"  ?></td>
              </tr>
          </tr>
    <?php $i++; } ?>
</table>
<?php  } ?>
<form method="POST" class="needs-validation p-5" novalidate >
  <div class="row justify-content-center">
        <div class="col-md-12">
        <?php echo  $obj->textarea("Remarks","docdesc","yes",isset($data['uaddress']) ? $data['uaddress'] : "" ); ?>
        </div>
        <div class="col-md-12 p-4 text-center" >
        <?php echo  $obj->submit("Submit"); echo "  "; echo $obj->navigation("DoctorPatientVist","Cancel")?>
       </div>
    </div>
</form>
<?php 
$docprocobj = new stdClass();
$docprocobj->docdesc = $db->post('docdesc');
$docprocobj->docproname = $GLOBALS['username'];
$docprocobj->docprotime = $GLOBALS['datetime'];
$docprocobj->patstatus = "Waiting For Document Upload";
if($docprocobj->docdesc !='' && $docprocobj->docproname !=''){
   // echo "ID :".$_GET['ID'];
    $data = $db->update('patients',$docprocobj,"ID",$_GET['ID'],$type=0);
      if($data==true){
      echo "<script>swal('success','Proccessed Successfully','success');</script>";
      echo $obj->redirect("DoctorPatientVist");
    }
   }
}elseif($param=="DoctorVistProccessed"){
 $cond ='t1.docname='.'"'.$GLOBALS['username'].'" AND (t1.patstatus="Waiting For Document Upload" OR t1.patstatus="Completed")';
//$data=$db->getDbData("patients","docname",$cond,$single=False,$select=NULL);  
//var_dump($data);
$table="patients t1 INNER JOIN patientdetails t2 ON t2.hpatientid=t1.patientID";
$select="t1.*,t1.ID as PID,t2.*";
$data=$db->getDbData($table,"ID",$cond,FALSE,$select);
?>
<?php echo   $obj->head("Doctor Processed Patients");   ?>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SI.No</th>
                <th>Patients Name</th>
                <th>Patients ID</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Updated Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)) {  $i=0;?>
                <?php foreach($data as $patient) { ?>
                    <tr>
                        <td><?php echo $i+1 ?></td>
                        <td><?php echo $patient['patientname']; ?></td>
                        <td><?php echo $patient['hpatientid']; ?></td>
                        <td><?php echo $patient['patientage']; ?></td>
                        <td><?php echo $patient['patientphno']; ?></td>
                        <td><?php echo $patient['patientadd']; ?></td>
                        <td><?php echo $patient['submitime']; ?></td>
                        <td><?php echo $patient['patstatus']; ?></td>
                    </tr>
                <?php $i++; } ?>
            <?php } ?>
        </tbody>
 </table>
 <script>
$(document).ready(function() {
$('#example thead tr').clone(true).appendTo( '#example thead' );
$('#example thead tr:eq(1) th').each( function (i) {
var title = $(this).text();
$(this).html( '<input type="text" class="form-control " placeholder="Search '+title+'" />' );
$( 'input', this ).on( 'keyup change', function () {
if ( table.column(i).search() !== this.value ) {
table
.column(i)
.search(this.value )
.draw();
}
} );
} ); 
var table = $('#example').DataTable( {
orderCellsTop: true,
searching: true,
"scrollX": true
} );
});
$("#open").click(function() {
    var edit_users_arr = [];
    $("#checkbox:checked").each(function(){
        var userid = $(this).val();
        edit_users_arr.push(userid);
        });
    var length=edit_users_arr.length;
    if(length == '1' ){
   var url= "index.php?action=DoctorRemarks&ID="+edit_users_arr;
   window.location.href=url;
    }else{
        swal('error','Please Select One Patient To Process','error')
    }
});
</script>
<?php }