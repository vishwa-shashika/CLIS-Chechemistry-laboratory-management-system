<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>

<?php
include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Lecture" AND $_SESSION['role']!="Labtec"){
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
            <h1 class="m-0 text-dark">Request Details</h1>
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
                <h5 class="m-0"><a href="lectureDash.php" class="btn btn-primary" role="button" ><span title="Delete">Go Back</span></a></h5>
              </div>
                
                
<!--========================================= Form Start ===========================================-->
                
<form role="form" action="" name="formproduct" method="post">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
<!--========================================Left Side start ==========================================-->
            
<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $select = $pdo->prepare("SELECT * FROM requests WHERE req_id=:id");
        $select->bindParam(':id', $id);

        $select->execute();
        while($row=$select->fetch(PDO::FETCH_OBJ)){
            //echo $row->req_id;
            //echo $row->item_name;
            //echo $row->item_cat;
            //echo $row->ideal_stock;
            //echo $row->current_stock;
            //echo $row->location;
            //echo $row->description;
            
            echo '
          <div class="col-md-6">
            <div class="card">
              </div>

              <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Request ID
                <span class="badge badge-info badge-pill">'.$row->req_id.'</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Course Name
                <span class="badge badge-primary badge-pill">'.$row->c_name.'</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Course Code
                <span class="badge badge-info badge-pill">'.$row->c_code.'</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Batch
                <span class="badge badge-warning badge-pill">'.$row->batch.'</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Date
                <span class="badge badge-success badge-pill">'.$row->date.'</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Time
                <span class="badge badge-success badge-pill">'.$row->s_time." - ".$row->e_time.'</span>
              </li>
          </div>
                 
            
 <!--===================================Right Side Start ======================================-->
       
          <div class="col-md-6">
            <div class="card">
              </div>

            <ul class="list-group">
            
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Status
                <span class="badge badge-success badge-pill">'.$row->approval.'</span>
              </li>

              <li class="list-group-item align-items-bottom-left">
                <h5>Description -</h5>
                <span class="">'.$row->op_msg.'</span>
              </li>
            </ul>

       
          </div>';
            
            
            
        }
    }
?>

                 
            
            
<!--===================================All Side End ======================================-->
            



 
            
            
            
            
            
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
   </div><!-- /.container-fluid -->
</section>
</form> 
<!--============================== Form END ======================================================-->
      
      
      
      
      
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