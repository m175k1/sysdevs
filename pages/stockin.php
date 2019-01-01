<?php session_start();
   if(empty($_SESSION['id'])):
   header('Location:../index.php');
   endif;
   if(empty($_SESSION['branch'])):
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
      <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
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
                  <li class="active">Product</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-md-4">
                     <div class="box box-primary">
                        <div class="box-header">
                           <h3 class="box-title">Stockin Products</h3>
                        </div>
                        <div class="box-body">
                           <!-- Date range -->
                           <form method="post" action="stockin_add.php" id="stockin-add" enctype="multipart/form-data">
                              <div class="form-group">
                                 <label for="date">Product Name</label>
                                 <div class="input-group col-md-12">                                  
                                    <select class="form-control select2" name="prod_name" id="prod_id" required>
                                       <?php
                                          include('../dist/includes/dbcon.php');
                                          $query2=mysqli_query($con,"select * from product where branch_id='$branch' order by prod_name")or die(mysqli_error());
                                          
                                          while($row=mysqli_fetch_array($query2)){
                                          $supplier_id = $row["supplier_id"];
                                          $cat_id = $row["cat_id"];
                                   $sql="SELECT
                                             *
                                         from
                                             supplier      
                                         where supplier_id = '$supplier_id'
                                           ";
                                   $supp_query=mysqli_query($con,$sql)or die(mysqli_error());
                                   while($supp_row=mysqli_fetch_array($supp_query)){
                                      $supplier_name = $supp_row['supplier_name'];
                                   }  

                                 $sqlcat="SELECT
                                           *
                                       from
                                           category      
                                       where cat_id = '$cat_id'
                                         ";
                                 $supp_query=mysqli_query($con,$sqlcat)or die(mysqli_error());
                                  while($supp_row=mysqli_fetch_array($supp_query)){
                                      $cat_name = $supp_row['cat_name'];
                                  }?>      
                                       <option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name'];?> | <?php echo $cat_name;?> | <?php echo $supplier_name;?></option>
                                       <?php }?>
                                    </select>
                                 </div>
                              <!-- /.input group -->
                              </div>

                              <button id="new-product--btn" class="btn btn-primary col-md-12">Can't Find Item?</button>
                              <!-- /.form group -->
                              <div class="form-group">
                                 <label for="date">Quantity</label>
                                 <div class="input-group col-md-12">
                                    <input type="number" class="form-control pull-right" id="qty" name="qty" value='1' required>
                                 </div>
                                 <!-- /.input group -->
                              </div>
                              <!-- /.form group -->
                              <div class="form-group">
                                 <label for="date">Base Price</label>
                                 <div class="input-group col-md-12">
                                    <input type="text" class="form-control pull-right" id="base_price" name="base_price" placeholder="0" required>
                                 </div>
                                 <!-- /.input group -->
                              </div>
                              <!-- /.form group -->
                              <div class="form-group">
                                 <div class="input-group">
                                    <button type="submit" class="btn btn-primary" id="daterange-btn" name="">
                                    Save
                                    </button>
                                    <div class="btn btn-warning stockoutButton">Stock Out</div>
                                 </div>
                              </div>
                              <!-- /.form group -->
                           </form>


                           <form id="new-product" method="post" action="product_add.php" enctype="multipart/form-data">
                                   
                                <div class="form-group">
                                  <label for="name">Product Name</label>
                                  <div class="col-lg-12"><input type="hidden" class="form-control" id="id" name="id" required>  
                                    <input type="text" class="form-control" id="name" name="prod_name" placeholder="Product Name" required>  
                                  </div>
                                </div> 

                                <div class="form-group">
                                  <label for="price">Product Description</label>
                                  <div class="col-lg-12">
                                    <textarea class="form-control" id="price" name="prod_desc" placeholder="Product Description"></textarea>  
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="price">Reorder</label>
                                  <div class="col-lg-12">
                                    <input type="number" class="form-control" id="price" name="reorder" placeholder="Reorder Point"  required>  
                                  </div>
                                </div>
                                

                              <!-- /.form group -->
                              <div class="form-group">
                                 <label for="xqty">Quantity</label>
                                 <div class="input-group col-md-12">
                                    <input type="number" class="form-control pull-right" id="xqty" name="qty" placeholder="Input Quantity" required>
                                 </div>
                                 <!-- /.input group -->
                              </div>

                              <!-- /.form group -->
                              <div class="form-group">
                                 <label for="date">Base Price</label>
                                 <div class="input-group col-md-12">
                                    <input type="text" class="form-control pull-right" id="base_price" name="base_price" placeholder="0" required>
                                 </div>
                                 <!-- /.input group -->
                              </div>
                              <!-- /.form group -->
                              <!-- suppier list -->
                              <?php
                                 $branch=$_SESSION['branch'];
                                   $sql="SELECT
                                             *
                                         from
                                             supplier      
                                         order by
                                             supplier_name asc
                                           ";
                                   $supp_query=mysqli_query($con,$sql)or die(mysqli_error());?>
                              <div class="form-group">
                                 <label for="supplier_name">Distributor</label>
                                 <select class="form-control" id="supplier_name" name="supplier_name">
                                    <?php while($supp_row=mysqli_fetch_array($supp_query)){?>
                                    <option value="<?php echo $supp_row['supplier_id']?>"><?php echo $supp_row['supplier_name']?></option>
                                    <?php }?>
                                 </select>
                              </div>
                              <!-- suppier list -->
                              <!-- category list -->
                              <?php
                                 $sql="SELECT
                                           *
                                       from
                                           category      
                                       order by
                                           cat_name asc
                                         ";
                                 $supp_query=mysqli_query($con,$sql)or die(mysqli_error());?>
                              <div class="form-group">
                                 <label for="cat_name">Company</label>
                                 <select class="form-control" id="cat_name" name="cat_name">
                                    <?php while($supp_row=mysqli_fetch_array($supp_query)){
                                       ?>
                                    <option value="<?php echo $supp_row['cat_id']?>"><?php echo $supp_row['cat_name']?></option>
                                    <?php }?>
                                 </select>
                              </div>
                              <!-- category list -->
                              <div class="form-group">
                                 <div class="input-group">
                                    <button type="submit" class="btn btn-primary" id="daterange-btn" name="">
                                    Save
                                    </button>
                                    <!-- <div class="btn btn-warning stockoutButton">Stock Out</div> -->
                                 </div>
                              </div>
                              <!-- /.form group -->
                           </form>



                        </div>
                        <!-- /.box-body -->
                     </div>
                     <!-- /.box -->
                  </div>
                  <!-- /.col (right) -->
                  <div class="col-xs-8">
                     <div class="box box-primary">
                        <div class="box-header">
                           <h3 class="box-title">Product Stockin List</h3>
                        </div>
                        <!-- /.box-header -->
                        <br/>
                        <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
                        <div class="box-body">
                           <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Distributor</th>
                                    <th>Company</th>
                                    <th>Date Delivered</th>
                                    <th>Sub Total</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $branch=$_SESSION['branch'];
                                      $sql="
                                      SELECT a.date, a.base_price, a.qty, b.prod_name, c.supplier_name, d.cat_name   
                                      FROM stockin a 
                                      LEFT JOIN product b ON a.prod_id = b.prod_id 
                                      LEFT JOIN supplier c ON b.supplier_id = c.supplier_id
                                      LEFT JOIN category d ON b.cat_id = d.cat_id
                                      WHERE a.branch_id='$branch'
                                      order by date desc
                                      ";                                    
                                    $main_total = 0;                            
                                    $query=mysqli_query($con,$sql)or die(mysqli_error());
                                    while($row=mysqli_fetch_array($query)){
                                      $sub_total = $row['qty'] * $row['base_price'];
                                      $main_total = $main_total + $sub_total;
                                    ?>
                                 <tr>
                                    <td><?php echo $row['prod_name'];?></td>
                                    <td><?php echo $row['qty'];?></td>
                                    <td><?php echo number_format((float)$row['base_price'], 2, '.', '');?></td>
                                    <td><?php echo $row['supplier_name'];?></td>
                                    <td><?php echo $row['cat_name'];?></td>
                                    <td><?php echo $row['date'];?></td>
                                    <td><?php echo number_format((float)$sub_total, 2, '.', '');?></td>
                                 </tr>
                                 <?php }?>
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Distributor</th>
                                    <th>Company</th>
                                    <th>Date Delivered</th>
                                    <th>Sub Total</th>
                                 </tr>
                              </tfoot>                              
                           </table>
                           <table class="table table-bordered table-striped" style="width:100%">
                              <thead class="hidden">
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Distributor</th>
                                    <th>Company</th>
                                    <th>Date Delivered</th>
                                    <th>Sub Total</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td><strong>TOTAL</strong></td>
                                  <td></td>                                  
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td style="text-align: right"><strong id="stockintotal"><?php echo number_format((float)$main_total, 2, '.', '');?></strong></td>
                              </tr> 
                            </tbody>
                            <tfoot class="hidden">
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Distributor</th>
                                    <th>Company</th>
                                    <th>Date Delivered</th>
                                    <th>Sub Total</th>
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
      <script>
         $(function () {
           $("#example1").DataTable({
             "paging": false,
             "lengthChange": false,
             "searching": true,
             "ordering": true,
             "info": true,
             "autoWidth": false
           });

          $("#example1").on('DOMSubtreeModified',function(e) {
            $xrows = $("#example1 tr").length - 1;
            var  i;
            $main_total = 0;
            $sub_total = 0;
            for (i = 1; i < $xrows; i++) {
              $sub_total = $("#example1 tr").eq(i).find('td').eq(6).html()
              
              $main_total = $main_total + parseFloat($sub_total);
            }
            $("#stockintotal").html($main_total)
          })


           $('#example2').DataTable({
             "paging": false,
             "lengthChange": false,
             "searching": false,
             "ordering": true,
             "info": true,
             "autoWidth": false
           });
         });
      </script>
      <script>
         $(function () {
         $("#new-product").hide()            
         $("#new-product--btn").on("click",function(){
            $("#stockin-add").slideUp()
            $("#new-product").slideDown()            
         })
         

         $(".stockoutButton").click(function(e) {
          e.preventDefault();    

    
                $.ajax({
                     type: "POST",
                     url: "ajax.php",
                     data: { 
          prod_id: $("#prod_id").val(), // < note use of 'this' here
          qty: $("#qty").val(), // < note use of 'this' here
                         process: 'stockout'
                     },
                     success: function(result) {
                         if(result == ""){ 
                             alert("bad")                        
                         }else{
                             alert("success")
           location.reload();
                         }
                         
                     },
                     error: function(result) {
                         alert('error');
                     }
                 });

                            

           }); // ajax    
         
         
         
         });
      </script>
   </body>
</html>