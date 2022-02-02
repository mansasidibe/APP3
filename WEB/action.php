<?php
session_start();
// require 'vendor/autoload.php';
$ip_add = getenv("REMOTE_ADDR");
include "db.php";


if(isset($_POST["page"])){
	$sql = "SELECT * FROM marches";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count/9);
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}

if(isset($_POST["getProduct"])){
	$limit = 9;
	if(isset($_POST["setPage"])){
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	}else{
		$start = 0;
	}
	$product_query = "SELECT * FROM marches LIMIT $start,$limit";
	$run_query = mysqli_query($con,$product_query);
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$pro_id    = $row['id'];
			$pro_cat   = $row['nom_marche'];
			$pro_brand = $row['image_marche'];
			$pro_title = $row['taille_marche'];
			$pro_price = $row['vendeur_marche'];
			$pro_image = $row['commune_marche'];
			
		}
	}
}



?>
