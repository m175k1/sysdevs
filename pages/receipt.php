<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Receipt | <?php include('../dist/includes/title.php');?></title>
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
    
   <style type="text/css">
      tr td{
        padding-top:-10px!important;
        border: 1px solid #000;
      }
      @media print {
          .btn-print {
            display:none !important;
          }
      }
      ::-webkit-scrollbar{
  width: 5px;
}
::-webkit-scrollbar-thumb{
  background:linear-gradient(white,green);
 
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
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">

          <section class="content">
            <div class="row">
        <div class="col-md-12">
              <div class="col-md-12">

              </div>
                
                <div class="box-body">

                  <!-- Date range -->
                  <form method="post" action="">
<?php
include('../dist/includes/dbcon.php');
$id=$_SESSION['id'];
$branch=$_SESSION['branch'];
    $queryb=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
  
        $rowb=mysqli_fetch_array($queryb);
        
?>      
                 
<?php

    $branch=$_SESSION['branch'];
    $query=mysqli_query($con,"select * from sales natural join customer where branch_id='$branch' order by sales_id desc LIMIT 1")or die(mysqli_error($con));
      
        $row=mysqli_fetch_array($query);
       
        $sales_id=$row['sales_id'];
        if(isset($sales_id)){          
        }else{
          echo "<h1>" . $sales_id . "</h1>";
        }
        $last=$row['cust_last'];
        $first=$row['cust_first'];
        $address=$row['cust_address'];
        $contact=$row['cust_contact'];
        $sid=$row['sales_id'];
        $due=$row['amount_due'];
        $discount=$row['discount'];
        $grandtotal=$due-$discount;
        $tendered=$row['cash_tendered'];
        $change=$row['cash_change'];

        $query1=mysqli_query($con,"select * from payment where sales_id='$sales_id'")or die(mysqli_error($con));
        $query2 = mysqli_query($con, 'SELECT MAX(sales_id) as or_no FROM sales')or die(mysqli_error($con));
        $row2 = mysqli_fetch_array($query2); 
        $row1=mysqli_fetch_array($query1);

?>    
        
          
                   <table class="table">
                    <thead>
                      <tr>
                        <th colspan="3"><h5><b><?php echo $rowb['branch_name'];?></b></h5></th>
                        <th><b><u>SALES INVOICE</u></b></th>
                      </tr>
                      <tr>
                        <th colspan="3"><h6><?php echo $rowb['branch_address'];?></h6></th>
                        <th><span style="font-size: 16px;color: red">
                          <?php 
              if ((intval($row2['or_no']) >= 0) && (intval($row2['or_no']) < 9)) {
                          ?>              
                          No. 000<?php echo $row2['or_no'];?></span></th>  
                          <?php } elseif((intval($row2['or_no']) >= 10) && (intval($row2['or_no']) < 99)){ ?>
                          No. 00<?php echo $row2['or_no'];?></span></th>
              <?php } elseif((intval($row2['or_no']) >= 100) && (intval($row2['or_no']) < 999)){ ?>
                          No. 0<?php echo $row2['or_no'];?></span></th>
                          <?php }?>
                      </tr>
                      <tr>
                        <th colspan="3"><h6>Contact #: <?php echo $rowb['branch_contact'];?></h6></th>
                        <th></th>
                      </tr>
                      
                    </thead>
                    <thead>

                      <tr>
                        <th>SOLD to</th>
                        <th><u><?php echo $last.", ".$first;?></u></th>
                        <th>Date</th>
                        <th><u><?php date_default_timezone_set('Asia/Manila'); echo date('F j, Y g:i:a '); ?>
                        </u></th>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <th><u><?php echo $address;?></u></th>
                        <th>TIN</th>
                        <th>________________________</th>
                      </tr>
                      <tr>
                        <th>Business Style</th>
                        <th>________________________</th>
                        <th>Terms</th>
                        <th>________________________</th>
                      </tr>
                    </thead>
                  </table>
                  <table class="table">
                    <thead>
                        
                      <tr style="border: solid 1px #000">
                        <th>QTY</th>
                        <th>UNIT</th>
                        <th>ARTICLES</th>
                        <th>Unit Price</th>
                        <th class="text-right">AMOUNT</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
    $query=mysqli_query($con,"select * from sales_details as a left join product as b on a.prod_id = b.prod_id where a.sales_id='$sid'")or die(mysqli_error($con));
      $grand=0;
    while($row=mysqli_fetch_array($query)){
        //$id=$row['temp_trans_id'];
        $total= $row['qty']*$row['price'];
        $grand=$grand+$total;
        
?>
                      <tr>
                        <td><?php echo $row['qty'];?></td>
                        <td>pc/s</td>
                        <td class="record"><?php echo $row['prod_name'];?></td>
                        <td><?php echo number_format($row['price'],2);?></td>
                        <td style="text-align:right"><?php echo number_format($total,2);?></td>
                                    
                      </tr>
            

<?php }?>         
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">Subtotal</td>
                        <td style="text-align:right"><?php echo number_format($grand,2);?></td>
                      </tr>
                    
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"><b>TOTAL AMOUNT DUE</b></td>
                        <td style="text-align:right"><b><?php echo number_format($grand-$discount,2);?></b></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">Cash Tendered</td>
                        <td style="text-align:right"><?php echo number_format($tendered,2);?></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"><b>Change</b></td>
                        <td style="text-align:right"><b><?php echo number_format($change,2);?></b></td>
                      </tr> 
                      <tr>
                        <th>Prepared by:</th>
                        <th></th>
                        <th></th>
                        <th>_________________________</th>
                      </tr> 
<?php
    $query=mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
 
?>                      
                      <tr>
                        <th><?php echo $row['name'];?></th>
                        <th></th>
                        <th></th>
                        <th>Customer's Signature</th>
                      </tr>  
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
        </div>  
        </form> 
                </div><!-- /.box-body -->
                <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
                <a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
           
          </div><!-- /.row -->
    
             
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
    </div><!-- ./wrapper -->
  
  
  <script type="text/javascript" src="autosum.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="../dist/js/jquery.min.js"></script>
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
   
  </body>
</html>
