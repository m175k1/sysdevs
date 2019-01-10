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
 
    $qxx=mysqli_query($con,"select * from product where prod_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
 
                                   
   
    while($row=mysqli_fetch_array($qxx)){
        $id = $row['prod_id'];
    }
 
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
 
        mysqli_query($con,"INSERT INTO product(prod_name,prod_qty,base_price,prod_desc,prod_pic,cat_id,reorder,supplier_id,branch_id)
            VALUES('$name','$qty','$base_price','$desc','$pic','$category','$reorder','$supplier','$branch')")or die(mysqli_error($con));
 
 
 
$sql="SELECT * from product where prod_name = '$name'";
$sup_query=mysqli_query($con,$sql)or die(mysqli_error());
while($supp_row=mysqli_fetch_array($sup_query)){
        $pid = $supp_row['prod_id'];
        $xprod_qty = $supp_row['prod_qty'];
        $xbase_price = $supp_row['base_price'];
         $totalprod_qty = $totalprod_qty + $xprod_qty;
         $totalbase_price = $totalbase_price + $xbase_price;
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
 
                          $qty = $base_price_row['prod_qty'];
                          $base_price = $base_price_row['base_price'];
                          $total_qty = $total_qty + $qty;
                          $product_base_price = $base_price * $qty;
                          $total_base_price = $total_base_price + $product_base_price;
                         
        }
        $ave_base_price = $total_base_price / $total_qty;
        $xxx = mysqli_query($con,"UPDATE masterfile SET prod_qty='$total_qty', base_price = '$ave_base_price' where prod_name='$name' and branch_id='$branch'" ) or die(mysqli_error($con));       
    }
 
        echo "<script type='text/javascript'>alert('Successfully added new stocks!');</script>";
    echo "<script>document.location='stockin.php'</script>";   
?>