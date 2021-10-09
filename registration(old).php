<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>

<?php

include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Admin"){
    header('location:index.php');
}

include_once 'adminHeader.php';

if(isset($_GET['id'])){
    
    $email = $_GET['id'];
    
    $delete = $pdo->prepare("DELETE FROM user_accounts WHERE email='$email'");

    if($delete->execute()){
        //echo "Record Deleted Successfully";
        //unset($_GET['id']);
        echo '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Record Deleted Successfully",
        text: "This User id Deleted From the Database",
        icon: "success",
            });   
        });
            
        </script>';
    }else{
        echo "Record Deletion Failed";
        echo '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Failed To Delete",
        text: "Failed to Delete this User from the Database",
        icon: "error",
            });   
        });
            
        </script>';
    }
    
}




if(isset($_POST['btn_save'])){
    
    $user_name = $_POST['txt_name'];
    $user_email = $_POST['txt_email'];
    $user_password = $_POST['txt_password'];
    $user_role = $_POST['txt_select'];
    
    //echo $user_name."-".$user_email."-".$user_password."-".$user_role;
    
    $select=$pdo->prepare("SELECT * FROM user_accounts WHERE email='$user_email'");
    $select->execute();
    
    if($select->rowCount()>0){
        
        echo '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Email Already Exist",
        text: "This Email is Already Exist in the Database . Please Use Another Email",
        icon: "warning",
            });   
        });
            
        </script>';
        
    }else{
        
        $insert = $pdo->prepare("INSERT INTO user_accounts(name,email,password,role) VALUES(:name,:email,:pass,:role)");
    
        $insert->bindParam(':name', $user_name);
        $insert->bindParam(':email', $user_email);
        $insert->bindParam(':pass', $user_password);
        $insert->bindParam(':role', $user_role);
    
        if($insert->execute()){
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Registration Sucessful",
            text: "New User Added To the Database",
            icon: "success",
                });   
            });
           </script>';
            
        }else{
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Registration Failed",
            text: "Something Went Wrong",
            icon: "error",
                });   
            });
            
            </script>';
        }
        
    }
    

}
?>

  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registration</h1>
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

      
      
      
      
      
    <!--========================================= Main content ===========================================-->
    
      
      
<!--===== Registration Form =============-->
    
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Registration Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="registration.php" method="post">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="txt_name" placeholder="Enter Name" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="txt_email" placeholder="Enter Email" required>
                  </div>
                    
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="txt_password" placeholder="Password" required>
                  </div>
                    
                  <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="txt_select" required>
                          <option value="" disabled selected>Select Role</option>
                          <option>Admin</option>
                          <option>Labtec</option>
                          <option>Lecture</option>

                        </select>
                  </div>
                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="btn_save">Save</button>
                </div>
              </form>
            </div>
              
              
          </div>
            
 <!--===== Registration Form END=============-->   
            
 <!--===== Registered Users Table=============--> 
            
            <div class="col-md-8">
              
              
              <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Currently Registered Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    
                    <?php
                    $select = $pdo->prepare("SELECT * FROM user_accounts");
                    $select->execute();
                    while($row=$select->fetch(PDO::FETCH_OBJ)){
                        echo'
                            <tr>
                            <td>'.$row->name.'</td>
                            <td>'.$row->role.'</td>
                            <td>'.$row->email.'</td>
                            <td>'.$row->password.'</td>
                            <td><a href="registration.php?id='.$row->email.'" class="btn btn-danger" role="button" ><span class="nav-icon fas fa-trash-alt" title="Delete"></span></a></td>
                            </tr>';
                    }
                    ?>
                </tbody>
                  
                  
                  
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
            
          </div>
            
<!--===== Registered Users Table=============--> 
       
            
            
            
            
            
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
   </div><!-- /.container-fluid -->
</section>
            <!-- /.card -->
      
      
      
      
<!--============================== /.content ======================================================-->
      
      
      
      
      
      
      
      
      
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


<script>
  $(function () {
    $("#example1").DataTable();

  });
</script>


<?php
include_once 'commanFooter.php';
?>