<?php  
$logfile ='log/'. date('Y-m-d').'.txt';
ini_set("error_log",$logfile);
require_once 'Helper/Form.php';
require_once 'Model/Model.php';
require_once 'Model/Database.php';
session_start();
 if(!isset($_SESSION["hospital"]) || $_SESSION["hospital"] !== true){
    header("location: Login.php");
    exit;
}
$datetime = date("Y-m-d h:i:s");
$GLOBALS['datetime'];
$username = $_SESSION["loginname"];
$GLOBALS['username'];
$obj=new Form();
$db = new Model();
?>
<!DOCTYPE html>
<d lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKP- Hospital</title>
    <link rel="stylesheet" href="vendor/css/style.css">
    <link rel="stylesheet" href="vendor/require/bootstrap.min.css">
    <link rel='stylesheet' href='vendor/require/sweetalert2.min.css'></link>
    <link rel='stylesheet' href='vendor/require/dataTables.min.css'></link>    
    <link rel='stylesheet' href='vendor/require/imageuploadify.min.css'></link>
    <link href="vendor/require/select2.min.css" rel="stylesheet" >
    <script src="vendor/require/jquery.min.js"></script>
    <script src="vendor/require/select2.min.js"></script>    
    <script src="vendor/require/sweetalert2.all.min.js"></script> 
    <script src="vendor/chart/chart.min.js"></script> 
    <script src="vendor/chart/chart.min.js"></script> 
   <script src="vendor/require/sweetalert2.all.min.js"></script> 
    <style>
        input[type=text],input[type=password],input[type=number],input[type=email],input[type=datetime-local],input[type=date],textarea {
        border: 2px solid  #3399ff;
        }
        textarea{
        border: 2px solid #3399ff;
        }
</style>
</head>
<body class="bg-primary">
<?php  
$type = $_SESSION["category"];
$GLOBALS['type'];
    require_once("Navigation/AdminNav.php"); 
?>
<div class="container-fluid">
    <div class="row p-2">
        <div class="col-md-12">
            <div class="card" style="min-height:600px">
                <div class="card-body">
                <span class="text-right  alert alert-success" style="width:310px;">DATE : <?php echo date('d-m-Y');  ?> TIME :<span id="timer"></span></span><br>
                <?php
                    $param=isset($_GET['action']) ? $_GET['action'] : "";
                    if($param=="AdminDashboard" || $param=="StaffDashboard" || $param == "DoctorDashboard"){
                        require_once("App/Dashboard.php");
                    }elseif($param == "PatientsReg" || $param == "FeesDetails"){
                        require_once("App/Registration.php");
                    }elseif($param == "PatientsList" || $param == "Help" || $param == "ChangePassword"){
                        require_once("App/PatientsDetails.php");
                    }elseif($param == "PatientSearch" || $param == "GenerateToken" || $param == "Printform" || $param=="TodayTokens"){
                        require_once("App/Token.php");
                    }elseif($param=="Management" || $param=="AddDoctors"){
                        require_once("App/Doctors.php");
                    }elseif($param=="UserManagement" || $param == "AddUsers"){
                        require_once("App/Users.php");
                    }elseif($param=="DoctorPatientVist" || $param == "DoctorRemarks" || $param=="DoctorVistProccessed"){
                        require_once("App/DoctorVisit.php");
                    }elseif($param=="FileUpload" || $param=="FileUploadForm" || $param=="CompletedPatients" || $param=="Payment"){
                        require_once("App/FileUpload.php");
                    }elseif($param=="Statistics"){
                        require_once("App/Charts.php");
                    }elseif($param=="PatientsPaymentDetails" || $param=="PatientsPaymentDetailsToday"){
                        require_once("App/PatientsReport.php");
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
setInterval(function() {
  var currentTime = new Date ( );    
  var currentHours = currentTime.getHours ( );   
  var currentMinutes = currentTime.getMinutes ( );   
  var currentSeconds = currentTime.getSeconds ( );
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;    
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";    
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;    
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;    
  var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  document.getElementById("timer").innerHTML = currentTimeString;
}, 1000);
$('.js-example-basic-single').select2();

</script>
</body>
<script src="vendor/require/popper.min.js"></script>
  <script src="vendor/require/bootstrap.min.js"></script>
  <script src="vendor/require/angular.min.js"></script>
  <script src="vendor/require/dataTables.min.js"></script>
  <script src="vendor/require/dataTables.buttons.min.js"></script>
  <script src="vendor/require/jszip.min.js"></script>  
  <script src="vendor/require/pdfmake.min.js"></script>
  <script src="vendor/require/vfs_fonts.js"></script>  
  <script src="vendor/require/buttons.html5.min.js"></script>  
  <script src="vendor/require/buttons.print.min.js"></script>
  <script src="vendor/require/imageuploadify.min.js"></script>
  <script src="vendor/js/script.js"></script>
 <div class="footer bg-primary ">
<div class="footer-copyright text-center py-3">© <?php echo date('Y')  ?> Copyright:Microtech
</div>
</div>
</html>
</html>
