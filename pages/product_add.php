<?php
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');
 
   
    $branch=$_SESSION['branch'];  
   
    date_default_timezone_set('Asia/Manila');
 
    $date = date("Y-m-d H:i:s");  
 
 
    $name = $_POST['prod_name'];
    $base_price = $_POST['base_price'];
    $qty = $_POST['qty'];
    $desc = $_POST['prod_desc'];
    $supplier = $_POST['supplier_name'];
    $reorder = $_POST['reorder'];
    $category = $_POST['cat_name'];
    $id=$_SESSION['id'];
    $totalprod_qty = 0;
    $totalbase_price = 0;
    $total_qty = 0;
    $total_base_price = 0;
    $_qty = 0;
    $_price = 0;
 
    $qxx=mysqli_query($con,"select * from product where prod_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
 
 
        $count=mysqli_num_rows($qxx);
 
            if (isset($_FILES["image"]["name"])){
                $pic = $_FILES["image"]["name"];  
            } else{
                $pic = "";
            }
           
            if ($pic=="")
            {
                $pic="default.gif";
            }
            else
            {
                $pic = $_FILES["image"]["name"];
                $type = $_FILES["image"]["type"];
                $size = $_FILES["image"]["size"];
                $temp = $_FILES["image"]["tmp_name"];
                $error = $_FILES["image"]["error"];
           
                if ($error > 0){
                    die("Error uploading file! Code $error.");
                    }
                else{
                    if($size > 100000000000) //conditions for the file
                        {
                        die("Format is not allowed or file size is too big!");
                        }
                else
                      {
                    move_uploaded_file($temp, "../dist/uploads/".$pic);
                      }
                    }
            }  
 
    if ($count == 0)
    {
        mysqli_query($con,"INSERT INTO product(prod_name,prod_qty,base_price,prod_desc,prod_pic,cat_id,reorder,supplier_id,branch_id)
          VALUES('$name','$qty','$base_price','$desc','$pic','$category','$reorder','$supplier','$branch')")or die(mysqli_error($con));
 
        mysqli_query($con,"INSERT INTO masterfile(prod_name, prod_qty, base_price,branch_id) VALUES('$name','$qty','$base_price','$branch')")or die(mysqli_error($con));
 
        $get_id = mysqli_query($con, "SELECT * FROM product WHERE prod_name = '$name' AND branch_id='$branch'")or die(mysqli_error());
 
 
        while($get_id_row = mysqli_fetch_array($get_id))
        {
            //echo'<script>alert('. $get_id_row['prod_id'] .')</script>';
            $_id = $get_id_row['prod_id'];
        }
 
        mysqli_query($con,"INSERT INTO stockin(prod_id,qty,date,branch_id,base_price, dist_id, com_id) VALUES('$_id','$qty','$date','$branch','$base_price', '$supplier', '$category')")or die(mysqli_error($con));
            //echo'<script>alert('. '0' .')</script>';
    }
    else
    {
        //echo'<script>alert('. '>0' .')</script>';
        $query = mysqli_query($con, "select * from product where prod_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
 
        while($row_query = mysqli_fetch_array($query))
        {
            $_qty = $row_query['prod_qty'];
            $_price = $row_query['base_price'];
        }
 
        if ($_qty > 0)
        {
            $_total_qty = $_qty + $qty;
            $_total_price = ($_price * $_qty) + ($base_price * $qty);
 
            $_total_new = $_total_price / $_total_qty;
        }
        else
        {
            $_total_qty = $qty;
            $_total_price = $base_price;
            $_total_new = $total_price;
        }
 
        //echo $qty.'<br>'.$_qty.'<br><br>'.$base_price.'<br>'.$_price;
        //echo '<br><br>'.$_total_new;
 
        $_update = mysqli_query($con, "UPDATE product SET prod_qty = '$_total_qty', base_price = '$_total_new' WHERE prod_name = '$name' AND branch_id = '$branch'")or die(mysqli_error());
 
        mysqli_query($con,"UPDATE masterfile SET prod_qty='$_total_qty', base_price = '$_total_new' where prod_name='$name' and branch_id='$branch'") or die(mysqli_error($con));  
 
        $get_id = mysqli_query($con, "SELECT * FROM product WHERE prod_name = '$name' AND branch_id='$branch'")or die(mysqli_error());
 
 
        while($get_id_row = mysqli_fetch_array($get_id))
        {
            //echo'<script>alert('. $get_id_row['prod_id'] .')</script>';
            $_id = $get_id_row['prod_id'];
        }
 
        mysqli_query($con,"INSERT INTO stockin(prod_id,qty,date,branch_id,base_price, dist_id, com_id) VALUES('$_id','$qty','$date','$branch','$base_price', $supplier, $category)")or die(mysqli_error($con));
    }
               
             
    mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','Add a product','$date')")or die(mysqli_error($con));
 
        /*if ($count == 0)
        {
 
        mysqli_query($con,"INSERT INTO product(prod_name,prod_qty,base_price,prod_desc,prod_pic,cat_id,reorder,supplier_id,branch_id)
            VALUES('$name','$qty','$base_price','$desc','$pic','$category','$reorder','$supplier','$branch')")or die(mysqli_error($con));
        }
        else
        {
            // Count >= 1
            $sql="SELECT * from product where prod_name = '$name'";
            $sup_query=mysqli_query($con,$sql)or die(mysqli_error());
            while($supp_row=mysqli_fetch_array($sup_query)){
                    $pid = $supp_row['prod_id'];
                    $xprod_qty = $supp_row['prod_qty'];
                    $xbase_price = $supp_row['base_price'];
                     $totalprod_qty = $totalprod_qty + $xprod_qty;
                     $totalbase_price = $totalbase_price + $xbase_price;
            }
 
 
            $_prod_qty = $xprod_qty + $qty;
            $_base_price = $base_price + $xbase_price;
            $_new_base_price = $_base_price / $_prod_qty;
 
            $_update = mysqli_query($con, "UPDATE product SET prod_qty = '$_prod_qty', base_price = '$_new_base_price' WHERE prod_name = '$name'")or die(mysqli_error());  
           
        }
 
    $sqls="SELECT * from product where prod_name = '$name'";
    $sups_query=mysqli_query($con,$sqls)or die(mysqli_error());
 
    while($supps_row=mysqli_fetch_array($sups_query)){
                    $pid = $supps_row['prod_id'];
            }
 
    mysqli_query($con,"INSERT INTO stockin(prod_id,qty,date,branch_id,base_price) VALUES('$pid','$qty','$date','$branch','$base_price')")or die(mysqli_error($con));
               
             
    mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','Add a product','$date')")or die(mysqli_error($con));
             
             
    $sql="SELECT * from masterfile where prod_name = '$name' AND branch_id = '$branch'";      
    $xxx=mysqli_query($con,$sql)or die(mysqli_error());
    $count = mysqli_num_rows( $xxx );
 
 
    if( $count == 0 ){
        //
        mysqli_query($con,"INSERT INTO masterfile(prod_name, prod_qty, base_price,branch_id) VALUES('$name','$qty','$base_price','$branch')")or die(mysqli_error($con));
    }else{
 
        $masterfile_query= mysqli_query($con,"select * from product where prod_name='$name' AND branch_id = '$branch'")or die(mysqli_error());
        while($base_price_row =mysqli_fetch_array($masterfile_query)){
 
                          $_mqty = $base_price_row['prod_qty'];
                          $_mbase_price = $base_price_row['base_price'];
                          //$total_qty = $total_qty + $qty;
                          //$product_base_price = $base_price * $qty;
                          //$total_base_price = $total_base_price + $product_base_price;
                         
        }
 
        $_m_qty = $_mqty + $qty;
        $_m_base_price = $_mbase_price + $base_price;
        $_m_total = $_m_base_price / $_m_qty;
 
        $xxx = mysqli_query($con,"UPDATE masterfile SET prod_qty='$_m_qty', base_price = '$_m_total' where prod_name='$name' and branch_id='$branch'" ) or die(mysqli_error($con));      
    }*/
 
        echo "<script type='text/javascript'>alert('Successfully added new stocks!');</script>";
    echo "<script>document.location='stockin.php'</script>";  
?>