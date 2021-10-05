<nav class="navbar sticky-top navbar-expand-md bg-primary  navbar-dark "> 
<a class="navbar-brand" href="#"><small>SKP HOSPITAL</small></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse navbar-brand" id="collapsibleNavbar">
<ul class="navbar-nav">
<!--Common DashBoard -->
<?php  if($GLOBALS['type']=="Admin"){  ?>
<li class="nav-item">
      <a class="nav-link" href="index.php?action=AdminDashboard">Dashboard</a>
</li>
<?php   }  ?>
<?php  if($GLOBALS['type']=="Staff"){  ?>
<li class="nav-item">
      <a class="nav-link" href="index.php?action=StaffDashboard">Dashboard</a>
</li>
<?php   }  ?>
<?php  if($GLOBALS['type']=="Doctor"){  ?>
<li class="nav-item">
      <a class="nav-link" href="index.php?action=DoctorDashboard">Dashboard</a>
</li>
<?php   }  ?>
<?php  if($GLOBALS['type']=="Staff" || $GLOBALS['type']=="Admin"){  ?>
<!-- Staff Section -->
<li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Registration</a>
<div class="dropdown-menu">
    <a class="dropdown-item"  href="index.php?action=PatientsReg&id=0">Patients Registration</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="index.php?action=PatientsList">Patients Details</a>
</div>
<li class="nav-item">
      <a class="nav-link" href="index.php?action=TodayTokens">Today Tokens</a>
</li>
</li>
<!-- Staff Section -->
<li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Patient Bill</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="index.php?action=FileUpload">Waiting For File Upload</a>
    <div class="dropdown-divider"></div>    
    <a class="dropdown-item" href="index.php?action=DoctorVistProccessed">Completed Patients</a>
</li>
<?php   }  ?>
<!-- Global Search -->
<li class="nav-item">
      <a class="nav-link" href="index.php?action=PatientSearch">Search</a>
</li>
<?php  if($GLOBALS['type']=="Admin"){  ?>
<!-- Admin Section -->
<li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Management</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="index.php?action=AddDoctors&ID=0">New Doctor</a>
    <div class="dropdown-divider"></div>    
    <a class="dropdown-item" href="index.php?action=Management">Doctor Management</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="index.php?action=AddUsers&ID=0">New User</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="index.php?action=UserManagement">User Management</a>
</li>
<li class="nav-item">
      <a class="nav-link" href="index.php?action=FeesDetails">Bill Deatils</a>
</li>
<li class="nav-item">
      <a class="nav-link" href="index.php?action=Statistics">Statistics</a>
</li>
<?php   }  ?>
<?php  if($GLOBALS['type']=="Doctor" || $GLOBALS['type']=="Admin"){  ?>
<!-- Doctor Section -->
<li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Doctor</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="index.php?action=DoctorPatientVist">Waiting For Visiting</a>
    <div class="dropdown-divider"></div>    
    <a class="dropdown-item" href="index.php?action=DoctorVistProccessed">Visiting Completed Patients</a>
</li>
<?php  }  ?>
<!-- Common Nav -->
<li class="nav-item" >
</li>
</ul>

<ul class="navbar-nav ml-auto">
<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php echo $_SESSION["loginname"]  ?> </a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item"   href="index.php?action=ChangePassword" >Change Password</a>
<div class="dropdown-divider"></div>
        <a class="dropdown-item" href="Logout.php">Log Out</a>
</div>
</li>
<li class="nav-item">
      <a class="nav-link" href="index.php?action=Help">Help</a>
</li>
</ul>
</div>  
</nav>
<!-- <br><br/> fixed-top  -->

