<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

          <?php 


            $uri = $_SERVER['REQUEST_URI']; 
            $uriAr = explode("/", $uri);
            $page = end($uriAr);

          ?>


          <li class="nav-item">
            <a class="nav-link <?php echo ($page == '' || $page == 'index.php') ? 'active' : ''; ?>" href="index.php">
              <span data-feather="home"></span>
              Tableau de bord <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'products.php') ? 'active' : ''; ?>" href="products.php">
              <span data-feather="globe"></span>
              marchés
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'brands.php') ? 'active' : ''; ?>" href="brands.php">
              <span data-feather="package"></span>
              Communes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'categories.php') ? 'active' : ''; ?>" href="categories.php">
              <span data-feather="package"></span>
              Villes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'temperature.php') ? 'active' : ''; ?>" href="temperature.php">
              <span data-feather="activity"></span>
              Voir les capteurs
            </a>
          </li>
        </ul>

       
      </div>
    </nav>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Salut <?php echo $_SESSION["admin_name"]; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            Cette semaine
          </button>
          <div class="btn-group mr-3">
          <img src="./image/ok.gif" style="margin-left:15px;" width="30" height="30">
          </div>
        </div>
      </div>