<?php
if($param == "FileUpload"){
$cond ='t1.patstatus="Waiting For Document Upload"';
//$data=$db->getDbData("patients","docname",$cond,$single=False,$select=NULL);  
//var_dump($data);
$table="patients t1 INNER JOIN patientdetails t2 ON t2.hpatientid=t1.patientID";
$select="t1.*,t1.ID as PID,t2.*";
$data=$db->getDbData($table,"ID",$cond,FALSE,$select);
?>
<?php echo   $obj->head("Waiting For File Upload");   ?>
<div class="text-right p-3">
<button type="button" class="btn btn-dark" id="open"  >UPLOAD</button>
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
   var url= "index.php?action=FileUploadForm&ID="+edit_users_arr;
   window.location.href=url;
    }else{
        swal('error','Please Select One Patient To Process','error')
    }
});
</script>
<?php }elseif($param == "FileUploadForm"){ ?>
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
$table="patients t1 INNER JOIN patientdetails t2 ON t2.hpatientid=t1.patientID";
$select="t1.*,t2.*";
$data=$db->getDbData($table,"ID",$cond,FALSE,$select);
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
              </tr>
          </tr>
    <?php $i++; } ?>
</table>
<?php  } ?>
<div class="text-left" style="color:red"><span ><i> Note :  For File Upload Please click  upload button After Browsed File, Then click Save & Next For Payment Process</i><span></div>
<form  method="POST" class="needs-validation p-4" novalidate enctype="multipart/form-data">
  <div class="row justify-content-center">
        <div class="col-md-8">
        </div>
          <table class="alert alert-info p-5" style="border-collapse: collapse; width: 100%; height: 10px; margin-left: auto; margin-right: auto;" border="0">
            <tbody>
            <tr style="height: 10px;">
            <td style="width: 24.0658%; height: 10px;"><span style="font-family: arial, helvetica, sans-serif; color: #37076d;"><em><strong>Please Browse The Receipt File</strong></em></span></td>
            <td style="width: 24.0658%; height: 10px;">&nbsp;</td>
            <td style="height: 10px; width: 51.7958%;" colspan="2"><input type="file"  name="fileToUpload" required class="form-control" id="fileToUpload"><span class="invalid-feedback">Please Browse the Patient Receipr</span>
            </td>
            </tr>
            </tbody>
            </table>
            <div class="col-md-12">
        <?php echo  $obj->textarea("Remarks","filedesc","yes",isset($data['filedesc']) ? $data['filedesc'] : "" ); ?>
        </div>
        <div class="col-md-12 p-4 text-center" >
        <?php echo  $obj->submit("UPLOAD"); echo "  ";echo  $obj->navigation("Payment&ID=".$_GET['ID'],"Save & Next","background-color:blue"); echo "  "; echo $obj->navigation("FileUpload","Cancel")?>
       </div>
    </div>
</form>
<?php
if(isset($_POST["submit"])) {
$path = dirname(__DIR__).DIRECTORY_SEPARATOR."temp/data/".$_GET['ID'];
if(!(file_exists($path))){
    mkdir($path);
}
$target_dir = dirname(__DIR__).DIRECTORY_SEPARATOR."temp/data/".$_GET['ID'].'/';// .$_GET['ID'].'/'
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename =basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//echo "FIle Ext :".$imageFileType."Base Name :".$target_file;

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<script>swal('Error','Sorry, your file is too large','error');</script>";
        $uploadOk = 0;
      }
      if($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "<script>swal('Error','Sorry, Only PDF files are allowed.','error');</script>";
            $uploadOk = 0;
     }
     if ($uploadOk == 0) {
        echo "<script>swal('Error','Sorry, your file was not uploaded','error');</script>";
      } else {
        $fobj= new stdClass();
        $fobj->patientID = $_GET['ID'];
        $fobj->filedesc = $db->post('filedesc');
        $fobj->fuploadname = $GLOBALS['username'];
        $fobj->fuploadtime = $GLOBALS['datetime'];
        $fobj->filepath = $filename;
        if($fobj->patientID != '' &&  $fobj->filedesc != '' && $fobj->fuploadname !='' &&  $fobj->filepath !=''){
            $data = $db->insert('fileupload',$fobj);
            $supobj = new stdClass();
            $supobj->patstatus= "Completed";
            $supdate = $data = $db->update('patients',$supobj,"ID",$_GET['ID'],$type=0);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "<script>swal('success','The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.','success');</script>";
            //    echo $obj->redirect("FileUpload");
            } else {
                echo "<script>swal('Error','Sorry, there was an error uploading your file.','error');</script>";
            }
            $fobj->filedesc='' &&  $fobj->filepath='' ;
        }
    }
}
}elseif($param =="CompletedPatients"){
    $cond ='t1.patstatus="Completed"';
    $table="patients t1 INNER JOIN patientdetails t2 ON t2.hpatientid=t1.patientID";
    $select="t1.*,t1.ID as PID,t2.*";
    $data=$db->getDbData($table,"ID",$cond,FALSE,$select);  ?>
<?php echo   $obj->head("Completed Patients");   ?>
<div class="text-right p-3">
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
   var url= "index.php?action=FileUploadForm&ID="+edit_users_arr;
   window.location.href=url;
    }else{
        swal('error','Please Select One Patient To Process','error')
    }
});
</script>
<?php    
}elseif($param=="Payment"){
     echo   $obj->head("Waiting For Payment Process"); 
     require_once("App/DetailsDisplay.php");
     $cond= "patinetID=".$_GET['ID'];
     $data=$db->getDbData("patinetsfeesdeatils","patinetID",$cond,FALSE,$select=NULL);
?>
<form method="POST" class="needs-validation p-5" novalidate>
<table class="table table-bordered table-hover">
  <thead class="thead-light">
  <tr>
                <th></th>
                <th width="2px"><?php echo  $obj->input_readonly("","pfeesid",isset($data['pfeesid']) ? $data['pfeesid'] : "","display:none" ); ?></th>
                <th><?php echo $obj->options("Fees Type","feestype","yes",$db->select_option("feesdeatils","feestype","feestype","feestype")); ?></th>
                <th><?php echo  $obj->options("Fees","feesname","yes",$db->select_option("feesdeatils","feesname","feesname","feesname")); ?></td>
                <th><?php echo  $obj->input_number("Quantity","feesquant","yes",isset($data['feesquant']) ? $data['feesquant'] : "" ); ?></th>
                <th><?php echo  $obj->input_number("Amount","feesamount","yes",isset($data['feesamount']) ? $data['feesamount'] : "" ); ?></th>
                <th><?php echo  $obj->input_number("Total Amount","totalamount","yes",isset($data['totalamount']) ? $data['totalamount'] : "" ); ?></th>
                <th><?php echo  $obj->submit("Submit","submit");  echo "  "; ?></th>
            </tr>
</thead>
<tbody>
</tbody>
</form>
<?php  
$newobj = new stdClass();
$newobj->patinetID = $_GET['ID'];
$newobj->feestype = $db->post('feestype');
$newobj->feesname = $db->post('feesname');
$newobj->feesquant = $db->post('feesquant');
$newobj->feesamount = $db->post('feesamount');
$newobj->totalamount = $db->post('totalamount');
$newobj->submit_by = $GLOBALS['username'];
$newobj->submit_time = $GLOBALS['datetime'];
$pfeesid = intval($db->post('pfeesid'));
//echo "PID".$pfeesid;
//var_dump($newobj);
if($newobj->feestype!='' && $newobj->feesamount!=''){
if($pfeesid == 0){
$db->insert("patinetsfeesdeatils",$newobj);
echo "<script>swal('success','Inserted Successfully','success');</script>";
echo $obj->redirect("Payment&ID=".$_GET['ID']);
}else{
$db->update('patinetsfeesdeatils',$newobj,"ID",$pfeesid,$type=0);
echo "<script>swal('success','Updated Successfully','success'); </script>";
echo $obj->redirect("Payment&ID=".$_GET['ID']);
}
}else{
}
?>
<table class="table table-bordered table-hover">
<button type="button" class="btn btn-danger" id="delete" >Delete</button>   
<div class="text-right" style="color:red"><span ><i>Please Select Checkbox For Edit And Delete</i><span></div>
<thead class="thead-dark">
  <tr>
                <th>SI.No</th>
                <th>Fees Type</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Total Amount</th>
                <th>Last Updated Date</th>
                <th>Edit</th>
            </tr>
</thead>
<tbody>
</tbody><?php  if(!empty($data))  { $i=0;   ?>
          <?php foreach($data as $fees) { ?>
              <tr>
                  <td><?php echo $i+1 ?></td>
                  <td><?php echo $fees['feestype']; ?></td>
                  <td><?php echo $fees['feesname']; ?></td>
                  <td><?php echo $fees['feesquant']; ?></td>
                  <td><?php echo $fees['feesamount']; ?></td>
                  <td><?php echo $fees['totalamount']; ?></td>
                  <td><?php echo $fees['submit_time']; ?></td>
                  <td><input type="checkbox" class="form-checkbox-control" onchange="check();" id="checkbox" style="height:30px; width:30px" value="<?php echo $fees['ID']  ?>"></td>
              </tr>
          </tr>
    <?php $i++; } }  ?>
</table><div class="text-center">
<a href="App/Paymentbill.php?id=<?php echo $_GET['ID']; ?>" target="_blank" class="btn btn-warning ">External Preview</a>  
<a class="btn btn-primary" onclick="printPage(urls);">Print Fees Receipt</a></div>
<script>
function check(){
edit_users_arr = [];
$("#checkbox:checked").each(function(){
        var userid = $(this).val();
        edit_users_arr.push(userid);
});
var length=edit_users_arr.length;
if(length==1){
$.ajax({  
    url:"Model/AjaxModel.php?functionname=getdata_for_feesedit&id="+edit_users_arr,  
    method:"POST",  
    dataType:"json",  
    success:function(data){  
    $('#feestype').val(data.feestype); 
    $('#feesname').val(data.feesname); 
    $('#feesdesc').val(data.feesdesc); 
    $('#feesquant').val(data.feesquant)
    $('#feesamount').val(data.feesamount); 
    $('#totalamount').val(data.totalamount); 
    $('#pfeesid').val(data.ID); 
    $('#submit').val("Update");
    }  
});
}else{
       // swal('Error',"Please Select One Item To Edit",'error');
}
}
$('#feesquant').change(function(){
  var quant = $(this).val();
  var amount = $('#feesamount').val();
  var total = quant * amount;
  $('#totalamount').val(total);
});
$("#feesname").change(function(){
 var feestype = $(this).val();
 get_fees_select(feestype)
});
function  get_fees_select(feestype){
$.ajax({  
    url:"Model/AjaxModel.php?functionname=get_amount_data&id="+feestype,  
    method:"POST",  
    dataType:"json",  
    success:function(data){  
    console.log(data);
    $('#feesamount').val(data.feesamount); 
    }  
});
}
$('#delete').click(function(e){
  e.preventDefault();
var users_arr = [];
$("#checkbox:checked").each(function(){
var userid = $(this).val();
console.log("Userids :"+userid);
users_arr.push(userid);
});
var length = users_arr.length;
console.log("Length Of Userid :"+length +"Userid In Array :"+users_arr);
if(length <= 0){
setTimeout(function() {
swal({
title: "ERROR!",
text: "Please Select Atlease One Data",
type: "error"
});
}, 100);
}else {
  swal({
    title: "Are you sure?",
    text: "Do You Want To Delete!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "red",
    confirmButtonText: "Delete",
  }).then(result => {
    swal("Deleted!", "Fees Details deleted Successfully.", "success");
    if (result.value) {
      $.ajax({  
        url:"Model/AjaxModel.php?functionname=deletepatientsfeesdetails&id=",  
        method:"POST",  
        data:{users_arr :users_arr},  
        success:function(data){  
        window.location.reload();
        }  
        }); 
    } else if (
      result.dismiss === swal.DismissReason.cancel
    ) {
      swal("Cancelled", "Fees Details  are Safe", "success");
    };
  });
}
});
</script>
<script type="text/javascript">
function closePrint () {
  document.body.removeChild(this.__container__);
}

function setPrint () {
  this.contentWindow.__container__ = this;
  this.contentWindow.onbeforeunload = closePrint;
  this.contentWindow.onafterprint = closePrint;
  this.contentWindow.focus(); // Required for IE
  this.contentWindow.print();
}

function printPage (sURL) {
  var oHideFrame = document.createElement("iframe");
  oHideFrame.onload = setPrint;
  oHideFrame.style.position = "fixed";
  oHideFrame.style.right = "0";
  oHideFrame.style.bottom = "0";
  oHideFrame.style.width = "0";
  oHideFrame.style.height = "0";
  oHideFrame.style.border = "0";
  oHideFrame.src = sURL;
  document.body.appendChild(oHideFrame);
}
var urls = "App/Paymentbill.php?id="+<?php echo $_GET['ID'] ?>;   
</script>
<?php
}
?>