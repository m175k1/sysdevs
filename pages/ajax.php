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
	   $sql = " DELETE FROM product WHERE serial = '$serial'";
	   
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




?>