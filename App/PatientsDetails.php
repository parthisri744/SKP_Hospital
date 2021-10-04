<?php 
if($param == "PatientsList"){
$data=$db->getDbData("patientdetails","","",$single=False,$select=NULL);  
?>
<?php echo   $obj->head("Patients Details");   ?>
<div class="text-right p-3">
<button type="button" class="btn btn-primary" id="edit"  >UPDATE</button>
<button type="button" class="btn btn-danger" id="delete"  >DELETE</button>
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
                <th>Token Generation</th>
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
                        <td><a href="index.php?action=GenerateToken&ID=<?php echo $patient['ID']; ?>" class="btn btn-success">TOKEN</a></td>
                        <td><input type="checkbox" class="form-checkbox-control" id="checkbox" style="height:30px; width:30px" value="<?php echo $patient['ID']  ?>"></td>
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
$("#edit").click(function() {
    var edit_users_arr = [];
    $("#checkbox:checked").each(function(){
        var userid = $(this).val();
        edit_users_arr.push(userid);
        });
    var length=edit_users_arr.length;
    if(length == '1' ){
   var url= "index.php?action=PatientsReg&id="+edit_users_arr;
   window.location.href=url;
    }else{
        swal('error','Please Select One Patients','error')
    }
});

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
text: "Please Select Atlease One Patients",
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
    swal("Deleted!", "Patients Details deleted Successfully.", "success");
    if (result.value) {
      $.ajax({  
        url:"Model/AjaxModel.php?functionname=deletepatients&id=",  
        method:"POST",  
        data:{users_arr :users_arr},  
        success:function(data){  
       // window.location.reload();
        }  
        }); 
    } else if (
      result.dismiss === swal.DismissReason.cancel
    ) {
      swal("Cancelled", "Patients Details are Safe", "success");
    };
  });
}
});
</script>
<?php   }elseif($param == "Help"){  ?>
  <div class="col-md-12 text-center">
<p class="h2" style="color:green"><b>For Technical Support</b></p>
<p class="h3" style="color:red"><b>MICROTECH</b></p>
<p class="h4" style="color:blue"><b>No 16. Kavarai Street RK Medical Upstair</b></p>
<p class="h4" style="color:blue"><b>Thirukazhukundram.</b></p>
<p class="h5" style="color:blue"><b>9994916401</b></p>
</div>
<div class="col-md-12" style="text-align:left">
<p class="h4" style="color:red;text-align:center"><b>Contact</b></p>

<div class="card-group">
  <div class="card alert-primary">
  <div class="card-body  text-center">
      <h5 class="h4 text-center p-2" style="color:purple">KAMARAJ</h5>
      <p><a class="btn btn-danger"  href="mailto:micro.microtech206@gmail.com">Send email</a></p>
    </div>
  </div>
  <div class="card alert-warning">
    <div class="card-body  text-center">
      <h5 class="h4 text-center  p-2" style="color:purple">SUTHA KAMARAJ</h5>
      <p><a class="btn btn-danger"  href="mailto:sutha130792@gmail.com">Send email</a></p>

    </div>
  </div>
  <div class="card alert-danger">
    <div class="card-body  text-center">
    <h5 class="h4 text-center  p-2" style="color:purple">PARTHIBAN</h5>
    <p><a class="btn btn-danger "  href="mailto:parthibans452@gmail.com">Send email</a></p>
    </div>
  </div>
</div>
</div>
 <?php }elseif($param == "ChangePassword"){
   echo   $obj->head("Password Change");    ?>
<form  method="POST" class="needs-validation p-4" novalidate enctype="multipart/form-data">
  <div class="row justify-content-center">
       <div class="col-md-4 ">
        <?php echo  $obj->input_password("New Password","newpassword","yes",isset($newpassword) ? $newpassword : "" ); ?>
        </div>
        <div class="col-md-4 ">
        <?php echo  $obj->input_password("Confirm Password","cfmpassword","yes",isset($newpassword) ? $newpassword : "" ); ?>
        </div>
        <div class="col-md-12 p-4 text-center" >
        <?php echo  $obj->submit("Change Password");?>
       </div>
    </div>
</form>
 <?php  
$cpass = new stdClass();
$cpass->password= $db->post('newpassword');
$cpass->cfmpassword = $db->post('cfmpassword');
$cpass->submit = $db->post('submit'); ;
$cpass->username = $GLOBALS['username'] ;
$cpass->created_at = $GLOBALS['datetime'] ;
if(isset($_POST['submit'])){
if($cpass->password !='' && $cpass->cfmpassword !='' && $cpass->username !='' ){
if(strlen($cpass->password) > 8){
if($cpass->password == $cpass->cfmpassword && $cpass->username!='' ){
  $sql = "UPDATE users SET password=:password,created_by=:created_by,created_at=:created_at WHERE category = :category AND username = :username";
  $stmt=DATABASE::config()->prepare($sql);
  $password = password_hash($cpass->password, PASSWORD_DEFAULT);
  $stmt->bindParam(":password", $password, PDO::PARAM_STR);
  $stmt->bindParam(":category", $GLOBALS['type'], PDO::PARAM_STR);
  $stmt->bindParam(":username", $GLOBALS['username'], PDO::PARAM_STR);
  $stmt->bindParam(":created_by",  $GLOBALS['username'], PDO::PARAM_STR);
  $stmt->bindParam(":created_at",  $GLOBALS['datetime'], PDO::PARAM_STR);
  if($stmt->execute()){
    echo "<script>swal('Success','Password Changed Successfully','success');</script>";
  };
}else{
  echo "<script>swal('error','Password Not Match','error');</script>";
}
}else{
  echo "<script>swal('error','Password Should Contain atleast 8 Charecter','error');</script>";
}
}else{
  echo "<script>swal('error','Please Fill The Form Credentials','error');</script>";
}
}
}   ?>
