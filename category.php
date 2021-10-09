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
    
    
}//End of add button code


if(isset($_POST['btn_update'])){
    
    $id = $_POST['txt_id'];
    $new_cat = $_POST['txt_new_cat'];
    
    //echo "-------------------".$new_cat;
    
    if(empty($new_cat)){
        
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
        $update = $pdo->prepare("UPDATE category SET category=:new_cat WHERE cat_id=:id");
        $update->bindParam(':new_cat', $new_cat);
        $update->bindParam(':id', $id);
        
        if($update->execute()){
            //echo "Insertion sucesful baby";
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Category Updated",
            text: "Category Updated in the Database",
            icon: "success",
                });   
            });
           </script>';
            
        }else{
            //echo "Insertion failed fucker";
            
            echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal.fire({
            title: "Failed to Update the Category",
            text: "Something Went Wrong",
            icon: "error",
                });   
            });
            
            </script>';
        }
    }
    
    
    
}// end of edit button code

if(isset($_POST['btn_delete'])){
    
    //echo '=--------------delete set';
    
    $delete = $pdo->prepare("DELETE FROM category WHERE cat_id=:del_id");
    $delete->bindParam(':del_id',$_POST['btn_delete']);
    
    if($delete->execute()){
        
        echo '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Category Deleted",
        text: "Category Deleted from the Database",
        icon: "success",
            });   
        });
        </script>';
        
    }else{
        
        echo '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Failed to Delete the Category",
        text: "Something Went Wrong",
        icon: "error",
            });   
        });
            
        </script>';
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
                    
    
    <!--================PHP CODE THAT USED IN EDIT CATEGORY BUTTON===========-->
                    
                  <?php
                  if(isset($_POST['btn_edit'])){
                    $catid = $_POST['btn_edit'];
                      
                    $select=$pdo->prepare("SELECT * FROM category WHERE cat_id=".$catid);
                    if($select->execute()){
                        //echo "--------------quary OK";
                    }else{
                        //echo "quary Fucked";
                    }
                    
                    if($select){
                        $row = $select->fetch(PDO::FETCH_OBJ);
                        
                        //echo $row->cat_id.'-------';
                        //echo $row->category;
                          echo 
                        '<div class="form-group">
                        <input type="hidden" class="form-control" name="txt_id" value="'.$row->cat_id.'"        placeholder="Enter Category" >
  
                       
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="txt_new_cat" value="'.$row->category.'"        placeholder="Enter Category" required>
                        
                    
                        <div class="card">
                        </div>
                    
                        </div>
                        <div class="card-fbody">
                        <button type="submit" class="btn btn-warning" value="'.$row->cat_id.'" name="btn_update">Update Category</button>
                        <a href="category.php" class="btn btn-primary" role="button" ><span title="Go Back">Cancel</span></a>
                        </div>';                  

                        
                    }else{  
                        echo "Somthing went wrong";
                    }

                      
                  }else{
                      
                    echo '<div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="txt_category" placeholder="Catagory Name" >
                    <div class="card">
                    </div>
                    </div>
                    <div class="card-fbody">
                    <button type="submit" class="btn btn-primary" name="btn_save">Add Category</button>
                    <a href="labtecDash.php" class="btn btn-primary" role="button" ><span title="Go Back">Go Back</span></a>
                    </div>';
                  }
                    
                  ?>

                      
                </div>
                <!-- /.card-body -->

               
              </form>
          
              
              
          </div>
            
 <!--===== Registration Form END=============-->   
            
 <!--===== Registered Users Table=============--> 
            
            <div class="col-md-7">
              
              
            

              <!-- /.card-header -->
            <form action="" method="post">
            <div class="card">
              </div>
  
              <div class="card-body table-responsive p-0">
                <table id="example1" class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    
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
                            <td><button type="submit" value="'.$row->cat_id.'" class="btn btn-warning" name="btn_edit"><span class="nav-icon fas fa-edit" style="color:#ffffff" data-toggle="tooltip" title="Edit Item"></button></td>
                            

                            <td><button type="submit" value="'.$row->cat_id.'" class="btn btn-danger" name="btn_delete"><span class="nav-icon fas fa-trash-alt" style="color:#ffffff" data-toggle="tooltip" title="Delete Item"></button></td>
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