<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');


if($_POST['process']=='delete'){
	$serial = $_POST['serial'];
	if(! $con ) {
	      die('Could not connect: ' . mysqli_error());
	   }
	   echo 'Connected successfully, ';
	   $sql = " DELETE FROM product WHERE prod_id = '$serial'";
	   
	   if (mysqli_query($con, $sql)) {
	      	echo "Record deleted successfully ";
	   } else {
	   		echo "Not successfully ";
	   }
	   mysqli_close($con);

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
			LEFT JOIN product d ON c.prod_id = d.prod_id
			WHERE a.cust_id = '".$cust_id."'";
			echo "<table id='customerTable' style='width:80%;margin-left:auto;margin-right:auto;'>";
	    	echo "<tr>";
	    	echo "<td>Customer</td>
	    		  <td>Product</td>
	    		  <td>Price</td>
	    		  <td>Date</td>";
			echo "</tr>";			
	if ($result=mysqli_query($con,$sql)) 
	  {
		  		if(mysqli_num_rows($result) == 0){
			echo "<tr><td colspan='4'><h1 style='text-align:center'>Not found</h1></td></tr>";
		}
	  // Fetch one and one row
	  $totalprice = 0;
	  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	    {
	    	echo "<tr>";
	    	echo "<td>" . $row['cust_first'] . "</td><td>" .$row['prod_name'] . "</td><td>" . $row['price'] .  "</td><td>" . $row['date_added'].  "</td>";
			echo "</tr>";
			$price = $row['base_price'] * $row['prod_qty'];
			$totalprice =$totalprice +  $price;
	    }
		echo "<tr>";
	    echo "<td></td><td></td><td>Total</td><td>P" . $totalprice.  "</td>";
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
		SELECT * FROM category a 
			LEFT JOIN product b ON a.cat_id = b.cat_id 			
			WHERE a.cat_id = '".$cat_id."'";		
			
			echo "<table id='companyTable'style='width:80%;margin-left:auto;margin-right:auto;'>";
	    	echo "<tr>";
	    	echo "<td>Product</td>
	    		  <td>Price</td>
	    		  <td>Date</td>";
			echo "</tr>";	
	$totalprice = 0;
	if ($result=mysqli_query($con,$sql)) 
	  {		
  		if(mysqli_num_rows($result) == 0){
			echo "<tr><td colspan='3'><h1 style='text-align:center'>Not found</h1></td></tr>";
		}
	  // Fetch one and one row
	  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	    {
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
	    	echo "<td>" .$row['prod_name'] . "</td><td>" . $row['base_price'] .  "</td><td>" . $stockdate.  "</td>";
			echo "</tr>";
			$price = $row['base_price'] * $row['prod_qty'];
			$totalprice =$totalprice +  $price;
	    }
		echo "<tr>";
	    echo "<td></td><td>Total</td><td>P" . $totalprice.  "</td>";
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
		SELECT * FROM product a 
			LEFT JOIN supplier b ON a.supplier_id = b.supplier_id 			
			WHERE a.supplier_id = '".$supplier_id."'";		
			
			echo "<table id='distributorTable' style='width:80%;margin-left:auto;margin-right:auto;'>";
	    	echo "<tr>";
	    	echo "<td>Product</td>
	    		  <td>Price</td>
	    		  <td>Date</td>";
			echo "</tr>";			
	if ($result=mysqli_query($con,$sql)) 
	  {		

		if(mysqli_num_rows($result) == 0){
			echo "<tr><td colspan='3'><h1 style='text-align:center'>Not found</h1></td></tr>";
		}
	  // Fetch one and one row
	  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	    {
			
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
			

	    	echo "<tr>";
	    	echo "<td>" .$row['prod_name'] . "</td><td>" . $row['base_price'] .  "</td><td>" . $stockdate.  "</td>";
			echo "</tr>";
			$price = $row['base_price'] * $row['prod_qty'];
			$totalprice =$totalprice +  $price;
	    }
		echo "<tr>";
	    echo "<td></td><td>Total</td><td>P" . $totalprice.  "</td>";
		echo "</tr>";
	  // Free result set
	  mysqli_free_result($result);
	}
	echo "</table>";
	mysqli_close($con);
}





if($_POST['process']=='stockout'){

	$prod_id = $_POST['prod_id'];
	$qty = $_POST['qty'];
	echo "<h1>".$qty. "</h1>";
	echo "<h1>".$prod_id. "</h1>";

	$sql="	SELECT * FROM product 
			WHERE prod_id  = '".$prod_id."'";
			
	if ($result=mysqli_query($con,$sql)) 
	  {	
		if(mysqli_num_rows($result) == 0){
			echo "<tr><td colspan='3'><h1 style='text-align:center'>Not found</h1></td></tr>";
		}
	  // Fetch one and one row
	  while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	    {			
			if($row['prod_qty'] >= $qty){
					$prod_qty = $row['prod_qty'] - $qty;
			mysqli_query($con,"UPDATE product SET prod_qty = '$prod_qty' where prod_id='$prod_id'") or die(mysqli_error($con)); 
				echo "Success";
			} 
			else{
				echo "Not enough items";
			}
			
		}		
	mysqli_free_result($result);
	}
	mysqli_close($con);
}


?>