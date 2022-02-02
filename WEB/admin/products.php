<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Gestion des marchés</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Ajouter marchés</a>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nom</th>
              <th>Image</th>
              <th>Taille (m²)</th>           <!-- price -->
              <th>Nombre de vendeurs</th>    <!-- Quantity -->
              <th>Commune</th>                 <!-- categorie -->
              <th>Action</th>
            </tr> 
          </thead>
          <tbody id="product_list">
            <!-- <tr>
              <td>1</td>
              <td>ABC</td>
              <td>FDGR.JPG</td>
              <td>122</td>
              <td>eLECTRONCS</td>
              <td>aPPLE</td>
              <td><a class="btn btn-sm btn-info"></a><a class="btn btn-sm btn-danger">Delete</a></td>
            </tr> -->
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


<!-- Ajouter marché -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouveau marché</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-product-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Nom</label>
		        		<input type="text" name="product_name" class="form-control" placeholder="Entrez le nom du marché">
		        	</div>
        		</div>
            <div class="col-12">
        			<div class="form-group">
                <label>Taille</label>
		        		<input type="number" name="brand_id" class="form-control" placeholder="Entrez la taille du marché">
		        	</div>
        		</div>
            <div class="col-12">
        			<div class="form-group">
                <label>Vendeurs</label>
		        		<input type="number" name="product_qty" class="form-control" placeholder="Entrez le nombre de vendeurs">
		        	</div>
        		</div>
        		
        		<div class="col-12">
        			<div class="form-group">
		        		<label>commune</label>
		        		<textarea class="form-control" name="product_desc" placeholder="Quelle commune ?"></textarea>
		        	</div>
        		</div>
        		
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Photo du marché <small>(format: jpg, jpeg, png)</small></label>
		        		<input type="file" name="product_image" class="form-control">
		        	</div>
        		</div>
        		<input type="hidden" name="add_product" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-product">Ajouter</button>
        		</div>
        	</div>
        	
        </form>
      </div>
    </div>
  </div>
</div> 
<!-- fin-->

<!-- Modifier -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-product-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Nom</label>
                <input type="text" name="e_product_name" class="form-control" placeholder="Entrez le nom du marché">
              </div>
            </div>
            <div class="col-12"> 
              <div class="form-group">
                <label>Taille</label>
                <input type="text" name="e_brand_id" class="form-control" placeholder="Entrez la taille du marché">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Commune</label>
                <textarea class="form-control" name="e_product_desc" placeholder="Quelle commune ?"></textarea>
              </div>
            </div> 
            <div class="col-12">
              <div class="form-group">
                <label>Vendeurs</label>
                <input type="number" name="e_product_qty" class="form-control" placeholder="Entrez le nombre de vendeurs">
              </div>
            </div>
            
            <div class="col-12">
              <div class="form-group">
                <label>Photo <small></small></label>
                <input type="file" name="e_product_image" class="form-control">
                <img src="../product_images/1.0x0.jpg" class="img-fluid" width="50">
              </div>
            </div>
            <input type="hidden" name="pid">
            <input type="hidden" name="edit_product" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary submit-edit-product">Modifier</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>


<script type="text/javascript" src="./js/marche.js"></script> 
<!-- <script type="text/javascript" src="./js/products.js"></script> -->