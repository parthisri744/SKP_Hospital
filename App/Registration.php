<?php 
if($param=="PatientsReg"){
$cond ='ID='.$_GET['id'];
$data=$db->getDbData("patientdetails","ID",$cond,TRUE,$select=NULL);
?>
<?php  echo $obj->head("Patients Registartion Form");  ?>
<form method="POST" class="needs-validation p-5" novalidate >
  <div class="row">
        <div class="col-md-4">
        <?php echo  $obj->input_text("Patient Name","pname","yes",isset($data['patientname']) ? $data['patientname'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_number("Patient Age","age","yes",isset($data['patientage']) ? $data['patientage'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_number("Phone Number","phno","no",isset($data['patientphno']) ? $data['patientphno'] : "" ); ?>
        </div>
        <div class="col-md-12">
        <?php echo  $obj->textarea("Address","paddress","no",isset($data['patientadd']) ? $data['patientadd'] : "" ); ?>
        </div>
        <?php   echo $obj->input_hidden("pid",$_GET['id']);?>
        <div class="col-md-12 p-4 text-center" >
        <?php echo  $obj->submit("Register"); echo " ";  echo $obj->reset("Reset");?>
       </div>
    </div>
</form>
<?php
$name = $db->post('pname');
$age = $db->post('age');
$phno = $db->post('phno');
$paddress = $db->post('paddress');
function patientsid_generate($db){
        $sql= "SELECT MAX(patientid) as patientid FROM patientdetails";
        $feesid = $db->exesql($sql);
        return isset($feesid) ? intval($feesid)+1 : 0;
}       
if(isset($_POST['submit'])){
if($_GET['id'] == 0){
if($name !='' && $age != ''){
        $newobj = new stdClass();
        $newobj->patientname = $name;
        $newobj->patientage =$age;
        $newobj->patientphno = $phno;
        $newobj->patientadd = $paddress;
        $newobj->patientid = patientsid_generate($db);
        $newobj->hpatientid = "SKP/".date('m').'/'.date('Y').'/'.patientsid_generate($db);
        $newobj->submitname = $GLOBALS['username'];
        $data = $db->insert('patientdetails',$newobj);
        echo "<script>swal('success','Registered  Successfully','success');</script>";
        
        $name ='';$age='';$phno='';$paddress='';
}else{
        echo "<script>swal('error','Please Fill The Form Credentials','error')</script>";
}
}else{
        $upobj = new stdClass();
        $upobj->patientname = $name;
        $upobj->patientage =$age;
        $upobj->patientphno = $phno;
        $upobj->patientadd = $paddress;
        $upobj->submitname = $GLOBALS['username'];
     //   var_dump($upobj);
        $data = $db->update('patientdetails',$upobj,"ID",$_GET['id'],$type=0);
      //  var_dump($data);
        if($data==true){
        echo "<script>swal('success','Updated  Successfully','success');</script>";
        echo $obj->redirect("PatientsList");
        }
}
}

}elseif($param == "FeesDetails"){
echo $obj->head("Fees Payment Details"); 
$data=$db->getDbData("feesdeatils","","",FALSE,$select=NULL);
?>
<form method="POST" class="needs-validation p-5" novalidate>
<table class="table table-bordered table-hover">
  <thead class="thead-light">
  <tr>
                <th></th>
                <th width="2px"><?php echo  $obj->input_readonly("","feesid",isset($data['feesid']) ? $data['feesid'] : "","display:none" ); ?></th>
                <th><?php echo  $obj->input_text("Fees Type","feestype","yes",isset($data['feestype']) ? $data['feestype'] : "" ); ?></th>
                <th><?php echo  $obj->input_text("Fees Description","feesdesc","yes",isset($data['feesdesc']) ? $data['feesdesc'] : "" ); ?></th>
                <th><?php echo  $obj->input_text("Fees Name","feesname","yes",isset($data['feesname']) ? $data['feesname'] : "" ); ?></td>
                <th><?php echo  $obj->input_number("Fees Amount","feesamount","yes",isset($data['feesamout']) ? $data['feesamount'] : "" ); ?></th>
                <th><?php echo  $obj->submit("Submit","submit");  echo "  "; ?></th>
                <input type="hidden" id="feesid" class="feesid">
            </tr>
</thead>
<tbody>
<table class="table table-bordered table-hover">
</form>
<div>
<button type="button" class="btn btn-danger" id="delete" >Delete</button>
<div class="text-right" style="color:red"><span ><i>Please Select Checkbox For Edit And Delete</i><span></div>
</div>
<?php  
$newobj = new stdClass();
$newobj->feestype = $db->post('feestype');
$newobj->feesname = $db->post('feesname');
$newobj->feesdesc = $db->post('feesdesc');
$newobj->feesamount = $db->post('feesamount');
$newobj->submit_by = $GLOBALS['username'];
$newobj->submit_time = $GLOBALS['datetime'];
$feesid = intval($db->post('feesid'));
if($newobj->feestype!='' && $newobj->feesdesc!='' && $newobj->feesamount!=''){
if($feesid == 0){
$data = $db->insert("feesdeatils",$newobj);
echo "<script>swal('success','Inserted Successfully','success');</script>";
echo $obj->redirect("FeesDetails");
}else{
$db->update('feesdeatils',$newobj,"ID",$feesid,$type=0);
echo "<script>swal('success','Updated Successfully','success');</script>";
echo $obj->redirect("FeesDetails");
}
}else{
}
?>
<table class="table table-bordered table-hover">
<thead class="thead-dark">
  <tr>
                <th>SI.No</th>
                <th>Fees Type</th>
                <th>Fees Name</th>
                <th>Fees Description</th>
                <th>Fees Amount</th>
                <th>Last Updated Date</th>
                <th>Edit</th>
            </tr>
</thead>
<tbody>
</tbody><?php  if(!empty($data)) { $i=0;   ?>
          <?php foreach($data as $fees) { ?>
              <tr>
                  <td><?php echo $i+1 ?></td>
                  <td><?php echo $fees['feestype']; ?></td>
                  <td><?php echo $fees['feesname']; ?></td>
                  <td><?php echo $fees['feesdesc']; ?></td>
                  <td><?php echo $fees['feesamount']; ?></td>
                  <td><?php echo $fees['submit_time']; ?></td>
                  <td><input type="checkbox" class="form-checkbox-control" onchange="check();" id="checkbox" style="height:30px; width:30px" value="<?php echo $fees['ID']  ?>"></td>
              </tr>
          </tr>
    <?php $i++; } }  ?>
</table>
<script>
function check(){
edit_users_arr = [];
$("#checkbox:checked").each(function(){
      //  alert("Hello");
        var userid = $(this).val();
        edit_users_arr.push(userid);
});
var length=edit_users_arr.length;
if(length==1){
$.ajax({  
    url:"Model/AjaxModel.php?functionname=getdata_for_edit&id="+edit_users_arr,  
    method:"POST",  
    dataType:"json",  
    success:function(data){  
    //console.log("ID"+data.ID);  
    $('#feestype').val(data.feestype); 
    $('#feesname').val(data.feesname); 
    $('#feesdesc').val(data.feesdesc); 
    $('#feesamount').val(data.feesamount); 
    $('#feesid').val(data.ID); 
    $('#submit').val("Update");
    }  
});
}else{
        swal('Error',"Please Select One Item To Edit",'error');
}
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
        url:"Model/AjaxModel.php?functionname=deletefeesdetails&id=",  
        method:"POST",  
        data:{users_arr :users_arr},  
        success:function(data){  
        window.location.reload();
        }  
        }); 
    } else if (
      result.dismiss === swal.DismissReason.cancel
    ) {
      swal("Cancelled", "Fees Details are Safe", "success");
    };
  });
}
});
</script>
<?php
}
?>