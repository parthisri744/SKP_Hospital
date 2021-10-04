<?php
$cond ='t1.ID='.$_GET['ID'];
$table="patients t1 INNER JOIN patientdetails t2 ON t2.hpatientid=t1.patientID";
$select="t1.*,t2.*";
$patient=$db->getDbData($table,"ID",$cond,TRUE,$select);
if(!empty($patient)) { 
?>
<table style="border-collapse: collapse; width: 80.3457%; height: 115px; margin-left: auto; margin-right: auto; font-size:larger">
<tbody>
<tr style="height: 39px;">
<td style="width: 24.0658%; height: 39px;"><span style="font-family: arial, helvetica, sans-serif; color: #37076d;"><em><strong>Patient Name</strong></em></span></td>
<td style="width: 24.0658%; height: 39px;"><span style="color: #0a5e07;"><em><?php echo $patient['patientname']; ?></em></span></td>
<td style="width: 24.0658%; height: 39px;"><span style="font-family: arial, helvetica, sans-serif; color: #37076d;"><em><strong>Patients ID</strong></em></span></td>
<td style="width: 24.0658%; height: 39px;"><span style="color: #0a5e07;"><?php echo $patient['hpatientid']; ?></span></td>
</tr>
<tr style="height: 38px;">
<td style="width: 24.0658%; height: 38px;"><span style="font-family: arial, helvetica, sans-serif; color: #37076d;"><em><strong>Age</strong></em></span></td>
<td style="width: 24.0658%; height: 38px;"><span style="color: #0a5e07;"><em><?php echo $patient['patientage']; ?></em></span></td>
<td style="width: 24.0658%; height: 38px;"><span style="font-family: arial, helvetica, sans-serif; color: #37076d;"><em><strong>Phone Number</strong></em></span></td>
<td style="width: 24.0658%; height: 38px;"><span style="color: #0a5e07;"><?php echo $patient['patientphno']; ?></span></td>
</tr>
<tr style="height: 38px;">
<td style="width: 24.0658%; height: 38px;"><span style="font-family: arial, helvetica, sans-serif; color: #37076d;"><strong>Doctor Name</strong></span></td>
<td style="width: 24.0658%; height: 38px;"><span style="color: #0a5e07;"><em><?php echo $patient['docname']; ?></em></span></td>
<td style="width: 24.0658%; height: 38px;"><span style="font-family: arial, helvetica, sans-serif; color: #37076d;"><em><strong>Address</strong></em></span></td>
<td style="width: 24.0658%; height: 38px;"><span style="color: #0a5e07;"><?php echo $patient['patientadd']; ?></span></td>
</tr>
</tbody>
</table>
<?php
    }
?>