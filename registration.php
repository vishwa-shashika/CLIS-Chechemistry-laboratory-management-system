<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>



<?php

include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Admin"){
    header('location:index.php');
}

if(isset($_POST['btn_delete'])){
    
    $email = $_POST['btn_delete'];
    
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
        //echo "Record Deletion Failed";
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




if(isset($_POST['btn_update'])){
    
    $new_name = $_POST['txt_name'];
    $new_email = $_POST['txt_email'];
    $orginal_email = $_POST['orginal_email'];
    $new_password = $_POST['txt_password'];
    $new_role = $_POST['txt_select'];
    
    
    //echo "-------------------".$new_cat;

    
 
        $update = $pdo->prepare("UPDATE user_accounts SET name=:new_name, email=:new_email, password=:new_password, role=:new_role WHERE email=:orginal_email");
        $update->bindParam(':new_name', $new_name);
        $update->bindParam(':new_email', $new_email);
        $update->bindParam(':new_password', $new_password);
        $update->bindParam(':new_role', $new_role);
        $update->bindParam(':orginal_email', $orginal_email);
        
        
        if($update->execute()){
            //echo "Insertion sucesful baby";
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Details Updated Sucessfully",
            text: "User Details Updated in the Database",
            icon: "success",
                });   
            });
           </script>';
            
        }else{
            //echo "Insertion failed fucker";
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Failed to Update Details",
            text: "Something Went Wrong",
            icon: "error",
                });   
            });
            
            </script>';
        }
    
    
    
    
}




include_once 'adminHeader.php';
?>


  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Registration</h1>
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
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">


            <div class="card card-primary card-outline">
              <div class="card-header">
                  <h5 class="m-0"><a href="adminDash.php" class="btn btn-primary" role="button" ><span title="Delete">Go Back</span></a></h5>
              </div>
             <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">

        <div class="card-body">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="registration.php" method="post">
                  
                  
                <?php
                  if(isset($_POST['btn_edit'])){
                    $email = $_POST['btn_edit'];
                      
                    $select=$pdo->prepare("SELECT * FROM user_accounts WHERE email=:mail");
                      $select->bindParam(':mail', $email);
                    if($select->execute()){
                        //echo "--------------quary OK";
                    }else{
                        //echo "quary Fucked";
                    }
                    
                    if($select){
                        $row = $select->fetch(PDO::FETCH_OBJ);
                        
                        //print_r($row);
                        //echo $row->category;
                    echo '
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="txt_name" placeholder="Enter Name" value="'.$row->name.'" required>
                      </div>

                      <div class="form-group">
                        <input type="hidden" class="form-control" name="orginal_email" placeholder="Enter Email" value="'.$row->email.'" required>
                        
                        <label>Email address</label>
                        <input type="email" class="form-control" name="txt_email" placeholder="Enter Email" value="'.$row->email.'" required>
                      </div>

                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="txt_password" placeholder="Password" value="'.$row->password.'" required>
                      </div>

                      <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="txt_select" required>
                              <option value="" disabled >Select Role</option>';
                        if($row->role == 'Admin'){
                            echo'<option selected>Admin</option>
                              <option>Labtec</option>
                              <option>Lecture</option>';
                        }else if($row->role == 'Labtec'){
                            echo'<option>Admin</option>
                              <option selected>Labtec</option>
                              <option>Lecture</option>';
                        }else{
                            echo'<option>Admin</option>
                              <option>Labtec</option>
                              <option selected>Lecture</option>';
                        }
                              
                     echo'
                            </select>
                      </div>


                    <!-- /.card-body -->

                    <div class="card-fbody">
                      <button type="submit" class="btn btn-warning" name="btn_update">Update</button>
                      <a href="registration.php" class="btn btn-primary" role="button" ><span title="Go Back">Cancel</span></a>
                    </div>';                 

                        
                    }else{  
                        echo "Somthing went wrong";
                    }

                    
                      
                  }else{
                      
                    echo '
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
                    
               
                <!-- /.card-body -->

                <div class="card-fbody">
                  <button type="submit" class="btn btn-primary" name="btn_save">Save</button>
                </div>';}
                    
                  ?>

                

              </form>
            </div>
          
              
              
          </div>
            
 <!--===== Registration Form END=============-->   
            
 <!--===== Registered Users Table=============--> 
            
            <div class="col-md-8">
              
              
            

              <!-- /.card-header -->
            <form action="" method="post">
            <div class="card">
              </div>
  
              <div class="card-body table-responsive p-0">
                <table id="example1" class="table table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Role</th>
                      <th>E-Mail</th>
                      <th>Password</th>
                      <th>Edit</th>
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
                            <td><button type="submit" value="'.$row->email.'" class="btn btn-warning" name="btn_edit"><span class="nav-icon fas fa-edit" style="color:#ffffff" data-toggle="tooltip" title="Edit Item"></button></td>
                            

                            <td><button type="submit" value="'.$row->email.'" class="btn btn-danger" name="btn_delete"><span class="nav-icon fas fa-trash-alt" style="color:#ffffff" data-toggle="tooltip" title="Delete Item"></button></td>
                            </tr>';
                    }
                    ?>
                      
                    
              
                  </tbody>
                </table>
              </div>
            </form>
              <!-- /.card-body -->
            
            
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
         </div>
        </div>
      </div> 
    </div>
  </div>
  <!-- /.content-wrapper -->

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>


<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>



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