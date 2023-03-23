<?php

	include('layout/header.php');
	include('db/connector.php');
	include('models/global-facade.php');
	include('models/user-facade.php');
  include('models/plu-facade.php');

	$globalFacade = new GlobalFacade;
	$userFacade = new UserFacade;
  $PLUFacade = new PLUFacade;

	$userId = 0;

	if (isset($_SESSION["user_id"])) {
		$userId = $_SESSION["user_id"];
	}
  if (isset($_SESSION["full_name"])) {
		$fullName = $_SESSION["full_name"];
	}
  if (isset($_SESSION["user_type"])) {
		$userType = $_SESSION["user_type"];
	}

	// If user is not signed in
	$globalFacade->isSignedIn($userId);

  if (isset($_POST["add_plu"])) {
    $PLUNum = $_POST["plu_num"];
    $PLUDescription = $_POST["plu_description"];
    $addedBy = $fullName;
    $addedOn = date("Y-m-d");
    $updatedBy = '';
    $deletedBy = '';
    $isDeleted = 0;

    if (empty($PLUNum)) {
      array_push($invalid, 'PLU Number should not be empty!');
    } if (empty($PLUDescription)) {
      array_push($invalid, 'PLU Description should not be empty!');
    } else {
      $addPLU = $PLUFacade->addPLU($PLUNum, $PLUDescription, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted);
      if ($addPLU) {
        header("Location: plu.php?add_plu=PLU has been added successfully!");
      }
    }
  }

?>

	<!-- partial:partials/_navbar.html -->
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
			<div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
				<a class="navbar-brand brand-logo" href="index.php"><img class="w-100" src="images/logo-1.png" alt="logo"/></a>
				<a class="navbar-brand brand-logo-mini" href="index.php"><img class="w-100" src="images/logo-mini.png" alt="logo"/></a>
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
					<span class="mdi mdi-sort-variant"></span>
				</button>
			</div>  
		</div>
		<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
			<ul class="navbar-nav navbar-nav-right">
				<li class="nav-item nav-profile dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
					<i class="mdi mdi-account text-primary"></i>
						<span class="nav-profile-name"><?= $fullName ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
						<a class="dropdown-item">
							<i class="mdi mdi-settings text-primary"></i>
							Settings
						</a>
						<a class="dropdown-item" href="logout.php">
							<i class="mdi mdi-logout text-primary"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>
			<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
				<span class="mdi mdi-menu"></span>
			</button>
		</div>
	</nav>

  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <?php if ($userType == 'admin') { ?>
          <li class="nav-item active">
            <a class="nav-link" href="plu.php">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">PLU</span>
            </a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="weight.php">
            <i class="mdi mdi-scale menu-icon"></i>
            <span class="menu-title">Weight</span>
          </a>
        </li>
      </ul>
    </nav>

     <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
              <div class="d-flex align-items-end flex-wrap">
                <div class="me-md-3 me-xl-5">
                  <h2>Add PLU</h2>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="plu.php" class="text-decoration-none text-reset">PLU</a>&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Add PLU</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <form class="forms-sample" action="add-plu.php" method="post">
                  <?php include('errors.php'); ?>
                  <div class="form-group">
                    <label for="pluNum">PLU #</label>
                    <input type="text" class="form-control" id="pluNum" placeholder="Enter PLU #" name="plu_num">
                  </div>
                  <div class="form-group">
                    <label for="pluDescription">PLU Description</label>
                    <input type="text" class="form-control" id="pluDescription" placeholder="Enter PLU Description" name="plu_description">
                  </div>
                  <button type="submit" class="btn btn-success me-2" name="add_plu">Add PLU</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include('layout/footer.php') ?>