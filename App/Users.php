<?php  
if($param=="UserManagement"){
      echo $obj->head("User's Managements");
      $data=$db->getDbData("users","","",$single=False,$select=NULL);   
     // var_dump($data);
?>
<div class="text-right p-3">
<button type="button" class="btn btn-primary" id="edit"  >UPDATE</button>
<button type="button" class="btn btn-danger" id="delete"  >DELETE</button>
<button type="button" class="btn btn-dark" id="password_rest" >Password Reset</button>
</div>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SI.No</th>
                <th>Name</th>
                <th>User Name</th>
                <th>Date Of Birth ID</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Category</th>
                <th>Updated Time</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)) {  $i=0;?>
                <?php foreach($data as $user) { ?>
                    <tr>
                        <td><?php echo $i+1 ?></td>
                        <td><?php echo $user['uname']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['birthdate']; ?></td>
                        <td><?php echo $user['usermail']; ?></td>
                        <td><?php echo $user['phoneno']; ?></td>
                        <td><?php echo $user['uaddress']; ?></td>
                        <td><?php echo $user['category'] ?></td>
                        <td><?php echo $user['created_at']; ?></td>
                        <td><input type="checkbox" class="form-checkbox-control" id="checkbox" style="height:30px; width:30px" value="<?php echo $user['ID']  ?>"></td>
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
   var url= "index.php?action=AddUsers&ID="+edit_users_arr;
   window.location.href=url;
    }else{
        swal('error','Please Select One User','error')
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
text: "Please Select Atlease One User",
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
    swal("Deleted!", "User Details deleted Successfully.", "success");
    if (result.value) {
      $.ajax({  
        url:"Model/AjaxModel.php?functionname=deleteusers&id=",  
        method:"POST",  
        data:{users_arr :users_arr},  
        success:function(data){  
        window.location.reload();
        }  
        }); 
    } else if (
      result.dismiss === swal.DismissReason.cancel
    ) {
      swal("Cancelled", "Doctor Details are Safe", "success");
    };
  });
}
});
</script>
 <?php   }elseif($param=="AddUsers"){ ?>
    <?php  echo $obj->head("User's Registartion Form");$cond ='ID='.$_GET['ID'];
      $data=$db->getDbData("users","ID",$cond,TRUE,$select=NULL); //var_dump($data);  ?>
        <form  method="POST" class="needs-validation p-6" novalidate >
        <div class="row">
        <div class="col-md-4">
        <?php echo  $obj->select("Category","category","yes","Admin,Staff,Doctor",isset($data['category']) ? $data['category'] : "" ); ?>
        </div>
        <div class="col-md-4" id= "unamediv">
        <?php echo  $obj->input_text("Name","tuname","no",isset($data['tuname']) ? $data['tuname'] : "" ); ?>
        </div>
        <div class="col-md-4" id= "docnamediv">
        <?php echo  $obj->get_doctors("suname","no"); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_date("Date Of Birth","birthdate","yes",isset($data['birthdate']) ? $data['birthdate'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_email("Email","usermail","yes",isset($data['usermail']) ? $data['usermail'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_number("Phone Number","phoneno","yes",isset($data['phoneno']) ? $data['phoneno'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_text("User Name","username","yes",isset($data['username']) ? $data['username'] : "" ); ?>
        </div>
        <div class="col-md-12">
        <?php echo  $obj->textarea("Address","uaddress","yes",isset($data['uaddress']) ? $data['uaddress'] : "" ); ?>
        </div>
        <div class="col-md-12 p-4 text-center" >
       <?php echo  $obj->submit("Register","submit");" ";  echo $obj->reset("Reset");?>
       </div>
    </div>
</form>
<?php 
$newname = $db->post('tuname');
$uname = isset($newname) ? $db->post('tuname') : $db->post('suname');
$userobj = new stdClass();
$userobj->category = $db->post('category');
$userobj->uname = $uname;
$userobj->usermail = $db->post('usermail');
$userobj->birthdate = $db->post('birthdate');
$userobj->username= $db->post('username');
$userobj->phoneno = $db->post('phoneno');
$userobj->uaddress = $db->post('uaddress');
$userobj->created_by = $GLOBALS['username'];
//var_dump($userobj);
if($userobj->birthdate !='' && $userobj->usermail!='' && $userobj->phoneno != '' && $userobj->category !='' && $userobj->username!='' && $userobj->uaddress !=''){
if($_GET['ID'] == 0){
    $password = password_hash($userobj->birthdate,PASSWORD_DEFAULT);
    $userobj->password = $password;
    $data = $db->insert('users',$userobj);
//var_dump($data);
echo "<script>swal('success','Registered  Successfully','success');</script>";
}else{
  //  var_dump($userobj);
  //  echo "ID :".$_GET['ID'];
    $data = $db->update('users',$userobj,"ID",$_GET['ID'],$type=0);
      if($data==true){
      echo "<script>swal('success','Updated  Successfully','success');</script>";
     echo $obj->redirect("UserManagement");
    }
   }
  }
 }
?>
<script>
$(document).ready(function() {
$('#category').change(function(){
var category = $(this).val();
hide_show(category);
});
function  hide_show(category) {
    if(category == "Doctor"){
    $('#unamediv').hide();
    $('#docnamediv').show();
}else if(category == "Staff" || category == "Admin"){
    $('#unamediv').show();
    $('#docnamediv').hide();
}else{
    $('#docnamediv').hide();
    $('#unamediv').hide();
  }
}  
hide_show($('#category'));
$('.suname').change(function(){
var uname= $(this).val();
$.ajax({  
url:"Model/AjaxModel.php?functionname=doctorsdata&Docname="+uname,  
method:"POST",  
dataType:"json",  
success:function(data){  
console.log(data);
$('#usermail').val(data.docemail);  
$('#birthdate').val(data.docdob);  
$('#username').val(data.docusername);  
$('#phoneno').val(data.docphoneno);  
$('#uaddress').val(data.docaddress);  
}
});
});
$('#password_rest').click(function(){
var edit_users_arr = [];
$("#checkbox:checked").each(function(){
var userid = $(this).val();
edit_users_arr.push(userid);
});
var length=edit_users_arr.length;
if(length == '1' ){
  swal({
title: "Are you sure?",
text: "Do You Want Reset Password!",
type: "warning",
showCancelButton: true,
confirmButtonColor: "purple",
confirmButtonText: "Reset Password",
}).then(result => {
if (result.value) {
$.ajax({  
url:"Model/AjaxModel.php?functionname=passwordreset&id="+edit_users_arr,  
method:"POST",  
//data:{users_arr :users_arr},  
success:function(data){  
swal("Success!", "Peassword Reseted Successfully.", "success");
//window.location.reload();
} 
});
} 
});
}else if(length > 1) {
setTimeout(function() {
swal({
title: "ERROR!",
text: "You Selected More Then One User ! Please Select One User To Reset Password",
type: "error"
});
}, 100);
}else {
setTimeout(function() {
swal({
title: "ERROR!",
text: "Please Select Atlease One User",
type: "error"
});
}, 100);
}
});
});
</script> 