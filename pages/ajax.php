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
	      echo "Record deleted successfully";
	   } else {
	   }
	   mysqli_close($con);

}


?>