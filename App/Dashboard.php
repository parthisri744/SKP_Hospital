<?php  if($param == "AdminDashboard"){ ?>
<div class="card-title p-4 text-center">
<h5><span style="color:#ff0066"><b><i><u>ADMIN DASHBOARD</u></i></b></span></h5>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"> 
        <?php echo $obj->dashboard("Waiting For Doctor's",Model::count("ID","patients","patstatus='Waiting For Doctor Process'"),"#");  ?>
        </div>
        <div class="col-md-3"> 
        <?php echo $obj->dashboard("Waiting For File Upload",Model::count("ID","patients","patstatus='Waiting For Document Upload'"),"index.php?action=FileUpload");  ?>
        </div>
        <div class="col-md-3"> 
        <?php echo $obj->dashboard("Completed Patients",Model::count("ID","patients","patstatus='Completed'"),"index.php?action=CompletedPatients");  ?>
        </div>
        <div class="col-md-3"> 
        <?php echo $obj->dashboard("Today Report",Model::count("ID","patients","DATE(docprotime) = CURRENT_DATE"),"index.php?action=PatientsPaymentDetailsToday");  ?>
        </div>
        <div class="col-md-6"> 
        <?php echo $obj->dashboard("Total Amount(Today)",Model::sum("totalamount","patinetsfeesdeatils","DATE(submit_time) LIKE CURRENT_DATE"),"index.php?action=PatientsPaymentDetailsToday");  ?>
        </div>
        <div class="col-md-6"> 
        <?php echo $obj->dashboard("Total Files Uploaded",Model::overallcount("ID","fileupload"),"#");  ?>
        </div>
    </div>
</div>
<?php  }elseif($param == "StaffDashboard"){ ?>
    <div class="card-title p-4 text-center">
<h5><span style="color:#ff0066"><b><i><u>STAFF DASHBOARD</u></i></b></span></h5>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"> 
        <?php echo $obj->dashboard("Waiting For File Upload",Model::count("ID","patients","patstatus='Waiting For Document Upload'"),"index.php?action=FileUpload");  ?>
        </div>
        <div class="col-md-3"> 
        <?php echo $obj->dashboard("Total Registered Patients",Model::overallcount("ID","patientdetails"),"index.php?action=PatientsList");  ?>
        </div>
        <div class="col-md-3"> 
        <?php echo $obj->dashboard("Total Tokens(Today)",Model::count("ID","patients","DATE(toctime) = CURRENT_DATE"),"index.php?action=TodayTokens");  ?>
        </div>
        <div class="col-md-3"> 
        <?php echo $obj->dashboard("Total File Uploded(Today)",Model::count("ID","fileupload","DATE(fuploadtime) = CURRENT_DATE"),"#");  ?>
        </div>
    </div>
</div>
<?php  }elseif($param == "DoctorDashboard"){ ?>
    <div class="card-title p-4 text-center">
<h5><span style="color:#ff0066"><b><i><u>DOCTOR DASHBOARD</u></i></b></span></h5>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"> 
        <?php echo $obj->dashboard("Waiting For Visiting",Model::count("ID","patients","patstatus='Waiting For Doctor Process' AND docname ='".$GLOBALS['username']."'"),"index.php?action=DoctorPatientVist"); ?>
        </div>
        <div class="col-md-4"> 
        <?php echo $obj->dashboard("Total Processed",Model::count("ID","patients","docname ='".$GLOBALS['username']."' AND (patstatus='Waiting For Document Upload' OR patstatus='Completed')"),"index.php?action=DoctorVistProccessed");  ?>
        </div>
        <div class="col-md-4"> 
        <?php echo $obj->dashboard("Total Processed(Today)",Model::count("ID","patients","docname ='".$GLOBALS['username']."' AND  DATE(docprotime) = CURRENT_DATE"),"#");  ?>
        </div>
    </div>
</div>
<?php
}  ?>