<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>

<?php
include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Labtec"){
    header('location:index.php');
}

include_once 'labtecHeader.php';

if(isset($_POST['btn_add'])){
    
    $item_name = $_POST['txt_item'];
    $item_cat = $_POST['txt_cat'];
    $item_istock = $_POST['txt_istock'];
    $item_cstock = $_POST['txt_cstock'];
    $item_location = $_POST['txt_location'];
    $item_desc = $_POST['txt_desc'];
    //echo "---------------------------------";
    //echo $item_name;
    //echo $item_cat;
    //echo $item_istock;
    //echo $item_cstock;
    //echo $item_desc;
    //echo $item_location;
    
    
    $insert = $pdo->prepare("INSERT INTO items(item_name,item_cat,ideal_stock,current_stock,location,description) VALUES(:item_name, :item_cat, :ideal_stock, :current_stock, :location, :description)");
    
    $insert->bindParam(':item_name', $item_name);
    $insert->bindParam(':item_cat', $item_cat);
    $insert->bindParam(':ideal_stock', $item_istock);
    $insert->bindParam(':current_stock', $item_cstock);
    $insert->bindParam(':location', $item_location);
    $insert->bindParam(':description', $item_desc);
    
    if($insert->execute()){
        //echo "item added successfuly";
        echo '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Item Added",
        text: "New Category Added To the Database",
        icon: "success",
            });   
        });
        </script>';
        
    }else{
        echo "failed to add the item";
        echo '<script type="text/javascript">
        jQuery(function validation(){
        
        swal.fire({
        title: "Failed To Add the New Item",
        text: "Something Went Wrong",
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
            <h1 class="m-0 text-dark">Add Product</h1>
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
                  <h5 class="m-0">Product Details</h5>
              </div>
                
                
<!--========================================= Form Start ===========================================-->
                
<form role="form" action="" name="formproduct" method="post">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
<!--========================================Left Side start ==========================================-->
            
          <div class="col-md-6">

                <div class="card-body">
                  <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" class="form-control" name="txt_item" placeholder="Enter Item Name" required>
                  </div>
                    
                  <div class="form-group">
                        <label>Catagory</label>
                        <select class="form-control" name="txt_cat" required>
                          <option value="" disabled selected>Select Category</option>
                          <?php
                            $select = $pdo->prepare("SELECT * FROM category ORDER BY cat_id DESC");   
                            $select->execute();
                                
                            while($row=$select->fetch(PDO::FETCH_ASSOC)){
                                echo '<option>'.$row['category'].'</option>';
                                
                            }
                          ?>
                          


                        </select>
                  </div>
                    
                  <div class="form-group">
                    <label>Ideal Stock</label>
                    <input type="number" min="1" step="1" class="form-control" name="txt_istock" placeholder="Enter Ideal Stock" required>
                  </div>
                    
                  <div class="form-group">
                    <label>Current Stock</label>
                    <input type="number" min="0" step="1" class="form-control" name="txt_cstock" placeholder="Enter Current Stock" required>
                  </div>
                      
                </div>                                      
              
          </div>
                 
            
 <!--===================================Right Side Start ======================================-->
       
          <div class="col-md-6">

   
                <div class="card-body">
                <div class="form-group">
                    <label>Location / Rack-ID</label>
                    <input type="text" class="form-control" name="txt_location" placeholder="Enter Location" required>
                </div>
                
                    
                <div class="form-group">
                    <label>Item Description</label>
                    <textarea class="form-control" rows="4" name="txt_desc" placeholder="Enter Item Description ..."></textarea>
                 </div>
                    
                <div class="card"></div>
                
                <div class="card-fbody">
                    <button type="submit" class="btn btn-primary" name="btn_add">Add Item</button>
                    <a href="productlist.php" class="btn btn-primary" role="button" ><span title="Go Back">Cancel</span></a>
                </div>
                      
                </div>
       
          </div>
                 
            
            
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