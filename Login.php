<?php
$logfile ='log/'. date('Y-m-d').'.txt';
ini_set("error_log",$logfile);
class Login{
    private $db;
    private $dsn = 'mysql:dbname=Hospital;host=localhost';
    private $user = 'root';
    private $password = '';
    public $err_msg=[];
    /**
     * Database Connectivity
     */
    public function __construct() {
    try {
        $this->db = new PDO($this->dsn, $this->user, $this->password);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "";
        error_log($e->getMessage());
    }
 }
    public function post_method($param){
        $param = isset($_POST[$param]) ? trim($_POST[$param]) : "";
        return $param;
    }
    /**
     * login 
    */
    public  function login_username($username,$password){
        $err_msg=[];
        $sql = "SELECT ID,username,uname,password,category FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
       // var_dump($stmt);
        //echo "COUNT:".$stmt->rowCount() ;
        if($stmt->rowCount() == 1){ 
        if($row = $stmt->fetch()){
        $ID = $row["ID"];
        $category = $row["category"];
        $loginname = $row["uname"];
        $username = $row["username"];
        $hashed_password = $row["password"];
        if(password_verify($password, $hashed_password)){
        session_start();
        $_SESSION["hospital"] = true;
        $_SESSION["ID"] = $ID;
        $_SESSION["username"] = $username;  
        $_SESSION["loginname"] = $loginname;      
        $_SESSION["category"] = $category;   
        if($category=="Admin"){                                       
            header("location: index.php?action=AdminDashboard");
        }elseif($category=="Staff"){
            header("location: index.php?action=StaffDashboard");
        }else{
             header("location: index.php?action=DoctorDashboard");
        }
        }else{
            $err_msg[]="The password you entered was not valid";
        }
        }
        }else{
            $err_msg[]="No account found with that username.";
        }
        error_log(implode('',$err_msg));
        return $err_msg;
    }
}
$obj=new Login();
$submit=$obj->post_method('submit');
$category=$obj->post_method('category');
$username=$obj->post_method('username');
$password=$obj->post_method('password');
$result =$obj->login_username($username,$password,$category);
$result=implode("",$result);
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKP Hospital</title>
</head>
<style>
        input[type=text],input[type=password],input[type=number],input[type=email],input[type=datetime-local],input[type=date],textarea {
        border: 2px solid  #3399ff;
        }
</style>
<body>
    <div><?php  require_once("Navigation/Loginnav.php");  ?></div>
    <?php 
	if($submit) {
	if(strlen($result)>0){  ?>
    <script>swal("Error", "<?php echo $result  ?>", "error");  </script>
    <?php } }?>
    <div class="container">
      <div class="row p-5 center-content-center" > 
      <div class="col-md-6 ">
          <div class="card shadow p-1 text-center">
          <img src="vendor/images/login.png" class="card-img-top" alt="Anna University Logo" width="400px" height="400px">
            <div>
                <h1 style="color:#ff0066"><b>SKP HOSPITAL</b></h1>
                <p class="h4" style="color:green">No :75 Big Street, Thirukazhukundram</p>
                <p class="h4" style="color:green">Email : skphospitals@gmail.com</p>
            </div>
          </div>
          </div>
          <div class="col-md-6 card-deck ">
         <div class="card shadow p-3">
        <div class="card-body">
        <h2 class="text-center" style="color:blue"><b>Login</b></h2>
        <p class="text-center alert alert-danger p-2">Please fill the login credentials.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation p-3" novalidate>
            <div class="form-group ">Enter Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username  ?>" autocomplete="off" required>
            <span class="invalid-feedback">Please Enter UserName</span>
            </div>    
            <div class="form-group p1">
                <label class="form-label">Enter Password</label>
                <span class="invalid-feedback">Please Enter Password</span>
                <input type="password" name="password" value="<?php echo $password  ?>" class="form-control" autocomplete="off" required>
                <span class="invalid-feedback">Please Enter Password</span>
            </div>
            <div class="form-group text-center p-3" >
                <input  type="submit" style="width:100%" class="btn btn-outline-primary" name="submit" value="Login">
            </div>
        </form>
        </div>
    </div>
</div>
</div>
</div>
<script src="vendor/js/index.js"></script>
</body>
<div class="footer fixed-bottom bg-primary sticky-buttom page-footer ">
<div class="footer-copyright text-center py-3">© <?php echo date('Y')  ?> Copyright:Microtech
</div>
</div>
</html>