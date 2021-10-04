<?php  
if($param=="PatientSearch"){
?>
<?php  echo $obj->head("Patients Global Search");  ?>
<form method="POST" class="needs-validation p-5" novalidate >
  <div class="row">
       <div class="col-md-4 ">
        <?php echo  $obj->input_text("Patients Name","pname","no"); ?>
        </div>
        <div class="col-md-4 ">
        <?php echo  $obj->input_text("Patient ID","patientid","no" ); ?>
        </div>
        <div class="col-md-4 ">
        <?php echo  $obj->input_text("Patient Phone Number","pphno","no" ); ?>
        </div>
        <div class="col-md-4 ">
        <?php echo  $obj->input_date("From Date","fdate","no" ); ?>
        </div>
        <div class="col-md-4 ">
        <?php echo  $obj->input_date("To Date","tdate","no" ); ?>
        </div>
        <div class="col-md-4 ">
        <?php echo  $obj->input_text("Address","paddress","no" ); ?>
        </div>
        <div class="col-md-12  p-4 text-center" >
        <?php echo  $obj->submit("SEARCH");?>   
       </div>
    </div>
</form>
<?php  
if(isset($_POST['submit'])){
$pname = $db->post('pname');
$patientid = $db->post('patientid');
$pphno = $db->post('pphno');
$fdate = $db->post('fdate');
$tdate = $db->post('tdate');
$paddress = $db->post('paddress');
$condition='';
if($pname != ''){
  $condition = 't2.patientname LIKE "%'.$pname.'%"';
}elseif($patientid != ''){
   $condition .= 't2.hpatientid ="'.$patientid.'"';
}elseif($pphno != ''){
  $condition .= 't2.patientphno  ="%'.$pphno.'%"';
}elseif($fdate !="" && $tdate !=""){
  $condition .= 't1.toctime BETWEEN "'.$fdate.'" AND "'.$tdate.'"';
}elseif($fdate !=""){
  $condition .= 't1.toctime < "'.$fdate.'"';
}elseif($tdate !=""){
  $condition .= 't1.toctime  > "'.$tdate.'"';
}elseif($paddress !=""){
  $condition .= 'patientadd LIKE "%'.$paddress.'%"';
}
$table="patients t1 LEFT   JOIN patientdetails t2 ON t2.hpatientid=t1.patientID";
$select="t1.*,t1.ID as PID,t2.*";
$sql = "SELECT".$select.$table."WHERE".$condition;
//echo "SQL :".$sql;
$data=$db->getDbData($table,"ID",$condition,FALSE,$select);
//var_dump($data);
?>
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
</script>
<?php
}
}elseif($param=="GenerateToken"){
$cond ='ID ='.'"'.$_GET['ID'].'"';
$data=$db->getDbData("patientdetails","hpatientid",$cond,False,$select=NULL);
$token = intval($db->max("ptoken","patients","DATE(toctime) LIKE CURRENT_DATE"));
$newtoken = $token +1;
?>
<?php  echo $obj->head("Patients Token Form");  ?>
<table style="border-collapse: collapse; width: 100%; height: 88px;" border="0">
<tbody>
<?php 
if(!empty($data)) {  $i=0;?><?php foreach($data as $patient) { ?>
<tr style="height: 22px;">
<td style="width: 14.7521%; height: 22px;"><strong><span style="color: #e03e2d;">Patients ID</span></strong></td>
<td style="width: 14.7521%; height: 22px;"> 
</td>
<td style="width: 16.8182%; height: 22px;"><strong><span style="color: #e03e2d;">Patients Name</span></strong></td>
<td style="width: 12.686%; height: 22px;">
<div>
<div><span style="color: #0917F9;"><?php echo $patient['patientname'] ?></span></div>
</div>
</td>
<td style="width: 14.7521%; height: 22px;"><strong><span style="color: #e03e2d;">Patients Age</span></strong></td>
<td style="width: 14.7521%; height: 22px;">
<div>
<div><span style="color: #0917F9;"><?php echo $patient['patientage'] ?></span></div>
</div>
</td>
</tr>
<tr style="height: 22px;">
<td style="width: 14.7521%; height: 22px;"><strong><span style="color: #e03e2d;">Patients Phone</span></strong></td>
<td style="width: 14.7521%; height: 22px;">
<div>
<div><span style="color: #0917F9;"><?php echo $patient['patientphno'] ?></span></div>
</div>
</td>
<td style="width: 16.8182%; height: 22px;"><strong><span style="color: #e03e2d;">Patients Address</span></strong></td>
<td style="height: 22px; width: 42.1902%;" colspan="3">
<div>
<div><span style="color: #0917F9;"><?php echo $patient["patientadd"] ?></span></div>
</div>
</td>
</tr>
</tbody>
</table>
<form method="POST" class="needs-validation p-5" novalidate >
  <div class="row">
       <div class="col-md-4">
        <?php echo  $obj->get_doctors("docname"); ?>
        </div>
        <div class="col-md-4 ">
        <?php echo  $obj->input_datetime("Visiting Time","vtime","yes",isset($patient['vtime']) ? $patient['vtime'] : "" ); ?>
        </div>
        <div class="col-md-4 ">
        <?php echo  $obj->input_text("Patient Token","ptoken","yes",isset($newtoken) ? $newtoken : "" ); ?>
        </div>
        <?php echo  $obj->input_hidden("pid",$patient["ID"]);?>
        <?php echo  $obj->input_hidden("hpid",$patient["hpatientid"]);?>         
        <div class="col-md-12  p-4 text-center" >
        <?php echo  $obj->submit("Submit"); echo "  ";  echo $obj->navigation("PatientsToken","Cancel")?>  
       </div>
    </div>
</form>
<?php  } }  ?>
<?php
$tocobj = new stdClass();
$tocobj->pid= $db->post('pid');
$tocobj->patientID = $db->post('hpid'); ;
$tocobj->docname = $db->post('docname') ;
$tocobj->vtime = $db->post('vtime') ;
$tocobj->ptoken = $db->post('ptoken');
$tocobj->tocname=$GLOBALS['username'];
$tocobj->toctime =$GLOBALS['datetime'];
$tocobj->patstatus = "Waiting For Doctor Process";
if($tocobj->pid !='' && $tocobj->patientID !='' && $tocobj->docname !='' && $tocobj->vtime  !='' && $tocobj->ptoken !='' && $tocobj->tocname) {
  $data = $db->insert('patients',$tocobj);  
  echo "<script>window.location.href='index.php?action=Printform&ID=$tocobj->pid';</script>";
}
}elseif($param == "Printform"){ ?>
<?php echo $obj->head("Receipt Print Form");  ?>
<div class="text-center">
<iframe src="App/Billpdfgen.php?id=<?php echo $_GET['ID']; ?>" id="iframe" width="72%" height="1480px"></iframe>
</div>
<div  class="text-center justify-content-center p-5">
<a href="App/Billpdfgen.php?id=<?php echo $_GET['ID']; ?>" target="_blank" class="btn btn-warning ">External Preview</a>  
<a class="btn btn-primary" onclick="printPage(urls);">Print Receipt</a>
<?php echo  $obj->navigation("PatientsList","Cancel");  ?>
</div>
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
var urls = "App/Billpdfgen.php?id="+<?php echo $_GET['ID'] ?>;   
</script>
<?php
}
 ?>
