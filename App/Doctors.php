<?php  
if($param=="Management"){
      echo $obj->head("Doctor's Managements");
      $data=$db->getDbData("doctorsdetails","","",$single=False,$select=NULL);   
     // var_dump($data);
?>
<div class="text-right p-3">
<button type="button" class="btn btn-primary" id="edit"  >UPDATE</button>
<button type="button" class="btn btn-danger" id="delete"  >DELETE</button>
</div>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SI.No</th>
                <th>Doctor Name</th>
                <th>Doctor ID</th>
                <th>Date Of Birth ID</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Status</th>
                <th>Updated Time</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)) {  $i=0;?>
                <?php foreach($data as $doctor) { ?>
                    <tr>
                        <td><?php echo $i+1 ?></td>
                        <td><?php echo $doctor['docname']; ?></td>
                        <td><?php echo $doctor['docid']; ?></td>
                        <td><?php echo $doctor['docdob']; ?></td>
                        <td><?php echo $doctor['docemail']; ?></td>
                        <td><?php echo $doctor['docphoneno']; ?></td>
                        <td><?php echo $doctor['docaddress']; ?></td>
                        <td><?php echo $doctor['docstatus']; ?></td>
                        <td><?php echo $doctor['submit_time']; ?></td>
                        <td><input type="checkbox" class="form-checkbox-control" id="checkbox" style="height:30px; width:30px" value="<?php echo $doctor['ID']  ?>"></td>
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
   var url= "index.php?action=AddDoctors&ID="+edit_users_arr;
   window.location.href=url;
    }else{
        swal('error','Please Select One Doctor','error')
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
text: "Please Select Atlease One Doctor",
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
    swal("Deleted!", "Doctor Details deleted Successfully.", "success");
    if (result.value) {
      $.ajax({  
        url:"Model/AjaxModel.php?functionname=deletedoctors&id=",  
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
 <?php   }elseif($param=="AddDoctors"){ ?>
    <?php  echo $obj->head("Doctor's Registartion Form");$cond ='ID='.$_GET['ID'];
$data=$db->getDbData("doctorsdetails","ID",$cond,TRUE,$select=NULL); //var_dump($data);  ?>
<form method="POST" class="needs-validation p-6" novalidate >
  <div class="row">
        <div class="col-md-4">
        <?php echo  $obj->input_text("Doctor Name","docname","yes",isset($data['docname']) ? $data['docname'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_text("Doctor ID","docid","yes",isset($data['docid']) ? $data['docid'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_date("Date Of Birth","docdob","yes",isset($data['docdob']) ? $data['docdob'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_email("Email","docemail","yes",isset($data['docemail']) ? $data['docemail'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_number("Phone Number","docphoneno","yes",isset($data['docphoneno']) ? $data['docphoneno'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_text("User Name","docusername","yes",isset($data['docusername']) ? $data['docusername'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->select("Active Status","docstatus","yes","Active,Inactive",isset($data['docstatus']) ? $data['docstatus'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_text("Doctor Specialist","docsplist","yes",isset($data['docsplist']) ? $data['docsplist'] : "" ); ?>
        </div>
        <div class="col-md-4">
        <?php echo  $obj->input_text("Doctor Qualification","docqualifi","yes",isset($data['docqualifi']) ? $data['docqualifi'] : "" ); ?>
        </div>
        <div class="col-md-12">
        <?php echo  $obj->textarea("Address","docaddress","yes",isset($data['docaddress']) ? $data['docaddress'] : "" ); ?>
        </div>
        <div class="col-md-12 p-4 text-center" >
        <?php echo  $obj->submit("Register"); echo " ";  echo $obj->reset("Reset");?>
       </div>
    </div>
</form>
<?php 
$docobj = new stdClass();
$docobj->docname = $db->post('docname');
$docobj->docid = $db->post('docid');
$docobj->docdob = $db->post('docdob');
$docobj->docphoneno = $db->post('docphoneno');
$docobj->docemail = $db->post('docemail');
$docobj->docsplist = $db->post('docsplist');
$docobj->docqualifi = $db->post('docqualifi');
$docobj->docaddress = $db->post('docaddress');
$docobj->docstatus = $db->post('docstatus');
$docobj->docusername = $db->post('docusername');
$docobj->docaddress = $db->post('docaddress');
$docobj->submit_name = $GLOBALS['username'];
if($docobj->docname!='' && $docobj->docdob !='' && $docobj->docemail!='' && $docobj->docsplist != ''&& $docobj->docqualifi!='' && $docobj->docphoneno!= '' && $docobj->docusername!='' && $docobj->docaddress!=''){
if($_GET['ID'] == 0){
    $password = password_hash($docobj->docdob,PASSWORD_DEFAULT);
    $docobj->docpassword = $password;
    $data = $db->insert('doctorsdetails',$docobj);
//var_dump($data);
echo "<script>swal('success','Registered  Successfully','success');</script>";
}else{
    $data = $db->update('doctorsdetails',$docobj,"ID",$_GET['ID'],$type=0);
      if($data==true){
      echo "<script>swal('success','Updated  Successfully','success');</script>";
      echo $obj->redirect("Management");
    }
   }
  }
}
?>