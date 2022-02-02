<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>


      <div class="row">
      	<div class="col-10">
      		<h2>Gestion des communes</h2>
      	</div>
      	<!-- <div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_brand_modal" class="btn btn-primary btn-sm">Ajouter commune</a>
      	</div> -->
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nom de la commune</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="brand_list">
            <!-- <tr>
              <td>1</td>
              <td>ABC</td>
              <td><a class="btn btn-sm btn-info"></a><a class="btn btn-sm btn-danger">Delete</a></td>
            </tr> -->
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/brands.js"></script>