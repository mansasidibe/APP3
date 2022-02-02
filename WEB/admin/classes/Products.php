<?php 
session_start();
/**

CREATE TABLE `marches` (
`id` int(100) NOT NULL AUTO_INCREMENT,
 `nom_marche` text NOT NULL,
 `image_marche` text NOT NULL,
 `taille_marche` int(11) NOT NULL,
 `vendeur_marche` int(100) NOT NULL,
 `commune_marche` varchar(255) NOT NULL,
 PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
 	
 */
class Products
{
	
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}
 
	public function getProducts(){
		$q = $this->con->query("SELECT id, nom_marche, image_marche, taille_marche, vendeur_marche, commune_marche FROM marches");
		
		$marches = [];
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$marches[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['marches'] = $marches;
		}


		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function addProduct($nom_marche,
								$taille_marche,
								$vendeur_marche,
								$commune_marche,
								$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
			
			//print_r($file['size']);

			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/APP_2/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("INSERT INTO `marches`(`nom_marche`, `image_marche`, `taille_marche`, `vendeur_marche`, `commune_marche`) VALUES ('$nom_marche', '$uniqueImageName', '$taille_marche', '$vendeur_marche', '$commune_marche')");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Marché ajouté avec succès..!'];
					}else{
						return ['status'=> 303, 'message'=> 'erreur !'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'error état'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'];
		}
 
	}


	public function editProductWithImage($pid,
										$nom_marche,
										$taille_marche,
										$vendeur_marche,
										$commune_marche,
										$file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
			
			//print_r($file['size']);

			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/APP_2/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("UPDATE `marches` SET 
										`nom_marche` = '$nom_marche', 
										`taille_marche` = '$taille_marche', 
										`vendeur_marche` = '$vendeur_marche', 
										`commune_marche` = '$commune_marche', 	 
										`image_marche` = '$uniqueImageName', 
										WHERE id = '$pid'");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Marché modifier avec succès..!'];
					}else{
						return ['status'=> 303, 'message'=> 'erreur de la requete'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'error etat'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Image Invalide'];
		}

	}

	public function editProductWithoutImage($pid,
										$nom_marche,
										$taille_marche,
										$vendeur_marche,
										$commune_marche){

		if ($pid != null) {
			$q = $this->con->query("UPDATE `marches` SET 
										`nom_marche` = '$nom_marche', 
										`taille_marche` = '$taille_marche', 
										`vendeur_marche` = '$vendeur_marche', 
										`commune_marche` = '$commune_marche', 
										WHERE id = '$pid'");

			if ($q) {
				return ['status'=> 202, 'message'=> 'ok'];
			}else{
				return ['status'=> 303, 'message'=> 'erreur'];
			}
			
		}else{
			return ['status'=> 303, 'message'=> 'Id Invalide '];
		}
		
	}
	

	public function deleteProduct($pid = null){
		if ($pid != null) {
			$q = $this->con->query("DELETE FROM marches WHERE id = '$pid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'marché supprimé'];
			}else{
				return ['status'=> 202, 'message'=> 'erreur'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Id Invalide'];
		}

	}

}


if (isset($_POST['GET_PRODUCT'])) {
	if (isset($_SESSION['admin_id'])) {
		$p = new Products();
		echo json_encode($p->getProducts());
		exit();
	}
}

if (isset($_POST['add_product'])) {

	extract($_POST);
	if (!empty($product_name) 
	&& !empty($brand_id) 
	&& !empty($product_qty)
	&& !empty($product_desc)
	&& !empty($_FILES['product_image']['name'])) {
		

		$p = new Products();
		$result = $p->addProduct($product_name,
								$brand_id,
								$product_qty,
								$product_desc,
								$_FILES['product_image']);
		
		header("Content-type: application/json");
		echo json_encode($result);
		http_response_code($result['status']);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Champs vide']);
		exit();
	}
}

if (isset($_POST['edit_product'])) {

	extract($_POST);
	if (!empty($pid)
	&& !empty($e_product_name) 
	&& !empty($e_brand_id) 
	&& !empty($e_product_desc)
	&& !empty($e_product_qty) ) {
		
		$p = new Products();

		if (isset($_FILES['e_product_image']['name']) 
			&& !empty($_FILES['e_product_image']['name'])) {
			$result = $p->editProductWithImage($pid,
								$e_product_name,
								$e_brand_id,
								$e_product_desc,
								$e_product_qty,
								$_FILES['e_product_image']);
		}else{
			$result = $p->editProductWithoutImage($pid,
								$e_product_name,
								$e_brand_id,
								$e_product_desc,
								$e_product_qty);
		}

		echo json_encode($result);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Champs vide']);
		exit();
	}



	
}

if (isset($_POST['DELETE_PRODUCT'])) {
	$p = new Products();
	if (isset($_SESSION['admin_id'])) {
		if(!empty($_POST['pid'])){
			$pid = $_POST['pid'];
			echo json_encode($p->deleteProduct($pid));
			exit();
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Invalid product id']);
			exit();
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid Session']);
	}


}


?>