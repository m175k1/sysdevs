<?php 
session_start();
$branch = $_SESSION['branch'];
include('../dist/includes/dbcon.php');


if($_POST['process']=='delete'){
  $serial = $_POST['serial'];
  if(! $con ) {
        die('Could not connect: ' . mysqli_error());
     }
     echo 'Connected successfully, ';
     $sql = " DELETE FROM masterfile WHERE master_id = '$serial'";
     
     if (mysqli_query($con, $sql)) {
          echo "Record deleted successfully ";
     } else {
        echo "Not successfully ";
     }
     mysqli_close($con);
}



if($_POST['process']=='modal_data'){
                    $prod_name = $_POST['prod_name'];
                    $branch = $_POST['branch'];
                                        $product_query=mysqli_query($con,"select * from product where prod_name = '$prod_name' and branch_id = '$branch' order by prod_name ")or die(mysqli_error());

                                        while($product_row=mysqli_fetch_array($product_query)){
                                                  
                                                  $product_id = $product_row['prod_id'];

                                                  $sql = "SELECT * FROM stockin WHERE (dist_id != '' OR com_id != '') AND prod_id = '$product_id' AND branch_id = '$branch'";
        $query = mysqli_query($con, $sql)or die(mysqli_error());

        while($row = mysqli_fetch_array($query))
        {
          $prod_price = $row['base_price'];
          $prod_dist = $row['dist_id'];
          $prod_com = $row['com_id'];

          $sql_dist = "SELECT * FROM supplier WHERE supplier_id = '$prod_dist'";
          $query_dist = mysqli_query($con, $sql_dist)or die(mysqli_error());

          if (mysqli_num_rows($query_dist) > 0 ){
                while($row2=mysqli_fetch_array($query_dist)){
                    $prod_supplier = $row2['supplier_name'];
                }
            }else{
                $prod_supplier = "Supplier is erased";
            }

          $sql_com = "SELECT * FROM category WHERE cat_id = '$prod_com'";
          $query_com = mysqli_query($con, $sql_com)or die(mysqli_error());

          if (mysqli_num_rows($query_com) > 0 ){
              while($row3=mysqli_fetch_array($query_com)){
                    $prod_company = $row3['cat_name'];
                }
            }else{
                $prod_company = "Category is erased";
            }  

            echo "<div class='flex'>";
            echo "<p>" . $prod_supplier . "</p>";
            echo "<p>" . $prod_company . "</p>";
            echo "<p>" . $prod_price . "</p>";
            echo "</div>";
        }
                                                  /*$sup=mysqli_query($con,"select supplier_name from supplier where supplier_id='$supplier_id'")or die(mysqli_error());                                                  
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
                                                  echo "<div class='flex'>";
                                                  echo "<p>" . $sup2 . "</p>";
                                                  echo "<p>" . $cat2 . "</p>";
                                                  echo "<p>" . $var_prod_qty . "</p>";
                                                  echo "<p>" . $var_base_price . "</p>";
                                                  echo "</div>";*/
                                                  }

        /*$prod_name = $_POST['prod_name'];
        $branch = $_POST['branch'];

        $sql = "SELECT * FROM stockin WHERE prod_id = '$prod_name' AND branch_id = '$branch'";
        $query = mysqli_query($con, $sql)or die(mysqli_error());

        while($row = mysqli_fetch_array($query))
        {
          $prod_price = $row['base_price'];
          $prod_dist = $row['dist_id'];
          $prod_com = $row['com_id'];

          $sql_dist = "SELECT * FROM supplier WHERE supplier_id = '$prod_dist'";
          $query_dist = mysqli_query($con, $sql_dist)or die(mysqli_error());

          if (mysqli_num_rows($query_dist) > 0 ){
                while($row2=mysqli_fetch_array($query_dist)){
                    $prod_supplier = $row2['supplier_name'];
                }
            }else{
                $prod_supplier = "Supplier is erased";
            }

          $sql_com = "SELECT * FROM category WHERE cat_id = '$prod_com'";
          $query_com = mysqli_query($con, $sql_com)or die(mysqli_error());

          if (mysqli_num_rows($query_com) > 0 ){
              while($row3=mysqli_fetch_array($query_com)){
                    $prod_company = $row3['cat_name'];
                }
            }else{
                $prod_company = "Category is erased";
            }  

            echo "<div class='flex'>";
            echo "<p>" . $prod_supplier . "</p>";
            echo "<p>" . $prod_company . "</p>";
            echo "<p>" . $prod_price . "</p>";
            echo "</div>";
        }*/
     
}









if($_POST['process']=='addproduct'){

  $name = $_POST['prod_name'];
  $price = 0;
  $desc = $_POST['prod_desc'];
  $supplier = $_POST['supplier'];
  $reorder = $_POST['reorder'];
  $category = $_POST['category'];
  $serial = $_POST['serial'];

  
  $query2=mysqli_query($con,"select * from product where prod_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
    $count=mysqli_num_rows($query2);

    if ($count>0)
    {
      echo "Not added";
    }
    else
    { 

        mysqli_query($con,"INSERT INTO product(prod_name,prod_price,prod_desc,cat_id,reorder,supplier_id,branch_id,serial)
      VALUES('$name','$price','$desc','$category','$reorder','$supplier','$branch','$serial')")or die(mysqli_error($con));

      echo "Success Add";
           
    }
}
  

if($_POST['process']=='categories'){
  $cat_name = $_POST['cat_name'];
  if(! $con ) {
        die('Could not connect: ' . mysqli_error());
     }
     echo 'Connected successfully, ';
     $sql = " DELETE FROM category WHERE cat_name = '$cat_name'";
     
     if (mysqli_query($con, $sql)) {
          echo "Record deleted successfully ";
     } else {
        echo "Not successfully ";
     }
     mysqli_close($con);

}

if($_POST['process']=='customer'){
  $cust_id = $_POST['cust_id']; 
  if(! $con ) {
        die('Could not connect: ' . mysqli_error());
     }
     echo 'Connected successfully, ';   
     
     $sql = " DELETE FROM customer WHERE cust_id = '$cust_id'";
     
     if (mysqli_query($con, $sql)) {
          echo "Record deleted successfully ";
     } else {
        echo "Not successfully ";
     }
     mysqli_close($con);
}

if($_POST['process']=='supplier'){
  $supplier_name = $_POST['supplier_name']; 
  if(! $con ) {
        die('Could not connect: ' . mysqli_error());
     }
     echo 'Connected successfully, ';   
     
     $sql = " DELETE FROM supplier WHERE supplier_name = '$supplier_name'";
     
     if (mysqli_query($con, $sql)) {
          echo "Record deleted successfully ";
     } else {
        echo "Not successfully ";
     }
     mysqli_close($con);

}

if($_POST['process']=='credito'){
  $supplier_name = $_POST['supplier_name']; 
  if(! $con ) {
        die('Could not connect: ' . mysqli_error());
     }
     echo 'Connected successfully, ';   
     
     $sql = " DELETE FROM creditor WHERE supplier_name = '$supplier_name'";
     
     if (mysqli_query($con, $sql)) {
          echo "Record deleted successfully ";
     } else {
        echo "Not successfully ";
     }
     mysqli_close($con);

}


if($_POST['process']=='creditor'){
  $cust_credit = $_POST['cust_credit']; 
  if(! $con ) {
        die('Could not connect: ' . mysqli_error());
     }
     echo 'Connected successfully, ';   
     
     $sql = "UPDATE customer SET credit_status = '' WHERE cust_id = '" . $cust_credit . "'";
     
     if (mysqli_query($con, $sql)) {
          echo "Record deleted successfully ";
     } else {
        echo "Not successfully ";
     }
     mysqli_close($con);

}




if($_POST['process']=='cust_history'){


  $cust_id = $_POST['cust_id'];


  $sql="
    SELECT * FROM customer a 
      LEFT JOIN sales b ON a.cust_id = b.cust_id 
      LEFT JOIN sales_details c ON b.sales_id = c.sales_id
      LEFT JOIN masterfile d ON c.prod_id = d.master_id
      WHERE a.cust_id = '".$cust_id."'
      AND a.branch_id = '$branch'
      ";
      echo "<table id='customerTable' class='table table-bordered table-striped' style='width:80%;margin-left:auto;margin-right:auto;'>";
        echo "<tr>";
        echo "<td>Customer</td>
            <td>Product</td>
            <td>Price</td>
            <td>Qty</td>
          <td>Subtotal</td>
            <td>Date</td>";
      echo "</tr>";     
  if ($result=mysqli_query($con,$sql)) 
    {
          if(mysqli_num_rows($result) == 0){
      echo "<tr><td colspan='5'><h1 style='text-align:center'>Not found</h1></td></tr>";
    }
    // Fetch one and one row
    $totalprice = 0;
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
      { 
      $price = $row['price'] * $row['qty'];
        echo "<tr>";
        echo "<td>" . $row['cust_first'] . "</td><td>" .$row['prod_name'] . "</td><td>" . $row['price'] .  "</td><td>" . $row['qty'].  "</td><td>" . $price.  "</td><td>" . $row['date_added'].  "</td>";
      echo "</tr>";
      
      $totalprice =$totalprice +  $price;
      }
    echo "<tr>";
      echo "<td></td><td></td><td></td><td>Total</td><td>P" . $totalprice.  "</td><td></td>";
    echo "</tr>";
    // Free result set
    mysqli_free_result($result);
  }
  echo "</table>";
  mysqli_close($con);


}



if($_POST['process']=='cat_history'){


  $cat_id = $_POST['cat_id'];

  $sql="
    SELECT *, a.base_price as base_fprice  FROM stockin a 
      LEFT JOIN product b ON a.prod_id = b.prod_id      
      LEFT JOIN category c ON b.cat_id = c.cat_id
      WHERE c.cat_id = '".$cat_id."'
      AND a.branch_id = '$branch'
      ";      
      
      echo "<table id='companyTable'class='table table-bordered table-striped' style='width:80%;margin-left:auto;margin-right:auto;'>";
        echo "<tr>";
        echo "<td>Product</td>
            <td>Price</td>
          <td>Qty</td>
          <td>Subtotal</td>
            <td>Date</td>";
      echo "</tr>"; 
      
  $totalprice = 0;
  
  if ($result=mysqli_query($con,$sql)) 
    {   
      if(mysqli_num_rows($result) == 0){
      echo "<tr><td colspan='5'><h1 style='text-align:center'>Not found</h1></td></tr>";
    }
    // Fetch one and one row
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
      {
      
    if($row['qty']>0){
    $price = $row['base_fprice'] * $row['qty'];
    $stockinsql="
      SELECT date FROM stockin            
        WHERE prod_id = '".$row['prod_id']."'
      ORDER BY date asc;
        ";
    $query2=mysqli_query($con,$stockinsql)or die(mysqli_error());   
        while($row2=mysqli_fetch_array($query2)){
          $stockdate = $row2['date']  ;
        }
        if(!isset($stockdate)){
          $stockdate = "";
        }
              if(!isset($stockdate)){
          $stockdate = "";
        }
        echo "<tr>";
        echo "<td>" .$row['prod_name'] . "</td><td>" . $row['base_fprice'] .  "</td><td>" . $row['qty'] .  "</td><td>" .  number_format($price,2) .  "</td><td>" . $stockdate.  "</td>";
      echo "</tr>";
      
      $totalprice =$totalprice +  $price;     
    }

      }
    echo "<tr>";
      echo "<td></td><td></td><td>Total</td><td>P" . number_format($totalprice,2).  "</td><td></td>";
    echo "</tr>";
    // Free result set
    mysqli_free_result($result);
  }
  echo "</table>";
  mysqli_close($con);
}


if($_POST['process']=='supplier_history'){

  $totalprice = 0;
  $supplier_id = $_POST['supplier_id'];
  
  $sql="
    SELECT *, a.base_price as base_fprice FROM stockin a 
      RIGHT JOIN product b ON a.prod_id = b.prod_id       
      LEFT JOIN supplier c ON b.supplier_id = c.supplier_id
      WHERE c.supplier_id = '".$supplier_id."'
      AND a.branch_id = '$branch'
      ";
      
      echo "<table id='distributorTable' style='width:80%;margin-left:auto;margin-right:auto;'>";
        echo "<tr>";
        echo "<td>Product</td>
            <td>Price</td>
            <td>Qty</td>
          <td>Subtotal</td>
            <td>Date</td>";
      echo "</tr>";     
  if ($result=mysqli_query($con,$sql)) 
    {   

    if(mysqli_num_rows($result) == 0){
      echo "<tr><td colspan='5'><h1 style='text-align:center'>Not found</h1></td></tr>";
    }
    // Fetch one and one row
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
      {
    if($row['qty']>0){
      $price = $row['base_fprice'] * $row['qty'];
          $stockinsql="
      SELECT * FROM stockin             
        WHERE prod_id = '".$row['prod_id']."'
      ORDER BY date asc;
        ";
    $query2=mysqli_query($con,$stockinsql)or die(mysqli_error());   
        while($row2=mysqli_fetch_array($query2)){
          $stockdate = $row2['date']  ;
        }   
        
          if(!isset($stockdate)){
          $stockdate = "";
        }
      

        echo "<tr>";
        echo "<td>" .$row['prod_name'] . "</td><td>" . $row['base_fprice'] .  "</td><td>" . $row['qty'] .  "</td><td>" . number_format($price,2) .  "</td><td>" . $stockdate.  "</td>";
      echo "</tr>";
      
      $totalprice =$totalprice +  $price;
    }

      }
    echo "<tr>";
      echo "<td></td><td></td><td>Total</td><td>P" . number_format($totalprice,2) ." </td><td></td>";
    echo "</tr>";
    // Free result set
    mysqli_free_result($result);
  }
  echo "</table>";
  mysqli_close($con);
}





if($_POST['process']=='stockout'){
  date_default_timezone_set('Asia/Manila');

  $date = date("Y-m-d H:i:s");
  list($prod_id, $com_id, $dist_id) = explode("|", $_POST['prod_id']);
  $qty = $_POST['qty'];

  $sql="  SELECT * FROM product 
      WHERE prod_id  = '".$prod_id."'";
      
  if ($result=mysqli_query($con,$sql)) 
    { 
    if(mysqli_num_rows($result) == 0){
      echo "<tr><td colspan='5'><h1 style='text-align:center'>Not found</h1></td></tr>";
    }
    // Fetch one and one row
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
      { 
        $product_name = $row['prod_name'];
      $base_price = $row["base_price"];
      if($row['prod_qty'] >= $qty){
          $prod_qty = $row['prod_qty'] - $qty;          
          $num = 0 - $qty;          
      mysqli_query($con,"UPDATE product SET prod_qty = '$prod_qty' where prod_id='$prod_id'") or die(mysqli_error($con));       
      mysqli_query($con,"INSERT INTO stockin(prod_id,qty,date,branch_id,base_price) VALUES('$prod_id','$num','$date','$branch','$base_price')")or die(mysqli_error($con));
        echo "Success";
        
      } 
      else{
        echo "Not enough items";
      }
      
    }   


  
    $prod_qty_q = mysqli_query($con,"select * from masterfile where prod_name = '$product_name'")or die(mysqli_error($con));      
      while ($rowsqty=mysqli_fetch_array($prod_qty_q))
      {
        $new_qty = $rowsqty['prod_qty'] - $qty;
      
        mysqli_query($con,"UPDATE masterfile SET prod_qty = '$new_qty' where prod_name='$product_name'") or die(mysqli_error($con));        
      }



  mysqli_free_result($result);
  }
  mysqli_close($con);
}


?>