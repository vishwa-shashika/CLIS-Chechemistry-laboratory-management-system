<?php

include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Labtec"){
    header('location:index.php');
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
                
              </div>
             <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Category Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="txt_catagory" placeholder="Catagory Name" >
                    <div class="card">
                      </div>
                <div class="card-fbody">
                  <button type="submit" class="btn btn-primary" name="btn_save">Add Category</button>
                </div>
                  </div>
                      
                </div>
                <!-- /.card-body -->

               
              </form>
            </div>
              
              
          </div>
            
 <!--===== Registration Form END=============-->   
            
 <!--===== Registered Users Table=============--> 
            
            <div class="col-md-8">
              
              
              <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Category List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
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
        
                    <tr>
                    <td>item-1</td>
                    <td>item</td>
                    <td>item</td>
                    <td>item</td>
                    </tr>
                    
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