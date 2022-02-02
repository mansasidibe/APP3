<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>


      <div class="row">
      	<div class="col-10">
      		<h2>Gestion des ville</h2>
      	</div>
      	<!-- <div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_category_modal" class="btn btn-primary btn-sm">Ajouter ville</a>
      	</div> -->
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              
            </tr>
          </thead>
          <tbody id="category_list">
          <img style="margin-left:100px;" src="image/civ.png" />
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/categories.js"></script>