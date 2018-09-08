<?php include 'header.php';
if(isset($_GET['id'])){
  $branch_id = $_GET['id'];
}else{
  $branch_id = 1;
}

?>
<link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico|Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
<style>
::-webkit-scrollbar{
  width: 12px;
}
::-webkit-scrollbar-thumb{
  background:linear-gradient(#000, green);
  border-radius: 6px;
}
.nav-md .container.body .right_col{
  background: url('../dist/img/admin.jpg') no-repeat center center fixed;
  background-size: cover;
  

  
}

.nav_menu{
  font-family: 'Comfortaa', cursive;
  border-radius: 20px;
  background-color: transparent;
  border:3px solid white;
  box-shadow: 0x 0px 200px 0px;
  color:orange;
  
}
.left_col{


  background: url('../dist/img/admin.jpg') no-repeat center center fixed;
  background-size: cover;
  
  

}
.nav_title{

  background: url('../dist/img/admin.jpg') no-repeat center center fixed;
  background-size: cover;
  
}
footer{
   background: url('../dist/img/admin.jpg') no-repeat center center fixed;
  background-size: cover;
  
}
.sidebar-footer{
   background: url('../dist/img/admin.jpg') no-repeat center center fixed;
  background-size: cover;
  
}
a{
  font-family: 'Comfortaa', cursive;
}
th{
  font-family: 'Comfortaa', cursive;
}
.profile_info{
  font-family: 'Comfortaa', cursive;
}
.x-panel{
  background-color: white;
  border-top-right-radius: 20px;
  border-top-left-radius: 20px;
  padding: 20px;
  border:1px solid black;
  box-shadow: 0px 0px 20px 0px;
  color:black;
}





</style>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include 'main_sidebar.php';?>

        <!-- top navigation -->
        <?php include 'top_nav.php';?>      <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main"> 
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">					
						<div class = "x-panel">
	             <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                        <th>Contact #</th>
                        <th>Application Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
    //$branch=$_SESSION['branch'];   
	
    $query=mysqli_query($con,"select * from customer where branch_id='$branch_id' and credit_status='pending'")or die(mysqli_error());
    $i=1;
    while($row=mysqli_fetch_array($query)){
      $cid=$row['cust_id'];
      $ci=$row['ci_remarks'];
      $payslip=$row['payslip']; if($payslip==1) $payslip1='checked';
      $valid_id=$row['valid_id'];if($valid_id==1) $valid_id1='checked';
      $cedula=$row['cedula'];if($cedula==1) $cedula1='checked';
      $cert=$row['cert'];if($cert==1) $cert1='checked';
      $income=$row['income'];if($income==1) $income1='checked';
?>
                      <tr>
                        <td><?php echo $row['cust_last'];?></td>
                        <td><?php echo $row['cust_first'];?></td>
                        <td><?php echo $row['cust_address'];?></td>
                        <td><?php echo $row['cust_contact'];?></td>
          
            <td><?php echo $row['credit_status'];//if ($row['balance']==0) 
                //echo "<span class='label label-danger'>inactive</span>";
                //else echo "<span class='label label-info'>active</span>";
              ?></td>
                        <td>
       
        <a href="#updateordinance<?php echo $row['cust_id'];?>" data-target="#updateordinance<?php echo $row['cust_id'];?>" data-toggle="modal" class="small-box-footer"><i class="glyphicon glyphicon-edit text-orange"></i></a>
        <a href="view_application.php?cid=<?php echo $row['cust_id'];?>" class="small-box-footer"><i class="glyphicon glyphicon-eye-open text-primary"></i></a>
            </td>
                      </tr>
        <div id="updateordinance<?php echo $row['cust_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Application Status</h4>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="post" action="application_update.php" enctype='multipart/form-data'>
                
        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Application Status</label>
          <div class="col-lg-9">
            <input type="hidden" name="id" value="<?php echo $cid;?>">
            <select class="form-control" id="id" name="status">  
              <option>Approved</option>
              <option>Disapproved</option>
              <option>Pending</option>
            </select>
          </div>
        </div>
             
        
        
              </div><br>
              <div class="modal-footer">
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
                        <th>Customer Last Name</th>
                        <th>Customer First Name</th>
                        <th>Address</th>
                        <th>Contact #</th>
                        <th>Application Status</th>
                        <th>Action</th>
                      </tr>           
                    </tfoot>
                  </table>
						</div>
				</div>
			</div>
        </div>		
        <!-- /page content -->
	
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Sales and Inventory System <a href="#"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

	<?php include 'datatable_script.php';?>
    <!-- /gauge.js -->
  </body>
</html>
