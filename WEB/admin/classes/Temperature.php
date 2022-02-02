<?php 
session_start();
/**

CREATE TABLE `capteurs` (
`id` int(100) NOT NULL AUTO_INCREMENT,
 `nom_capteur` text NOT NULL,
 `image_capteur` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
 	
 */
class Capteur
{
	
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getProducts(){
		$q = $this->con->query("SELECT id, nom_capteur, image_capteur, valeur FROM capteurs");
		
		$capteurs = [];
		if ($q->num_rows > 0) {
			while($row = $q->fetch_assoc()){
				$capteurs[] = $row;
			}
			//return ['status'=> 202, 'message'=> $ar];
			$_DATA['capteurs'] = $capteurs;
		}


		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function addProduct($nom_capteur, $file){


		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
			
			//print_r($file['size']);

			if ($file['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/APP_2/product_images/".$uniqueImageName)) {
					
					$q = $this->con->query("INSERT INTO `capteurs`(`nom_capteur`, `image_capteur`) VALUES ('$nom_capteur', '$uniqueImageName')");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Capteur ajouté avec succès..!'];
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
										$nom_capteur,
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
					
					$q = $this->con->query("UPDATE `capteurs` SET 
										`nom_capteur` = '$nom_capteur',  	 
										`image_capteur` = '$uniqueImageName', 
										WHERE id = '$pid'");

					if ($q) {
						return ['status'=> 202, 'message'=> 'modifié avec succès..!'];
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
										$nom_capteur){

		if ($pid != null) {
			$q = $this->con->query("UPDATE `capteurs` SET 
										`nom_capteur` = '$nom_capteur' 
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
			$q = $this->con->query("DELETE FROM capteurs WHERE id = '$pid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'supprimé'];
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
		$p = new Capteur();
		echo json_encode($p->getProducts());
		exit();
	}
}

if (isset($_POST['add_product'])) {

	extract($_POST);
	if (!empty($product_name) 
	&& !empty($_FILES['product_image']['name'])) {
		
 
		$p = new Capteur();
		$result = $p->addProduct($product_name, $_FILES['product_image']);
		
		header("Content-type: application/json");
		echo json_encode($result);
		http_response_code($result['status']);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Champs vide.']);
		exit();
	}
}

if (isset($_POST['edit_product'])) {

	extract($_POST);
	if (!empty($pid)
	&& !empty($e_product_name) ) {
		
		$p = new Capteur();

		if (isset($_FILES['e_product_image']['name']) 
			&& !empty($_FILES['e_product_image']['name'])) {
			$result = $p->editProductWithImage($pid,
								$e_product_name,
								$_FILES['e_product_image']);
		}else{
			$result = $p->editProductWithoutImage($pid,
								$e_product_name);
		}

		echo json_encode($result);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Champs vide']);
		exit();
	}



	
}

if (isset($_POST['DELETE_PRODUCT'])) {
	$p = new Capteur();
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