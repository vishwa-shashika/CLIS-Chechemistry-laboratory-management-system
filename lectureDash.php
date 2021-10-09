<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>



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
            <h1 class="m-0 text-dark">Request List</h1>
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
                  <h5 class="m-0"><a href="labrequest.php" class="btn btn-primary" role="button" ><span title="Delete">New Request</span></a></h5>
              </div>
             <section class="content">
      <div class="container-fluid">
        <div class="row">


 <!--===== Item List Table=============--> 
            
          
              
               <div class="col-lg-12">
            

              <!-- /.card-header -->
       
            <div class="card">
              </div>
  
              <div class="card-body table-responsive p-0">
                <table id="example1" class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Course Code</th>
                      <th>Batch</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th>View</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $select = $pdo->prepare("SELECT * FROM requests WHERE lec_mail=:lec_mail");
                    $select->bindParam('lec_mail',$_SESSION['email']);
                    $select->execute();
                    while($row=$select->fetch(PDO::FETCH_OBJ)){
                        echo'
                            <tr>
                            <td>'.$row->req_id.'</td>
                            <td>'.$row->c_code.'</td>
                            <td>'.$row->batch.'</td>
                            <td>'.$row->date.'</td>
                            <td>'.$row->s_time." - ".$row->e_time.'</td>
                            <td>'.$row->approval.'</td>
                           

                            
                            <td><a href="viewreq.php?id='.$row->req_id.'" class="btn btn-success" role="button" ><span class="nav-icon nav-icon fas fa-eye" style="color:#ffffff" data-toggle="tooltip" title="View Item"></span></a></td>
 
                            </tr>';
                            


                    }
                    ?>
                      
                    
              
                  </tbody>
                </table>
              </div>
            <div class="card">
              </div>
          
              <!-- /.card-body -->
            </div>
            
        
            
<!--===== Item List Table End=============--> 
       
            
            
            
            
            
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
    $("#example1").DataTable({
        "order":[[0,"desc"]]
    });
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