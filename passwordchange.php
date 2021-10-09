<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>




<?php


include_once 'connectdb.php';

//header('Cache-Control: no cache'); //no cache
//session_cache_limiter('private_no_expire');

session_start();

if($_SESSION['role']!="Admin" AND $_SESSION['role']!="Labtec" AND $_SESSION['role']!="Lecture"){
    header('location:index.php');
}

if($_SESSION['role']=="Admin"){
    include_once 'adminHeader.php';
}else if($_SESSION['role']=="Labtec"){
    include_once 'labtecHeader.php';
}else{
    include_once 'lectureHeader.php';
}



if(isset($_POST['btn_update'])){
    $old_pass = $_POST['txt_old_pass']; 
    $new_pass = $_POST['txt_new_pass']; 
    $confirm_pass = $_POST['txt_pass_confirm']; 
    
    //echo $old_pass.'-'.$new_pass.'-'.$confirm_pass;
    
    $email = $_SESSION['email'];
    
    $select = $pdo->prepare("SELECT * FROM user_accounts WHERE email='$email'");
    $select->execute();
    
    $row = $select->fetch(PDO::FETCH_ASSOC);
    
    //echo $row['name'];
    //echo $row['email'];
    
    $password_db = $row['password'];
    
    if($password_db==$old_pass AND $new_pass==$confirm_pass){
        
        $update = $pdo->prepare("UPDATE user_accounts SET password=:pass WHERE email=:email");
        $update->bindParam(':pass',$confirm_pass);
        $update->bindParam(':email',$email);
        
        if($update->execute()){

            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Password Updated",
            text: "Your Password Updated Sucessfuly",
            icon: "success",
                });   
            });
           </script>';
            
            
        }else{
            //echo 'your fucking password is not updated';
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Password Not Updated",
            text: "Please Retry",
            icon: "error",
                });   
            });
            
            </script>';
        }
        
    
    }else{
        //echo 'your password are not matching';
        
        echo '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Password Not Updated",
        text: "Passwords are Not Matching",
        icon: "error",
            });   
        }); 
        </script>';
        

    }
}



?>

  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!--============================================= Main Content========================================-->

            <!-- general form elements -->
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputPassword1">Current Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="txt_old_pass" required>
                  </div>
                    
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="txt_new_pass" required>
                  </div>
                    
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm New Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="txt_pass_confirm" required>
                  </div>
     

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="btn_update">Update Password</button>
                </div>
              </form>
            </div>
      </div>
      
            <!-- /.card -->
      
      
      
      
<!--============================================= Main Content END====================================-->
      
      
      
      
      
      
      
   
      
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

<?php
include_once 'commanFooter.php';
?>