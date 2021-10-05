<?php 
require_once   "../Model/Model.php";
$db = new Model();
$id= $_GET['id'];
$cond ='t2.pid='.'"'.$GLOBALS['id'].'" ORDER BY t2.ID DESC LIMIT 0,1';
$table="patientdetails t1 INNER JOIN patients t2 ON t2.pid=t1.ID INNER JOIN doctorsdetails t3 ON t3.docname=t2.docname";
$select="t1.*,t1.ID as PID,t2.*,t3.*";
$data=$db->getDbData($table,"ID",$cond,FALSE,$select);
//var_dump($data);
foreach($data as $pdeatils){   
?>
<style>
    @media print {
    @page {
        margin-top: 0;
        margin-bottom: 0;
    }
    body {
        padding-top: 72px;
        padding-bottom: 72px ;
    }
}
</style>
<div style="margin:-5px">
<table style="border-collapse: collapse; width: 57.3628%; height: 1079.6px;" border="1">
    <tbody>
    <tr style="height: 140px;">
    <td style="width: 100%; height: 140px; border: 4px solid #2e3092;" colspan="5"><span style="font-family: 'times new roman', times, serif; font-size: 18pt;"><img src="../vendor/images/hopital-header.png" width="993" height="147" /></span></td>
    </tr>
    <tr style="height: 10px;">
    <td style="height: 10px; width: 98.6258%; text-align: center; border: 4px solid #2e3092;" colspan="5"><span style="font-size: 18pt; color: #ec008c; font-family: 'times new roman', times, serif;"><strong>Dr. <?php echo $pdeatils['docname']." ".$pdeatils['docqualifi']; ?></strong></span><br /><span style="font-family: 'times new roman', times, serif; font-size: 18pt;"><strong><span style="color: #2e3092;"><span style="color: #2e3092;">REG . No :  <?php echo $pdeatils['docid'] ?><br /></span></span></strong><strong><span style="color: #2e3092;"><span style="color: #2e3092;"><?php echo $pdeatils['docsplist'] ?></span></span></strong></span></td>
    </tr>
    <tr style="height: 10px;">
    <td style="width: 98.6258%; height: 10px; border: 4px solid #2e3092;" colspan="5"><span style="font-size: 18pt; font-family: 'times new roman', times, serif;"><strong><span style="color: #2e3092;"><Age style="color: #2e3092;">&nbsp; &nbsp; Name : <?php echo $pdeatils['patientname'] ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Age/Sex :  <?php echo $pdeatils['patientage'] ?><span style="color: #2e3092;float:right">Date :  <?php echo date('Y-m-d') ?></span></span></span></strong></span></td>
    </tr>
    <tr style="height: 10px;">
    <td style="width: 98.6258%; height: 10px; border: 4px solid #2e3092;" colspan="5"><span style="font-size: 18pt; font-family: 'times new roman', times, serif;"><strong><span style="color: #2e3092;"><span style="color: #2e3092;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="../vendor/images/mor.png" width="56" height="20" />&nbsp; &nbsp; <img src="../vendor/images/aftn.png" width="62" height="20" />&nbsp; &nbsp;<img src="../vendor/images/night.png" width="57" height="18" /><br /></span><span style="font-size: 15pt; color: #2e3092;">&nbsp; &nbsp; Patient ID : <?php echo $pdeatils['hpatientid'] ?> <span style="float:right">  &nbsp;Mrg&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;<span style="font-size: 13pt; color: #2e3092;">Aftn&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Night</span></span><br /></span></strong></span></td>
    </tr>
    <tr style="height: 22px;">
    <td style="height: 887.6px; width: 12.6527%; vertical-align: top; border: 4px solid #2e3092;" rowspan="7">
    <p style="margin: 4.1pt 0in 0.0001pt 4.5pt; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="color: #2e3092;">Ht :</span></strong></span></p>
    <p style="margin: 5.65pt 0in 0.0001pt 4.5pt; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="color: #2e3092;">Wt :</span></strong></span></p>
    <p style="margin: 0.5pt 0in 0.0001pt; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;">&nbsp;</span></p>
    <p style="margin: 0.05pt 45.95pt 0.0001pt 4.5pt; line-height: 123%; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="line-height: 123%; color: #2e3092;">Vitals </span></strong><strong><span style="line-height: 123%; color: #2e3092;">:</span></strong><strong><span style="line-height: 123%; color: #2e3092;"> </span></strong></span></p>
    <p style="margin: 0.05pt 45.95pt 0.0001pt 4.5pt; line-height: 123%; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="line-height: 123%; color: #2e3092;">BP&nbsp; &nbsp; &nbsp; :</span></strong></span></p>
    <p style="margin: 0.05pt 0in 0.0001pt 4.5pt; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="color: #2e3092;">PR&nbsp;&nbsp;&nbsp;&nbsp; :</span></strong></span></p>
    <p style="margin: 4.2pt 0in 0.0001pt 4.5pt; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="color: #2e3092;">T&nbsp; &nbsp; &nbsp; &nbsp; :</span></strong></span></p>
    <p style="margin: 4.15pt 45.2pt 0.0001pt 4.05pt; text-indent: 0.45pt; line-height: 238%; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="line-height: 238%; color: #2e3092;">SpO2 :</span></strong></span></p>
    <p style="margin: 4.15pt 45.2pt 0.0001pt 4.05pt; text-indent: 0.45pt; line-height: 238%; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="line-height: 238%; color: #2e3092;"> C/O :</span></strong></span></p>
    <p style="margin: 0in 0in 0.0001pt; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;">&nbsp;</span></p>
    <p style="margin: 0.25pt 0in 0.0001pt; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;">&nbsp;</span></p>
    <p style="margin: 0in 0in 0.0001pt 4.35pt; font-size: 11pt; font-family: 'Times New Roman', serif;"><span style="font-size: 18pt;"><strong><span style="color: #2e3092;">Invs :</span></strong></span></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    </td>
    <td style="height: 887.6px; width: 61.208%; border: 4px solid #2e3092;" rowspan="7">
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p><span style="font-size: 18pt;">&nbsp;</span></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    </td>
    <td style="height: 887.6px; width: 8.72483%; border: 4px solid #2e3092;" rowspan="7">&nbsp;</td>
    <td style="height: 887.6px; width: 8.72483%; border: 4px solid #2e3092;" rowspan="7">&nbsp;</td>
    <td style="height: 887.6px; width: 7.31544%; border: 4px solid #2e3092;" rowspan="7">&nbsp;</td>
    </tr>
    <tr style="height: 22px;"></tr>
    <tr style="height: 22px;"></tr>
    <tr style="height: 22px;"></tr>
    <tr style="height: 22px;"></tr>
    <tr style="height: 22px;"></tr>
    <tr style="height: 22px;"></tr>
    <tr style="height: 22px;">
    <td style="height: 22px; width: 98.6258%; border: 4px solid #2e3092;" colspan="5"><span style="font-family: 'times new roman', times, serif; font-size: 18pt;"><img src="../vendor/images/bottom.png" width="1003" height="127" /></span></td>
    </tr>
    </tbody>
    </table>
</div>

<?php   }  ?>