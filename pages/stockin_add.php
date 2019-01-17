<?php
session_start();
include('../dist/includes/dbcon.php');
 
        $total_base_price = 0;
        $base_price = 0;
        $qty = 0;
        $base_price = 0;
        $product_base_price = 0;
        $total_base_price = 0;
        $total_qty = 0;
        $average_base_price = 0;
 
        list($name, $com_id, $dist_id) = explode("|", $_POST['prod_name']);
 
    $branch=$_SESSION['branch'];
    $id=$_SESSION['id'];
    $qty = $_POST['qty'];  
    $base_price = $_POST['base_price'];
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d H:i:s");
 
    $_base_price = $_POST['base_price'];
    $_qty = $_POST['qty'];
 
    $remarks="added $qty of $name";
   
 
    mysqli_query($con,"INSERT INTO stockin(prod_id,qty,date,branch_id,base_price, dist_id, com_id) VALUES('$name','$qty','$date','$branch','$base_price', '$dist_id', $com_id)")or die(mysqli_error($con));
 
 
    $average_base_price_query= mysqli_query($con,"select * from stockin where prod_id='$name' AND branch_id = '$branch'")or die(mysqli_error());
    while($base_price_row =mysqli_fetch_array($average_base_price_query)){
 
                          $total_qty = $base_price_row['qty'];
                          $base_price = $base_price_row['base_price'];
                          $total_qty = $total_qty + $qty;
                          $product_base_price = $base_price * $qty;
                          $total_base_price = $total_base_price + $product_base_price;
 
 
 
        }
 
    $getcurrent_price = mysqli_query($con, "SELECT * FROM product WHERE prod_id = '$name' AND branch_id = '$branch'")or die(mysqli_error());
    while($getcurrent_price_row = mysqli_fetch_array($getcurrent_price))
    {
        $prod_base_price = $getcurrent_price_row['base_price'];
        $prod_base_qty = $getcurrent_price_row['prod_qty'];
    }
   
    $total_qty = $prod_base_qty + $_qty;
 
    if ($prod_base_qty > 0)
    {
        $average_base_price = (($_base_price * $_qty) + ($prod_base_price * $prod_base_qty)) / ($total_qty);
    }
    else
    {
        $average_base_price = $base_price;
    }  
    //echo "<script>alert(".$average_base_price.")</script>";
   
    mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','$remarks','$date')")or die(mysqli_error($con));
 
 
    $sql="SELECT * from product where prod_id = '$name' and branch_id = '$branch'";
    $sup_query=mysqli_query($con,$sql)or die(mysqli_error());
    while($supp_row=mysqli_fetch_array($sup_query)){
        $id = $supp_row['prod_id'];    
        $real_name = $supp_row['prod_name'];
        $product_act_qty = $supp_row['prod_qty'];
        $new_qty = $product_act_qty + $qty;
    }
 
    mysqli_query($con,"UPDATE product SET prod_qty='$new_qty', base_price = '$average_base_price', prod_price = '0' where prod_id='$name' and branch_id='$branch'") or die(mysqli_error($con));
           
    $sqls="SELECT * from masterfile where prod_name = '$real_name' AND branch_id = '$branch'";
    $xxx=mysqli_query($con,$sqls)or die(mysqli_error());
    $count = mysqli_num_rows( $xxx );
 
    if( $count == 0 ){
        //
        //echo "<script>alert('0');</script>";
        mysqli_query($con,"INSERT INTO masterfile(prod_name, prod_qty, base_price,branch_id) VALUES('$real_name','$qty','$base_price','$branch')")or die(mysqli_error($con));
    }else{
        // get all product from product then total qty and price
        //echo "<script>alert('not 0');</script>";
 
        $prod_query= mysqli_query($con,"select * from masterfile where prod_name='$real_name' AND branch_id = '$branch'")or die(mysqli_error());
 
        while($prod_row =mysqli_fetch_array($prod_query)){
            $master_prod_qty = $prod_row['prod_qty'];
        }
 
 
        $masterfile_query= mysqli_query($con,"select * from product where prod_name='$real_name' AND branch_id = '$branch'")or die(mysqli_error());
        $total_qty = 0;
        $total_base_price = 0;
        while($base_price_row =mysqli_fetch_array($masterfile_query)){
 
                          $yqty = $base_price_row['prod_qty'];
                          $base_price = $base_price_row['base_price'];
                          $total_qty = $total_qty + $yqty;
                          $product_base_price = $base_price * $yqty;
                          $total_base_price = $total_base_price + $product_base_price;
                         
        }
        $ave_base_price = $total_base_price / $total_qty;
        $now_qty = $master_prod_qty + $qty;
 
 
        $xxx = mysqli_query($con,"UPDATE masterfile SET prod_qty='$now_qty', base_price = '$ave_base_price' where prod_name='$real_name' and branch_id='$branch'" ) or die(mysqli_error($con));
    }
 
    echo "<script type='text/javascript'>alert('Successfully added new stocks!');</script>";
    echo "<script>document.location='stockin.php'</script>";  
   
 
?>