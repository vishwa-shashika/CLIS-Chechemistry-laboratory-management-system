<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>



<?php
include_once 'connectdb.php';

//header('Cache-Control: no cache'); //no cache
//session_cache_limiter('private_no_expire');

session_start();

if(isset($_POST['btn_login'])){
    
    $useremail = $_POST['txt_email'];
    $password = $_POST['txt_password'];
    //echo $useremail.'<br>'.$password;
    
    $select = $pdo->prepare("SELECT * FROM user_accounts WHERE email='$useremail' AND password='$password'");
    
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    
    if($row['email']==$useremail AND $row['password']==$password AND $row['role']=='Admin'){
        
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['name'];

        
        echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Hi, '.$_SESSION['name'].'",
            text: "Redirecting To  Admin Dashboard...",
            icon: "success",
                });   
            });
        
        </script>';
        
                   
        //echo 'Login Sucessful';  
        header('refresh:2;adminDash.php');
        
        
    
    }else if($row['email']==$useremail AND $row['password']==$password AND $row['role']=='Labtec'){
        
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['name'];
        //echo 'hey Labtec';
        
        
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Hi, '.$_SESSION['name'].'",
            text: "Redirecting To  Lab Technician Dashboard...",
            icon: "success",
                });   
            });
        
        </script>';
        
            
        //echo 'Login Sucessful';  
        header('refresh:2;labtecDash.php');
        
        
        
    }else if($row['email']==$useremail AND $row['password']==$password AND $row['role']=='Lecture'){
        
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['name'];
        //echo 'hey Labtec';
        
        
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Hi, '.$_SESSION['name'].'",
            text: "Redirecting To  Lab Lecture Dashboard...",
            icon: "success",
                });   
            });
        
        </script>';
        
            
        
        //echo 'Login Sucessful';  
        header('refresh:2;lectureDash.php');
        
    
    }else{
        
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Login Failed",
            text: "Username or Password is Wrong !!!",
            icon: "error",
                });   
            });
        
        </script>';
        //echo 'login failed';
        //header('location:index.php');
    }
    
    
    
}
    
    
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CLIS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo ">
    <a href="index.php"><b>C L I S</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="txt_email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="txt_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
              <a href="#" onclick="swal.fire('Get Help', 'Please Contact FCT Administation to Get Acess to your Account', 'warning');">I forgot my password</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btn_login">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->


</body>
</html>