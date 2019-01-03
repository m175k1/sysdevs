<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/sample1.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico|Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
   <style>

       @media print {
          .btn-print {
            display:none !important;
          }
      .main-footer  {
      display:none !important;
      }
      div.dataTables_paginate ul.pagination{
        display: none !important;
      }
      .box-title{
        display: none;
      }
      .form-group{
        display:none;
      }
      thead{
        display:none;
      }
      tfoot{
        display:none;
      }
     #example1{
      display: none;
     }
     .modal-title{
      display: none;
     }
     #example1{
      display:none !important;
     }
     div.dataTables_info{
      display:none;
     }
     div.dataTables_filter label{
      display:none;
     }

div.dataTables_length label{
  display:none;
}
.box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title{
  display:none;
}
    }
::-webkit-scrollbar{
  width: 5px;
}
::-webkit-scrollbar-thumb{
  background:linear-gradient(white,green);
 
}
.box.box-primary{
        border-top-color:green;
      }
.btn-warning {
    background-color: green!important;
    border-color: #ffffff;
}
.btn-primary {
    background-color: #c30d15;
    border-color: #ffffff;
} 
.content{
  font-family: 'Comfortaa', cursive;
}
h3{
  font-family: 'Comfortaa', cursive;
 text-align: center;
}
.modal-header{
  background-image: linear-gradient(to left, rgba(0,0,20,10) , rgba(150,130,25,0.94));
  color:white;
}
.form-control {
      margin-bottom: 15px;
    }
        
          </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');
      include('../dist/includes/dbcon.php');
      ?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="home.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Customer</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	          
			
            <div class="col-xs-12">
              <div class="box box-primary">
    
                <div class="box-header">
                  <h3 class="box-title">Customer List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
            						<th>Account #</th>
            						<th style="display:none;">Picture</th>
                        <th>Customer Last Name</th>
                        <th>Customer First Name</th>
                        <th>Address</th>
            						<th>Contact #</th>
            						<th>Balance</th>
                        <th>Credit Status</th>
            						<th>Status</th>
                        <th>Action</th>
						
                      </tr>
                    </thead>
                    <tbody>
<?php
		$branch=$_SESSION['branch'];
		$query=mysqli_query($con,"select * from customer where branch_id='$branch'")or die(mysqli_error());
		$i=1;
		while($row=mysqli_fetch_array($query)){
		$cid=$row['cust_id'];
?>
                      <tr>
					    <td><?php echo $row['cust_id'];?></td>
						<td style="display:none;"><img style="width:80px;height:60px" src="../dist/uploads/<?php echo $row['cust_pic'];?>"></td>
                        <td><?php echo $row['cust_last'];?></td>
                        <td><?php echo $row['cust_first'];?></td>
                        <td><?php echo $row['cust_address'];?></td>
						<td><?php echo $row['cust_contact'];?></td>
						<td><?php echo number_format($row['balance'],2);?></td>
            <td><?php echo $row['credit_status'];?></td>
						<td><?php if ($row['balance']==0) 
								echo "<span class='label label-danger'>inactive</span>";
								else echo "<span class='label label-info'>active</span>";
							?></td>
                        <td>
				<a href="<?php if ($row['credit_status']=='Approved') echo "account_summary.php?cid=$cid";?>"><i class="glyphicon glyphicon-share-alt text-green"></i></a>
				<a href="#updateordinance<?php echo $row['cust_id'];?>" data-target="#updateordinance<?php echo $row['cust_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
				
						</td>
                      </tr>
				<div id="updateordinance<?php echo $row['cust_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Customer Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="customer_update.php" enctype='multipart/form-data'>
                
				<div class="form-group">
					<label class="control-label col-lg-3" for="name">Last Name</label>
					<div class="col-lg-9">
						<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['cust_id'];?>" required>  
						<input type="text" class="form-control" id="name" name="last" value="<?php echo $row['cust_last'];?>" required>  
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-3" for="name">First Name</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" id="name" name="first" value="<?php echo $row['cust_first'];?>" required>  
					</div>
				</div>				
				<div class="form-group">
					<label class="control-label col-lg-3" for="file">Address</label>
					<div class="col-lg-9">
					    <textarea class="form-control" id="name" name="address" required><?php echo $row['cust_address'];?></textarea>  
					</div>
				</div> 
				<div class="form-group">
					<label class="control-label col-lg-3" for="price">Contact Number</label>
					<div class="col-lg-9">
					  <input type="text" class="form-control" id="price" name="contact" value="<?php echo $row['cust_contact'];?>" required>  
					</div>
				</div>
        <br>
        <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
		<div class="clearfix"></div>
				  <div class="history" style="margin-top:50px">
          </div>
              </div><br><br><br><hr>
              <div class="modal-footer">
              <button class="btn btn-warning deleteButton" value="<?php echo $row['cust_id'];?>">Delete</button>
              <button class="btn btn-warning historyButton" value="<?php echo $row['cust_id'];?>">History</button>
		<button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->   	  
                 
<?php $i++;}?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
						<th style="display:none;">Picture</th>
                        <th>Customer Last Name</th>
                        <th>Customer First Name</th>
                        <th>Address</th>
              						<th>Contact #</th>
              						<th>Balance</th>
                          <th>Credit Status</th>
              						<th>Status</th>
                        <th>Action</th>
                      </tr>					  
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
 
            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
	 
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
           <style>
	table tr td{
		border:1px solid #ddd;
		padding:8px;
		
	}
	table{
		margin-bottom:40px;
	}
	</style> 
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
     <script>
      /* $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
      */

      $(document).ready(function(){
              $(".deleteButton").click(function(e) {
              e.preventDefault();
			var confirmation = confirm("are you sure you want to remove the item?");

			if (confirmation) {
              $.ajax({
                  type: "POST",
                  url: "ajax.php",
                  data: { 
                      cust_id: $(this).val(), // < note use of 'this' here
                      process: 'customer'
                  },
                  success: function(result) {
                      if(result == ""){ 
                        if(alert(result)){}
                            else    window.location.reload(); 
                        
                      }else{
                        if(alert(result)){}
                            else    window.location.reload(); 
                      }                    
                      
                  },
                  error: function(result) {
                      alert('error');
                  }
              });
			}
        }); // ajax 

              $(".glyphicon-edit").click(function(){
                  $(".history").html("")
              })


              $(".historyButton").click(function(e) {
              e.preventDefault();
              $.ajax({
                  type: "POST",
                  url: "ajax.php",
                  data: { 
                      cust_id: $(this).val(), // < note use of 'this' here
                      process: 'cust_history'
                  },
                  success: function(result) {
                      if(result == ""){ 
                          alert("bad")                        
                      }else{
                          $(".history").html(result);
                      }
                      
                  },
                  error: function(result) {
                      alert('error');
                  }
              });
        }); // ajax 
		
				  $(".glyphicon-edit").click(function(){
			  $(".history").html("");
		  })
      })
    </script>
  </body>
</html>
