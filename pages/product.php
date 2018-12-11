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
                        <!-- /.box-header -->
                        <div class="box-body">
                           <table id="example1" class="table table-bordered table-striped" style="width:100%">
                              <thead>
                                 <tr>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $counter=0;
                                    $branch=$_SESSION['branch'];
                                    $query=mysqli_query($con,"select * from masterfile where branch_id = '$branch' order by prod_name ")or die(mysqli_error());
                                      // product query 
                                    ?> <div class="modal modal_<?php echo $counter; ?>"> 
                                                   <div class="modal modal_<?php echo $counter; ?>">
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
                                      <?php
                                    while($row=mysqli_fetch_array($query)){
                                          /*$x = $row['supplier_id'];
                                          $cat = $row['cat_id'];
                                        $prod_id = $row['prod_id'];*/ 
                                        $prod_name = $row['prod_name'];
                                        $prod_qty = $row['prod_qty'];
                                        $base_price = $row['base_price'];
                                          
                                        $product_query=mysqli_query($con,"select * from product where prod_name = '$prod_name' and branch_id = '$branch' order by prod_name ")or die(mysqli_error());

                                        while($product_row=mysqli_fetch_array($product_query)){
                                                  $supplier_id = $product_row['supplier_id'];
                                                  $cat_id = $product_row['cat_id'];
                                                  $product_id = $product_row['prod_id'];
                                                  $sup=mysqli_query($con,"select supplier_name from supplier where supplier_id='$supplier_id'")or die(mysqli_error());                                                  
                                                  if (mysqli_num_rows($sup) > 0 ){
                                                      while($row2=mysqli_fetch_array($sup)){
                                                        $sup2 = $row2['supplier_name'];
                                                      }
                                                  }else{
                                                      $sup2 = "Supplier is erased";
                                                  }
                                                  // supplier name checker
                                                  $cat=mysqli_query($con,"select cat_name from category where cat_id='$cat_id'")or die(mysqli_error());
                                                                  if (mysqli_num_rows($cat) > 0 ){
                                                                      while($row3=mysqli_fetch_array($cat)){
                                                                            $cat2 = $row3['cat_name'];
                                                                      }
                                                                  }else{
                                                                      $cat2 = "Category is erased";
                                                                  }                                                       

                                                  $var_prod_qty = $product_row['prod_qty'];
                                                  $var_base_price = $product_row['base_price'];
                                                  ?>
                             
 
                                                          <div class="flex">
                                                            <p><?php echo $sup2; ?></p>
                                                            <p><?php echo $cat2; ?></p>
                                                            <p><?php echo $var_prod_qty; ?></p>
                                                            <p><?php echo $var_base_price; ?></p>
                                                             </div>
     
                                      <?php } ?>
                                                                                        
                                                        </div>
                                                      </div>
                                                    </div>
                                                    </div>
                                                  </div>
                                         
                                   
                                    </div> 
                                 <tr>
                                    <td><?php echo $prod_name;?></td>
                                    <td><?php echo $prod_qty;?></td>
                                    <td><?php echo number_format($base_price,2);?></td>
                                    <td>
                                       <a href="#updateordinance<?php echo $product_id;?>" data-target="#updateordinance<?php echo $product_id;?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                                       
                                    </td>
                                    <td><button class="btn btn-primary fkingbutton" data-attr="<?php echo $counter;?>">Show data</button></td>
                                 </tr>
                                 <div id="updateordinance<?php echo $row['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                   <label class="control-label col-lg-3" for="price">Serial #</label>
                                                   <div class="col-lg-9">
                                                      <input type="text" class="form-control" id="price" name="serial" value="<?php echo $row['serial'];?>" required>  
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label col-lg-3" for="name">Product Name</label>
                                                   <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['prod_id'];?>" required>  
                                                      <input type="text" class="form-control" id="name" name="prod_name" value="<?php echo $row['prod_name'];?>" required>  
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label col-lg-3" for="name">Description</label>
                                                   <div class="col-lg-9">
                                                      <input type="text" class="form-control" id="name" name="desc" value="<?php echo $row['prod_desc'];?>" required>  
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label col-lg-3" for="file">Distributor</label>
                                                   <div class="col-lg-9">
                                                      <select class="form-control select2" style="width: 100%;" name="supplier" required>
                                                         <option value="<?php echo $row['supplier_id'];?>"><?php echo $sup2;?></option>
                                                      </select>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label col-lg-3" >Company Name</label>
                                                   <div class="col-lg-9">
                                                      <select class="form-control select2" style="width: 100%;" name="category" required>
                                                         <option value="<?php echo $row['cat_id'];?>"><?php echo $cat2;?></option>
                                                         <?php
                                                            $queryc=mysqli_query($con,"select * from category order by cat_name")or die(mysqli_error());
                                                              while($rowc=mysqli_fetch_array($queryc)){
                                                              ?>
                                                         <option value="<?php echo $rowc['cat_id'];?>"><?php echo $rowc['cat_name'];?></option>
                                                         <?php }?>
                                                      </select>
                                                   </div>
                                                   <!-- /.input group -->
                                                </div>
                                                <!-- /.form group -->
                                                <div class="form-group">
                                                   <label class="control-label col-lg-3" for="price">Reorder</label>
                                                   <div class="col-lg-9">
                                                      <input type="number" class="form-control" id="price" name="reorder" value="<?php echo $row['reorder'];?>" required>  
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                   <label class="control-label col-lg-3" for="price">Picture</label>
                                                   <div class="col-lg-9"> 
                                                      <input type="hidden" class="form-control" id="price" name="image1" value="<?php echo $row['prod_pic'];?>"> 
                                                      <input type="file" class="form-control" id="price" name="image">  
                                                   </div>
                                                </div>
                                          </div>
                                          <br><br><br><br><br><br><br>
                                          <div class="modal-footer">
                                          <button class="btn btn-warning deleteButton" value="<?php echo $row['prod_id']?>">Delete</button>
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
                                    <th>Picture</th>
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
         })

        $(".modal").on('click',function(){
              $(this).fadeOut()
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