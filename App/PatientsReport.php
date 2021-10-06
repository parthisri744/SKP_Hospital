<?php 
if($param=="PatientsPaymentDetails"){   
  $cond = " t2.patstatus='Completed'   GROUP BY patinetID";
  $table="patinetsfeesdeatils t1 INNER JOIN patients t2 ON t2.ID=t1.patinetID INNER JOIN patientdetails t3 ON t3.ID=t2.pid";
  $select="t1.*,t2.*,MAX(totalamount) as totalamount,t3.* ";
  $data=$db->getDbData($table,"ID",$cond,FALSE,$select);
  //var_dump($data);
?>
<?php  echo $obj->head("Patients Payment Details");  ?>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SI.No</th>
                <th>Token No</th>
                <th>Patients Name</th>
                <th>Patients ID</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Doctor Name</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($data)) {  $i=0;?>
                <?php foreach($data as $patient) { ?>
                    <tr>
                        <td><?php echo $i+1 ?></td>
                        <td><?php echo $patient['ptoken']; ?></td>
                        <td><?php echo $patient['patientname']; ?></td>
                        <td><?php echo $patient['hpatientid']; ?></td>
                        <td><?php echo $patient['patientage']; ?></td>
                        <td><?php echo $patient['patientphno']; ?></td>
                        <td><?php echo $patient['patientadd']; ?></td>
                        <td><?php echo $patient['docname']; ?></td>
                        <td><?php echo $patient['totalamount']; ?></td>
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
  </script>
<?php
}elseif($param=="PatientsPaymentDetailsToday"){   
    $cond = " t2.patstatus='Completed' AND DATE(t1.submit_time) LIKE CURRENT_DATE   GROUP BY patinetID ";
    $table="patinetsfeesdeatils t1 INNER JOIN patients t2 ON t2.ID=t1.patinetID INNER JOIN patientdetails t3 ON t3.ID=t2.pid";
    $select="t1.*,t2.*,MAX(totalamount) as totalamount,t3.* ";
    $data=$db->getDbData($table,"ID",$cond,FALSE,$select);
    //var_dump($data);
  ?>
  <?php  echo $obj->head("Patients Payment Details");  ?>
  <table id="example" class="display" style="width:100%">
          <thead>
              <tr>
                  <th>SI.No</th>
                  <th>Token No</th>
                  <th>Patients Name</th>
                  <th>Patients ID</th>
                  <th>Age</th>
                  <th>Phone Number</th>
                  <th>Address</th>
                  <th>Doctor Name</th>
                  <th>Total Amount</th>
                  <th>Status</th>
              </tr>
          </thead>
          <tbody>
          <?php if(!empty($data)) {  $i=0;?>
                  <?php foreach($data as $patient) { ?>
                      <tr>
                          <td><?php echo $i+1 ?></td>
                          <td><?php echo $patient['ptoken']; ?></td>
                          <td><?php echo $patient['patientname']; ?></td>
                          <td><?php echo $patient['hpatientid']; ?></td>
                          <td><?php echo $patient['patientage']; ?></td>
                          <td><?php echo $patient['patientphno']; ?></td>
                          <td><?php echo $patient['patientadd']; ?></td>
                          <td><?php echo $patient['docname']; ?></td>
                          <td><?php echo $patient['totalamount']; ?></td>
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
    </script>
  <?php
  }
   ?>