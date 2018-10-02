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
		  .main-footer	{
			display:none !important;
		  }
		  .box.box-primary {
			  border-top:none !important;
		  }
		  
          
      }
      .content{
        font-family: 'Comfortaa', cursive;
       
        border-radius: 15px;
        margin-top: 20px;
        border:1px solid black;
        box-shadow: 0px 1px 200px 20px;
        box-shadow: black;
        color:black;
      }
      
        .content-wrapper{
        border-top-left-radius: 100px;
        border-top-right-radius: 100px;
      }
      ::-webkit-scrollbar{
  width: 12px;
}
::-webkit-scrollbar-thumb{
  background:linear-gradient(#000, green);
  border-radius: 6px;
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
						
                  <table class="table table-bordered table-striped">
                    <thead>
					
                      <tr>
					              <th>Product Code</th> 
                        <th>Product Name</th>
                        <th>Supplier</th>                        
                        <th>Qty Left</th>
						
            						<th>Price</th>
            						<th>Total</th>
            						<th style="text-align:center">Reorder</th>
                       
                      </tr>
                    </thead>
                    <tbody>
<?php
		$branch=$_SESSION['branch'];
		
		
				$page = (isset($_SESSION['page'])) ? $_SESSION['page'] : 1;  
		$pagination = (isset($_GET['pagination'])) ? $_GET['pagination'] : 0;	
$grand=0;		
		if ($pagination == 0 ){			
		$pagination = 1;
		$query=mysqli_query($con,"select * from product natural join supplier where branch_id='$branch' order by prod_name desc limit 10")or die(mysqli_error());
		$querycounter = mysqli_query($con,"select * from product natural join supplier where branch_id='$branch' order by prod_name")or die(mysqli_error());
		$num_rows = mysqli_num_rows($querycounter);
		$num_page = (int)floor(abs($num_rows/10));
		
		while($row=mysqli_fetch_array($query)){
              $x = $row['supplier_id'];
              $cat = $row['cat_id'];
			  $prod_id = $row['prod_id'];
			  $base_price = $row['base_price'];
				
				$sup=mysqli_query($con,"select supplier_name from supplier where supplier_id='$x'")or die(mysqli_error());
                if (mysqli_num_rows($sup) > 0 ){
                    while($row2=mysqli_fetch_array($sup)){
                          $sup2 = $row2['supplier_name'];
                    }
                }else{
                    $sup2 = "Supplier is erased";
                }

				$cat=mysqli_query($con,"select cat_name from category where cat_id='$cat'")or die(mysqli_error());
                if (mysqli_num_rows($cat) > 0 ){
                    while($row3=mysqli_fetch_array($cat)){
                          $cat2 = $row3['cat_name'];
                    }
                }else{
                    $cat2 = "Category is erased";
                }		
		
			$total=$row['base_price']*$row['prod_qty'];
			$grand+=$total;
?>
                      <tr>
                        <td><?php echo $row['serial'];?></td>
                        <td><?php echo $row['prod_name'];?></td>
                        <td><?php echo $sup2;?></td>
                        <td><?php echo $row['prod_qty'];?></td>
						
						<td><?php echo $row['base_price'];?></td>
						<td><?php echo number_format($total,2);?></td>
						<td class="text-center"><?php if ($row['prod_qty']<=$row['reorder'])echo "<span class='badge bg-red'><i class='glyphicon glyphicon-refresh'></i>Reorder</span>"; else echo "<span class='badge bg-green'><i class='glyphicon glyphicon-refresh'></i> Good</span>"; ?></td>                       
                      </tr>

<?php }

}else{
	
		
		$pagination = (isset($_GET['pagination'])) ? $_GET['pagination'] : 0;
		$pagination = intval($pagination) + 1;		
		$pag_url = $pagination * 10;
		$query=mysqli_query($con,"select * from product natural join supplier where branch_id='$branch' order by prod_name desc limit 10 OFFSET $pag_url")or die(mysqli_error());
		$querycounter = mysqli_query($con,"select * from product natural join supplier where branch_id='$branch' order by prod_name desc")or die(mysqli_error());
		$num_rows = mysqli_num_rows($querycounter);
		$num_page = (int)floor(abs($num_rows/10));
		while($row=mysqli_fetch_array($query)){
              $x = $row['supplier_id'];
              $cat = $row['cat_id'];
			  $prod_id = $row['prod_id'];
			  $base_price = $row['base_price'];
			$sup=mysqli_query($con,"select supplier_name from supplier where supplier_id='$x'")or die(mysqli_error());
                if (mysqli_num_rows($sup) > 0 ){
                    while($row2=mysqli_fetch_array($sup)){
                          $sup2 = $row2['supplier_name'];
                    }
                }else{
                    $sup2 = "Supplier is erased";
                }

              $cat=mysqli_query($con,"select cat_name from category where cat_id='$cat'")or die(mysqli_error());
                if (mysqli_num_rows($cat) > 0 ){
                    while($row3=mysqli_fetch_array($cat)){
                          $cat2 = $row3['cat_name'];
                    }
                }else{
                    $cat2 = "Category is erased";
                }	




		
			$total=$row['base_price']*$row['prod_qty'];
			$grand+=$total;
?>
                      <tr>
                        <td><?php echo $row['serial'];?></td>
                        <td><?php echo $row['prod_name'];?></td>
                        <td><?php echo $sup2;?></td>
                        <td><?php echo $row['prod_qty'];?></td>
						
						<td><?php echo $row['base_price'];?></td>
						<td><?php echo number_format($total,2);?></td>
						<td class="text-center"><?php if ($row['prod_qty']<=$row['reorder'])echo "<span class='badge bg-red'><i class='glyphicon glyphicon-refresh'></i>Reorder</span>"; else echo "<span class='badge bg-green'><i class='glyphicon glyphicon-refresh'></i> Good</span>"; ?></td>                       
                      </tr>



<?php					  
				
				
}

		}
?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5">Total</th>
                        
						
						<th colspan="2">To follow</th>
						
                        
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
				  
				  <nav aria-label="Page navigation example">
<?php 	 
	if($pagination != 1){
		$pagination_prev = $pagination - 2;	
	}	
	$pagination_1 = $pagination -1;
	if( $num_page > 1 ){
		$pagination_2 = $pagination;
		if( $num_page > 2 ){
			$pagination_3 = $pagination + 1;
			if( $num_page > 3 ){
				$pagination_4 = $pagination + 2;
			}
		}
	}
		
	if($pagination <= $num_page){
		if(($pagination == $num_page) and ($remainder == 0)){
			
		}else{
			$pagination_next = $pagination;	
		}
	}		
	
?>
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="<?php if(isset($pagination_prev)){ echo 'inventory.php?pagination=' . $pagination_prev; } ?>">Previous</a></li>
    <li class="page-item"><a class="page-link" href="inventory.php?pagination=<?php echo $pagination_1; ?>"><?php if(isset($pagination_2)){echo $pagination_2; }else{ echo '1';} ?></a></li>
    <?php if(isset($pagination_2)){?><li class="page-item"><a class="page-link" href="inventory.php?pagination=<?php echo $pagination_2; ?>"><?php if(isset($pagination_3)){ echo $pagination_3; } else echo '2'; ?></a></li> <?php } ?>
    <li class="page-item"><a class="page-link" href="inventory.php?pagination=<?php echo $pagination_3; ?>"><?php if(isset($pagination_4)){ echo $pagination_4; } else echo '3'; ?></a></li>
    <li class="page-item"><a class="page-link" href="inventory.php?pagination=<?php echo $pagination_next; ?>">Next</a></li>
  </ul>
</nav>

                </div><!-- /.box-body -->

	      </div><!-- /.box -->
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
  </body>
</html>
