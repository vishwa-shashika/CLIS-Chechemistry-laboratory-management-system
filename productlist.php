<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>



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
            <h1 class="m-0 text-dark">Equipment List</h1>
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

                  
                <div class="card-fbody">
                    <a href="additem.php" class="btn btn-primary" role="button" ><span title="Go Back">Add New Equipment</span></a>
                    <a href="adminReportFull.php" class="btn btn-success float-sm-right" role="button" ><span title="Go Back">Generate Report</span></a>
                    <a href="labtecDash.php" class="btn btn-primary" role="button" ><span title="Go Back">Go back</span></a>
                    
                </div>

                  

                  
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
                      <th>Name</th>
                      <th>Category</th>
                      <th>Ideal Stock</th>
                      <th>Current Stock</th>
                      <th>Location</th>
                      <th>View</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $select = $pdo->prepare("SELECT * FROM items");
                    $select->execute();
                    while($row=$select->fetch(PDO::FETCH_OBJ)){
                        echo'
                            <tr>
                            <td>'.$row->item_id.'</td>
                            <td>'.$row->item_name.'</td>
                            <td>'.$row->item_cat.'</td>
                            <td>'.$row->ideal_stock.'</td>
                            <td>'.$row->current_stock.'</td>
                            <td>'.$row->location.'</td>
                           

                            
                            <td><a href="viewitem.php?id='.$row->item_id.'" class="btn btn-success" role="button" ><span class="nav-icon nav-icon fas fa-eye" style="color:#ffffff" data-toggle="tooltip" title="View Item"></span></a></td>
                            
                            <td><a href="edititem.php?id='.$row->item_id.'" class="btn btn-warning" role="button" ><span class="nav-icon nav-icon fas fa-edit" style="color:#ffffff" data-toggle="tooltip" title="edit Item"></span></a></td>
 
                            
                            <td><button type="submit" id='.$row->item_id.' class="btn btn btn-danger btndelete" name="btn_delete"><span class="nav-icon fas fa-trash-alt" style="color:#ffffff" data-toggle="tooltip" title="Delete Item"></button></td>
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


<script>
$(document).ready(function(){
    $('.btndelete').click(function(){
        
        var tdh = $(this);
        var id = $(this).attr("id");
        
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
                      $.ajax({
            url:'itemdelete.php',
            type:'post',
            data:{
                pid:id
            },
            success:function(data){
                tdh.parents('tr').hide();
            }
            
        })
            Swal.fire(
              'Deleted!',
              'Item has been deleted.',
              'success'
            )
          }
        })
        

        
    })
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