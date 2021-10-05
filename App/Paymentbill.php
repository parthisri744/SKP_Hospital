<?php 
require_once   "../Model/Model.php";
$db = new Model();
$id= $_GET['id'];
$cond ='t2.ID='.'"'.$GLOBALS['id'].'" ORDER BY t2.ID DESC LIMIT 0,1';
$table="patientdetails t1 INNER JOIN patients t2 ON t2.pid=t1.ID";
$select="t1.*,t1.ID as PID,t2.*";
$data=$db->getDbData($table,"ID",$cond,FALSE,$select);
$cond= "patinetID=".$_GET['id'];
$result=$db->getDbData("patinetsfeesdeatils","patinetID",$cond,FALSE,$select=NULL);
//var_dump($data);
$sql = "SELECT SUM(t2.feesamount) as total FROM patients t1 INNER JOIN patinetsfeesdeatils t2 ON t2.patinetID=t1.ID WHERE t1.ID=".$_GET['id'];
$total = intval($db->exesql($sql));
//var_dump($total);
foreach($data as $pdeatils){   
?>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 90%;
  margin-bottom:60px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #DCDCDC;
  color: black;
}
</style>
<table style="border-collapse: collapse; width: 57.3628%; min-height: 800px;" border="1">
<tbody>
<tr style="height: 140px;">
<td style="width: 99.8045%; height: 140px; border: 4px solid #2e3092;" colspan="5"><span style="font-family: 'times new roman', times, serif; font-size: 18pt;"><img src="../vendor/images/hopital-header.png" width="993" height="147" /></span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 99.8045%; height: 10px; border: 4px solid #2e3092;" colspan="5"><span style="font-size: 18pt; font-family: 'times new roman', times, serif;"><strong><span style="color: #2e3092;"><span style="color: #2e3092;">&nbsp; &nbsp;<span style="font-size: 15pt; color: #2e3092;">Patient ID : <?php echo $pdeatils['hpatientid']   ?>&nbsp; </span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: #2e3092;"><span style="float:right">Date :<?php echo date('Y-m-d') ?></span></span></strong></span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 99.8045%; height: 10px; border: 4px solid #2e3092;" colspan="5"><span style="font-size: 18pt; font-family: 'times new roman', times, serif;"><strong><span style="color: #2e3092;"><span style="color: #2e3092;">&nbsp; &nbsp;</span><span style="font-size: 15pt; color: #2e3092;"> 
<span style="font-size: 18pt; font-family: 'times new roman', times, serif;">Name :  <?php echo $pdeatils['patientname'] ?>&nbsp;</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span style="font-size: 18pt; font-family: 'times new roman', times, serif;">&nbsp;&nbsp;Age/Sex : <?php echo $pdeatils['patientage'] ?>&nbsp; </span><span style="float:right">Phone No : <?php echo $pdeatils['patientphno']   ?> &nbsp;</span><br /></span></strong></span></td>
</tr>
<tr style="height: 22px;">
<td style="min-height:80px; vertical-align: top; width: 99.8045%; border: 4px solid #2e3092;" colspan="5" rowspan="7">
<p>&nbsp;</p>
<p  align="center"><span style="font-size: 18pt;">Bill Details</span></p>

<table id="customers" align="center">
<thead class="thead-dark">
  <tr>
                <th>SI.No</th>
                <th>Fees Type</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Total Amount</th>
            </tr>
</thead>
<tbody>
</tbody><?php  if(!empty($result))  { $i=0;   ?>
          <?php foreach($result as $fees) { ?>
              <tr>
                  <td><?php echo $i+1 ?></td>
                  <td><?php echo $fees['feestype']; ?></td>
                  <td><?php echo $fees['feesname']; ?></td>
                  <td><?php echo $fees['feesquant']; ?></td>
                  <td><?php echo $fees['feesamount']; ?></td>
                  <td><?php echo $fees['totalamount']; ?></td>
              </tr>
          </>
    <?php $i++; } }  ?>
              <tr>
              <td colspan=5>Total Amount</td>
               <td><?php echo $total?></td>
              </tr>
              <tr>
                  <td colspan=1>Total Amount In Words</td>
                  <td colspan=5><?php echo $db->getIndianCurrency($total); ?></td>

              </tr>
</table><div class="text-center">

</tr>
<tr style="height: 22px;"></tr>
<tr style="height: 22px;"></tr>
<tr style="height: 22px;"></tr>
<tr style="height: 22px;"></tr>
<tr style="height: 22px;"></tr>
<tr style="height: 22px;"></tr>
<tr style="height: 22px;">
<td style="height: 22px; width: 99.8045%; border: 4px solid #2e3092;" colspan="5"><span style="font-family: 'times new roman', times, serif; font-size: 18pt;"><img src="../vendor/images/bottom.png" width="1003" height="127" /></span></td>
</tr>
</tbody>
</table>
<?php   }  ?>