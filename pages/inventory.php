<?php session_start();
   if(empty($_SESSION['id'])):
   header('Location:../index.php');
   endif;
   if(empty($_SESSION['branch'])):
   header('Location:../index.php');
   endif;
   ?><!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Product Inventory Report | <?php include('../dist/includes/title.php');?></title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
      <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" type="text/css" href="dist/css/sample1.css">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico|Raleway" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
       <style type="text/css">
      h5,h6{
        text-align:center;
      }
    

       @media print {
          .btn-print {
            display:none !important;
          }
      .main-footer  {
      display:none !important;
      }
      div.dataTables_length label {
        display: none !important;
      }
      div.dataTables_filter label{
        display: none !important;
      }
      div.dataTables_paginate ul.pagination{
        display: none !important;
      }
      div.dataTables_info{
        display: none !important;
      }
      table.table-bordered th:last-child{
        display:none;
      }
    }
  

@media print{
table tr td:nth-child(6){
    visibility:hidden;
  }
}
@media print{
table tr th:nth-child(6){
    visibility:hidden;
  }
}
@media print{
table tr td:nth-child(7){
    visibility:hidden;
  }
}
@media print{
table tr th:nth-child(7){
    visibility:hidden;
  }
}


      
      
      ::-webkit-scrollbar{
  width: 5px;
}
::-webkit-scrollbar-thumb{
  background:linear-gradient(white,blue);
 
}
.box.box-primary{
         border-top-color:rgba(44, 140, 181)!important;
      }
        
.content{
  font-family: 'Comfortaa', cursive;
}
h3{
  font-family: 'Comfortaa', cursive;
 text-align: center;
      
        
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
               <!-- Main content -->
               <section class="content">
                  <div class="row">
                     <div class="col-xs-12">
                        <div class="box box-primary">
                           <div class="box-body">
                              <?php
                                 include('../dist/includes/dbcon.php');
                                 
                                 $branch=$_SESSION['branch'];
                                     $query=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
                                   
                                         $row=mysqli_fetch_array($query);
                                         
                                 ?>      
                              <h5><b><?php echo $row['branch_name'];?></b> </h5>
                              <h6>Address: <?php echo $row['branch_address'];?></h6>
                              <h6>Contact #: <?php echo $row['branch_contact'];?></h6>
                              <h5><b>Product Inventory as of today, <?php echo date("M d, Y h:i a");?></b></h5>
                              <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
                              <a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>
                              <form class="form-inline no-print" method="POST" action="search.php">
                               
                                
                              </form>
                        
                              <table id="example1" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th style="display:none;">Product Code</th>
                                       <th>Product Name</th>
                                       <th style="display:none;">Distributor</th>
                                       <th style="display:none;">Company</th>
                                       <th>Qty Left</th>
                                       <th>Price</th>
                                       <th>Total</th>
                                       <th style="text-align:center">Reorder</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $branch=$_SESSION['branch'];
                                       $query=mysqli_query($con,"select * from product natural join supplier natural join category where branch_id='$branch' order by prod_name")or die(mysqli_error());
                                       $grand=0;
                                       while($row=mysqli_fetch_array($query)){
                                         $total=$row['base_price']*$row['prod_qty'];
                                         $grand+=$total;
                                       ?>
                                    <tr>
                                       <td style="display:none;"><?php echo $row['prod_id'];?></td>
                                       <td><?php echo $row['prod_name'];?></td>
                                       <td style="display:none;"><?php echo $row['supplier_name'];?></td>
                                       <td style="display:none;"><?php echo $row['cat_name'];?></td>
                                       <td><?php echo $row['prod_qty'];?></td>

                                       <td><?php if ($row['prod_qty'] == 0){
                                                  echo "0";
                                                  } 
                                                  else {

                                                    echo $row['base_price'];
                                                  }
                                       ?>
                                         
                                       </td>
                                       <td><?php echo number_format($total,2);?></td>
                                       <td class="text-center"><?php if ($row['prod_qty']<=$row['reorder'])echo "<span class='badge bg-red'><i class='glyphicon glyphicon-refresh'></i>Reorder</span>"; else echo "<span class='badge bg-green'><i class='glyphicon glyphicon-refresh'></i> Good</span>"; ?></td>
                                    </tr>
                                    <?php }?>           
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <th colspan="3">Total</th>
                                       <th colspan="4">P<?php echo number_format($grand,2);?></th>
                                    </tr>
                                    <tr>
                                       <th></th>
                                       <th></th>
                                       <th></th>
                                       <th></th>
                                    </tr>
                                    <tr>
                                       <th>Prepared by:</th>
                                       <th></th>
                                       <th></th>
                                       <th></th>
                                    </tr>
                                    <?php
                                       $id=$_SESSION['id'];
                                       $query=mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
                                       $row=mysqli_fetch_array($query);
                                       
                                       ?>                      
                                    <tr>
                                       <th><?php echo $row['name'];?></th>
                                       <th></th>
                                       <th></th>
                                       <th></th>
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                           <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </section>
               <!-- /.content -->
            </div>
            <!-- /.container -->
         </div>
         <!-- /.content-wrapper -->
         <?php include('../dist/includes/footer.php');?>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 2.1.4 -->
      <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <!-- Bootstrap 3.3.5 -->
      <script src="../bootstrap/js/bootstrap.min.js"></script>
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
      <script>
         $(function () {
           //$("#example1").DataTable();
           $('#example1').DataTable({
             "paging": false,
             "lengthChange": false,
             "searching": true,
             "ordering": true,
             "info": true,
             "autoWidth": false
           });
         });
      </script>
   </body>
</html>