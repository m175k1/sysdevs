<?php
session_start();
$id=$_SESSION['id'];  
include('../dist/includes/dbcon.php');
 
    $discount = $_POST['discount'];
    // $payment = $_POST['payment'];
    $amount_due = $_POST['amount_due'];
   
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d H:i:s");
    $cid=$_REQUEST['cid'];
    $branch=$_SESSION['branch'];
    $prod_qty_masterfile = 0;
    $total=$amount_due-$discount;
    echo "<h1>" . $cid . "</h1>";
        $tendered = $_POST['tendered'];
        $change = $_POST['change'];
 
    mysqli_query($con,"INSERT INTO sales(cust_id,user_id,discount,amount_due,total,date_added,modeofpayment,cash_tendered,cash_change,branch_id)
   VALUES('$cid','$id','$discount','$amount_due','$total','$date','cash','$tendered','$change','$branch')")or die(mysqli_error($con));
       
    $sales_id=mysqli_insert_id($con);
    $_SESSION['sid']=$sales_id;
    $query=mysqli_query($con,"select * from temp_trans where branch_id='$branch'")or die(mysqli_error($con));
        while ($row=mysqli_fetch_array($query))
        {
            $pid=$row['prod_id'];  
            $qty=$row['qty'];
            $price=$row['price'];
 
            $query_prod = mysqli_query($con, "SELECT * FROM masterfile WHERE master_id = '$pid'");
            while ($row_prod = mysqli_fetch_array($query_prod))
            {
                $base_price = $row_prod['base_price'];
            }
 
            $profit = ($price - $base_price) * $qty;
           
           
            mysqli_query($con,"INSERT INTO sales_details(prod_id,qty,price,sales_id, profit) VALUES('$pid','$qty','$price','$sales_id', '$profit')")or die(mysqli_error($con));
           
 
 
 
 
        /*  $prod_name_q=mysqli_query($con,"select * from product where prod_id = '$pid' and branch_id='$branch'")or die(mysqli_error($con));
            while ($prod_namex=mysqli_fetch_array($prod_name_q))
            {
                $prod_name =$prod_namex['prod_name'];      
            }
   
*/
            $prod_qty_q = mysqli_query($con,"select * from masterfile where master_id = '$pid' and branch_id='$branch'")or die(mysqli_error($con));        
            while ($rowsqty=mysqli_fetch_array($prod_qty_q))
            {
                $prod_name = $rowsqty['prod_name'];
                $prod_qty_masterfile = $rowsqty['prod_qty'];
            }
 
            $cart = 0;
            $products_id = '';
            $cont = 'yes';
            $products_query=mysqli_query($con,"select * from product where prod_name = '$prod_name' and branch_id='$branch' order by prod_id asc ")or die(mysqli_error($con));
            while ($products_row = mysqli_fetch_array($products_query))
            {
                $cart = $cart + $products_row['prod_qty'];
                $products_id = $products_row['prod_id'];
                if($cont == 'yes'){
                    if($qty <= $cart){
                        $new_total = $cart - $qty;
                        mysqli_query($con,"UPDATE product SET prod_qty='$new_total' where prod_id='$products_id' and branch_id='$branch'" ) or die(mysqli_error($con));
                        $cont = 'no';
                    }
                    else{
                        mysqli_query($con,"UPDATE product SET prod_qty='0' where prod_id='$products_id' and branch_id='$branch'" ) or die(mysqli_error($con));                
                    }
                }              
            }
 
            $new_qty = $prod_qty_masterfile - $qty;
 
            mysqli_query($con,"UPDATE masterfile SET prod_qty='$new_qty' where master_id='$pid' and branch_id='$branch'" ) or die(mysqli_error($con));
        }
 
 
 
 
       
        $query1=mysqli_query($con,"SELECT or_no FROM payment NATURAL JOIN sales WHERE modeofpayment =  'cash' ORDER BY payment_id DESC LIMIT 0 , 1")or die(mysqli_error($con));
 
            $row1=mysqli_fetch_array($query1);
                $or=$row1['or_no'];
 
                if ($or==0)
                {
                    $or=1;
                }
                else
                {
                    $or=intval($or)+1;
                }
 
                mysqli_query($con,"INSERT INTO payment(cust_id,user_id,payment,payment_date,branch_id,payment_for,due,status,sales_id,or_no)
   VALUES('$cid','$id','$total','$date','$branch','$date','$total','paid','$sales_id','$or')")or die(mysqli_error($con));
                   
       
        $result=mysqli_query($con,"DELETE FROM temp_trans where branch_id='$branch'")   or die(mysqli_error($con));
       
   
    echo "<script>document.location='receipt.php?cid=$cid'</script>";  
       
   
?>