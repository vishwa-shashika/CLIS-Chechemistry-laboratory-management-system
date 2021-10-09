<?php

include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Lecture"){
    header('location:index.php');
}

include_once 'lectureHeader.php';
?>

  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lecture Dashboard</h1>
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
              
              
        <div class="row">
            
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Requests</h3>

                <p>Details about Equipments</p>
              </div>
              <div class="icon">
                <i class="ion ion-beaker"></i>
              </div>
              <a href="productlist.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            

          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>+ New Request</h3>

                <p>Add New Equipment to System</p>
              </div>
              <div class="icon">
                <i class="ion ion-plus"></i>
              </div>
              <a href="additem.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Change Passwd</h3>

                <p>Change Your Password</p>
              </div>
              <div class="icon">
                <i class="ion ion-lock-combination"></i>
              </div>
              <a href="passwordchange.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            
            
            
          <!-- ./col -->
        </div>
              
              
            </div>
          </div>
          
    <div class="row">
          <div class="col-lg-12">
              
              
        <div class="row">
           
            
       <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>Sign Out</h3>

                <p>Sign Out From Dashboard</p>
              </div>
              <div class="icon">
                <i class="ion ion-share"></i>
              </div>
              <a href="logout.php" class="small-box-footer">Log Out Here <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <!-- ./col -->
        </div>
              
              
            </div>
          </div>
          
        </div>
      </div>
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

<?php
include_once 'commanFooter.php';
?>