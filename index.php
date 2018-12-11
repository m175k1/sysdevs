<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login - <?php include('dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="dist/css/sample1.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico|Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <style>
  .login-box-body, .register-box-body {
    box-shadow: none;
  }
  .login-box-body{
    border-radius: 0px;

  }
.btn-primary {
    background-color: #e43939;
    border-color: #ffffff;
    border-radius: 20px;
}


    .info {
      text-align: center;
      font-size: 11px;
      margin-top: 80px;
    }

    .info h1 {
      font-size: 15px;
    }
    p{
      color: #718093 !important;
      text-align: center;
      font-size: 15px;
      margin-bottom: 40px;
    }
    h1{
      font-size: 18px;
      font-weight: bold !important;
      text-align: center;
      color:grey;
    }
    .login-box-body, .register-box-body {
      border-radius: 5px;
    }
    .form-control{
      border-bottom:2px solid #dd4b39;


    }
    input[type="text"], input[type="password"] {
      border: none;
      border-bottom: 2px solid #dd4252;
      margin: 0 auto 20px auto;
    }
    .btn.btn-flat{
      border-radius: 20px;
    }

</style>
  <body>
     
    

       
    <div class="login-box">
      <div class="login-logo">
      </div><!-- /.login-logo -->
      <div class="login-box-body">  
         <h1>WELCOME</h1>
        <p>Sign in to log into the System</p>
        <form action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      <div class="form-group has-feedback">
            <select class="form-control select2" style="width:100%" name="branch" required>
                <?php
        include('dist/includes/dbcon.php');

                   $query3=mysqli_query($con,"select * from branch order by branch_name")or die(mysqli_error($con));
                      while($row3=mysqli_fetch_array($query3)){
                ?>
                    <option value="<?php echo $row3['branch_id'];?>"><?php echo $row3['branch_name'];?></option>
                  <?php }?>
                </select>
          </div>
          <div class="row">
      <div class="col-xs-6 pull-right">
        <button type="reset" class="btn btn-block btn-flat">Clear</button>
            </div><!-- /.col -->
      <div class="col-xs-6 pull-right">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" default>Sign In</button>
            </div><!-- /.col -->
    <div class="info">
    <i class="fa fa-paw"></i> Sales and Inventory System </h1>
    <p>©2018 All Rights Reserved SYDESO</p>
    </div>
          </div>
        </form>

        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
      
           
   
<!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    
  </body>
</html>
