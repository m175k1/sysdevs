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
      <title>Product | <?php include('../dist/includes/title.php');?></title>
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
      <style>
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
      .col-md-4{
        display: none;
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
    background-color: #f72121!important;
    border-color: #ffffff;
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
                                                   
                                                   <div class="modal main_modal">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h4 class="modal-title">Data</h4>
 
                                                      </div>
                                                      <div class="modal-body">
                                                        <div>
                                                          <div class="flex">
                                                            <p><strong>Supplier</strong></p>
                                                            <p><strong>Distributor</strong></p>
                                                            <p><strong>Quantity</strong></p>
                                                            <p><strong>Base Price</strong></p>
                                                          </div>
                                                          <div class="bset">                                                          
                                                          </div>
                                                                                       
                                                        </div>
                                                      </div>
                                                    </div>
                                                    </div>
                                                  </div>
                                             
      <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
         <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <td>
                  <a class="btn btn-lg btn-warning" href="home.php">Back</a>
                  <!-- <a class="btn btn-lg btn-primary" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-blue"></i></a> -->
               </td>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Product</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-xs-12">
                     <div class="box box-primary">
                        <div class="box-header">
                           <h3 class="box-title">Product List</h3>
                        </div>
                        <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <table id="example1" class="table table-bordered table-striped" style="width:100%">
                              <thead>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th colspan="2">Action</th>
                                 </tr>
                              </thead>
                              <tbody>
 
                                 <?php
                                    $counter=0;
                                    $branch=$_SESSION['branch'];
                                    $query=mysqli_query($con,"select * from masterfile where branch_id = '$branch' order by prod_name ")or die(mysqli_error());
                                      // product query                                    
                                    while($row=mysqli_fetch_array($query)){
                                          /*$x = $row['supplier_id'];
                                          $cat = $row['cat_id'];*/
                                        $prod_id = $row['master_id'];
                                        $prod_name = $row['prod_name'];
                                        $prod_qty = $row['prod_qty'];
                                        $base_price = $row['base_price'];
                                         
                                      ?>
                                 <tr>
                                    <td><?php echo $prod_name;?></td>
                                    <td><?php echo $prod_qty;?></td>
                                    <td>
                                      <?php if ($prod_qty == 0) echo 0;
                                      else echo number_format($base_price,2);?>
                                      </td>
                                    <td>
                                       <a href="#updateordinance<?php echo $prod_id;?>" data-target="#updateordinance<?php echo $prod_id;?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                                       
                                    </td>
                                    <td><button class="btn btn-primary fkingbutton" data-prod="<?php echo $prod_name;?>" data-branch="<?php echo $branch;?>">Show data</button></td>
                                 </tr>
                               
                                 <div id="updateordinance<?php echo $prod_id;?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                       <div class="modal-content" style="height:auto">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">×</span></button>
                                             <h4 class="modal-title">Update Product Details</h4>
                                          </div>
                                          <div class="modal-body">
                                             <form class="form-horizontal" method="post" action="product_update.php" enctype='multipart/form-data'>
                                               
                                                <div class="form-group">
                                                   <label class="control-label col-lg-3" for="name">Product Name</label>
                                                   <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="name" value="<?php echo $row['prod_name'];?>" required>  
                                                      <input type="text" class="form-control" id="name" name="prod_name" value="<?php echo $row['prod_name'];?>" required>  
                                                   </div>
                                                </div>                                        
                                          <br><br><br><br><br><br><br>
                                          <div class="modal-footer">
                                         
                                          <button type="submit" class="btn btn-primary">Save changes</button>
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!--end of modal-dialog-->
                                 </div>
                                 <!--end of modal-->                    
                                 <?php $counter++;
                               }?>            
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                        <!-- /.box-body -->
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
            </section>
            <!-- /.content -->
            </div><!-- /.container -->
         </div>
         <!-- /.content-wrapper -->
         <?php include('../dist/includes/footer.php');?>
      </div>
      <!-- ./wrapper -->
      <div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
         <div class="modal-dialog">
            <div class="modal-content" style="height:auto">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Add New Product</h4>
               </div>
               <div class="modal-body">
                  <form class="form-horizontal" method="post" action="product_add.php" enctype='multipart/form-data'>
                     <div class="form-group">
                        <label class="control-label col-lg-3" for="price">Product Code</label>
                        <div class="col-lg-9">
                           <input type="text" class="form-control" id="price" name="serial" placeholder="Product Code" required>  
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-lg-3" for="name">Product Name</label>
                        <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
                           <input type="text" class="form-control" id="name" name="prod_name" placeholder="Product Name" required>  
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-lg-3" for="price">Product Description</label>
                        <div class="col-lg-9">
                           <textarea class="form-control" id="price" name="prod_desc" placeholder="Product Description"></textarea>  
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-lg-3" for="price">Reorder</label>
                        <div class="col-lg-9">
                           <input type="number" class="form-control" id="price" name="reorder" placeholder="Reorder Point"  required>  
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-lg-3" for="price">Picture</label>
                        <div class="col-lg-9">
                           <input type="file" class="form-control" id="price" name="image">  
                        </div>
                     </div>
               </div>
               <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Save changes</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
               </form>
            </div>
         </div>
         <!--end of modal-dialog-->
      </div>
      <!--end of modal-->
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
 
 
        $(".fkingbutton").on('click',function(){
            $counter = $(this).attr('data-attr')
            $(".modal_" + $counter).show()
            $.ajax({
                     type: "POST",
                     url: "ajax.php",
                     data: {
                         prod_name: $(this).attr('data-prod'),
                         branch: $(this).attr('data-branch'),
                         process: 'modal_data'
                     },
                     success: function(result) {
                         if(result == ""){
                           alert("no data")
                         }else{
                           $(".main_modal").fadeIn(function(){
                              $(".bset").html(result)
                           })
                         }                    
                         
                     },
                     error: function(result) {
                         alert('error');
                     }
            });
           
         })
 
        $(".main_modal").on('click',function(){
            $(this).hide()
        })
 
         $(".deleteButton").click(function(e) {
                 e.preventDefault();
         var confirmation = confirm("are you sure you want to remove the item?");
         
         if (confirmation) {
                 $.ajax({
                     type: "POST",
                     url: "ajax.php",
                     data: {
                         serial: $(this).val(), // < note use of 'this' here
                         process: 'delete'
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
             });
         });
         
 
      </script>
   </body>
</html>