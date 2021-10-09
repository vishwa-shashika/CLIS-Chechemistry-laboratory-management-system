<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>

<?php

include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Labtec"){
    header('location:index.php');
}

if(isset($_POST['btn_save'])){
    
    $category = $_POST['txt_category'];
    
    if(empty($category)){
        
        $error = '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Field is Empty",
        text: "Please Fill The Field First",
        icon: "warning",
            });   
        });
            
        </script>';
        
        echo $error;
    }
    
    if(!isset($error)){
        $insert = $pdo->prepare("INSERT INTO category(category) VALUES(:cat)");
        $insert->bindParam(':cat', $category);
        
        if($insert->execute()){
            //echo "Insertion sucesful baby";
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Category Added",
            text: "New Category Added To the Database",
            icon: "success",
                });   
            });
           </script>';
            
        }else{
            //echo "Insertion failed fucker";
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Failed To Add the New Category",
            text: "Something Went Wrong",
            icon: "error",
                });   
            });
            
            </script>';
        }
    }
    
    
}

include_once 'labtecHeader.php';
?>


  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Catagory</h1>
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
                  <h5 class="m-0">Category List</h5>
              </div>
             <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-5">
            <!-- general form elements -->
        
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="txt_category" placeholder="Catagory Name" >
                    <div class="card">
                      </div>
                  </div>
                <div class="card-fbody">
                  <button type="submit" class="btn btn-primary" name="btn_save">Add Category</button>
                </div>
                      
                </div>
                <!-- /.card-body -->

               
              </form>
          
              
              
          </div>
            
 <!--===== Registration Form END=============-->   
            
 <!--===== Registered Users Table=============--> 
            
            <div class="col-md-7">
              
              
            

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category</th>
                      <th>Delete</th>
                      <th>Edit</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $select = $pdo->prepare("SELECT * FROM category");
                    $select->execute();
                    while($row=$select->fetch(PDO::FETCH_OBJ)){
                        echo'
                            <tr>
                            <td>'.$row->cat_id.'</td>
                            <td>'.$row->category.'</td>
                            <td><button type="submit" value="'.$row->cat_id.'" class="btn btn-warning" name="btn_delete">Edit</button></td>
                            
                            <td><button type="submit" value="'.$row->cat_id.'" class="btn btn-danger" name="btn_delete">Delete</button></td>
                            </tr>';
                    }
                    ?>
              
                  </tbody>
                </table>
              </div>
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