<script src="plugins/sweetalert/jquery-3.4.1.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.all.min.js"></script>

<?php
include_once 'connectdb.php';
session_start();

if($_SESSION['role']!="Lecture"){
    header('location:index.php');
}

include_once 'labreqHeader.php';

if(isset($_POST['btn_request'])){
    
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $batch_year = $_POST['batch_year'];
    $rq_date = $_POST['rq_date'];
    $s_time = $_POST['s_time'];
    $e_time = $_POST['e_time'];
    $op_msg = $_POST['op_msg'];
    
    //echo '--------------------';
    //echo $course_name;
    //echo $course_code;
    //echo $batch_year;
    //echo $rq_date;
    //echo $s_time;
    //echo $e_time;
    //echo $op_msg;
    
    $lec_name = $_SESSION['name'];
    $lec_email = $_SESSION['email'];

    //echo '---------------';
    //echo $lec_name;
    //echo $lec_email;
    
    
    //$insert = $pdo->prepare("INSERT INTO requests(lec_name, lec_mail, c_name, c_code, batch, date, s_time, e_time, op_msg, approval) VALUES(:lec_name, :lec_email, :course_name, :course_code, :batch_year, :rq_date, :s_time, :e_time, :op_msg, Pending)");
    
    $insert = $pdo->prepare("INSERT INTO requests (lec_name,lec_mail,c_name,c_code,batch,date,s_time,e_time,op_msg,approval) VALUES(:lec_name, :lec_email, :course_name, :course_code, :batch_year, :rq_date, :s_time, :e_time, :op_msg, 'Pending')");
    
    $insert->bindParam(':lec_name', $lec_name);
    $insert->bindParam(':lec_email', $lec_email);
    $insert->bindParam(':course_name', $course_name);
    $insert->bindParam(':course_code', $course_code);
    $insert->bindParam(':batch_year', $batch_year);
    $insert->bindParam(':rq_date', $rq_date);
    $insert->bindParam(':s_time', $s_time);
    $insert->bindParam(':e_time', $e_time);
    $insert->bindParam(':op_msg', $op_msg);
    
    
    
    if($insert->execute()){
        //echo "item added successfuly";
        echo '<script type="text/javascript">
        jQuery(function validation(){
            
        swal.fire({
        title: "Request Submitted Successfully",
        text: "Your Request is Submitted For Approval",
        icon: "success",
            });   
        });
        </script>';
        
    }else{
        //echo "failed to add the item";
        echo '<script type="text/javascript">
        jQuery(function validation(){
        
        swal.fire({
        title: "Request Faild",
        text: "Something Went Wrong",
        icon: "error",
            });   
        });
            
        </script>';
    }
  
    

    
}
?>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lab Session Requests</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
      
      
<div class="content">
    <div class="container-fluid">
     <div class="row">
        <div class="col-lg-12">


           <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Request Form</h5>
            </div>
      
<form role="form" action="" method="post">           
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
            

          <!-- /.col (left) -->
          <div class="col-md-6">
              
              
              <div class="card-body">
                  
                <div class="form-group">
                    <label>Course Name</label>
                    <input type="text" class="form-control" name="course_name" placeholder="Enter Subject Name" required>
                </div>
                  
                <div class="form-group">
                    <label>Course Code</label>
                    <input type="text" class="form-control" name="course_code" placeholder="Enter Course Code" required>
                </div>
                  
                <div class="form-group">
                    <label>Student Batch</label>
                    <input type="text" class="form-control" name="batch_year" placeholder="Enter Student Batch" required>
                </div>
                  
                <!-- Date range -->
                <div class="form-group">
                  <label>Date</label>

                  <div class="input-group">
                      <input type="text" class="form-control float-right" id="reservation" name="rq_date">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    
                  </div>
                    
                </div>
                  
                <div class="card-fbody">
                    <button type="submit" class="btn btn-primary" name="btn_request">Send Request</button>
                    <a href="lectureDash.php" class="btn btn-primary" role="button" ><span title="Go Back">Cancel</span></a>
                </div>

                <!-- /.form group -->

            </div>
            </div>
            
            
     <!--========================= Color & Time Picker ============================== -->
            <div class="col-md-6">
            
            <div class="card-body">
  
                <!-- Color Picker -->


                <!-- Color Picker -->

                <!-- /.form group -->

                <!-- time Picker -->
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Start Time</label>

                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker" name="s_time" />
                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>   
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label>End Time</label>

                    <div class="input-group date" id="timepicker2" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker2" name="e_time"/>
                        <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>   
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label>Messege (Optional)</label>
                    <textarea class="form-control" rows="4" name="op_msg" placeholder="Enter Item Description ..."></textarea>
                  </div>
                    
                    
                    
                    
                  <!-- /.form group -->
                </div>
              <!-- /.card-body -->
            </div>
            </div>
            
            
            
    <!--========================= Color & Time Picker END ============================== -->
          
            
            
            
            <!-- /.card -->
            <!-- /.card -->

            <!-- iCheck -->
            
          </div>
          
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->
      <!-- /.container-fluid -->
    </section>
</form>
               </div>
            </div>
         </div>
        </div>
    </div>
               
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker({
        singleDatePicker: true
    })
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: false,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
      
    $('#timepicker2').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
<?php
include_once 'labreqFooter.php';
?>

</body>
</html>
