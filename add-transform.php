<?php

	include('layout/header.php');
	include('db/connector.php');
	include('models/global-facade.php');
	include('models/user-facade.php');
  include('models/plu-facade.php');
  include('models/weight-facade.php');
  include('models/transform-facade.php');

	$globalFacade = new GlobalFacade;
	$userFacade = new UserFacade;
  $PLUFacade = new PLUFacade;
  $weightFacade = new WeightFacade;
  $transformFacade = new TransformFacade;

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

  if (isset($_POST["add_transform"])) {
    $fromPLUNum = $_POST["from_plu"];
    $toPLUNum = $_POST["to_plu"];
    $yield = $_POST["yield"];
    $transformedBy = $fullName;
    $transformedOn = $addedOn = date("Y-m-d");
    $updatedBy = '';
    $deletedBy = '';
    $isDeleted = 0;

    if ($fromPLUNum == $toPLUNum) {
      array_push($invalid, 'PLU cannot be transformed to itself!');
    }
    if (empty($yield)) {
      array_push($invalid, 'Yield should not be empty!');
    } else {
      $addTransform = $transformFacade->addTransform($fromPLUNum, $toPLUNum, $yield, $transformedBy, $transformedOn, $updatedBy, $deletedBy, $isDeleted);
      if ($addTransform) {
        $weightFacade->updateIsTransformed($fromPLUNum);
        header("Location: transform.php?add_transform=PLU has been transformed successfully!");
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
          <li class="nav-item">
            <a class="nav-link" href="users.php">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Users</span> 
            </a>
          </li>
          <li class="nav-item">
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
        <li class="nav-item active">
          <a class="nav-link" href="transform.php">
            <i class="mdi mdi-sync menu-icon"></i>
            <span class="menu-title">Transform</span>
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
                  <h2>Add Transform</h2>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="transform.php" class="text-decoration-none text-reset">Transform</a>&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Add Transform</p>
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
                <form class="forms-sample" action="add-transform.php" method="post">
                  <?php include('errors.php'); ?>
                  <div class="form-group">
                    <label for="fromPLU">From PLU</label>
                    <select class="form-select" id="fromPLU" name="from_plu">
                      <?php
                        $date =  $date = date("Y-m-d");
                        $weights = $weightFacade->fetchAllWeightByDate($date) ->fetchAll();
                        foreach($weights as $weight) {
                          $PLUNum = $weight["plu_num"];
                          $PLUSByNum = $PLUFacade->fetchPLUByNum($PLUNum); 
                          foreach($PLUSByNum as $PLU) { 
                      ?>
                        <option value="<?= $PLU["plu_num"] ?>"><?= $PLU["plu_desc"] ?></option>
                      <?php } } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="toPLU">To PLU</label>
                    <select class="form-select" id="toPLU" name="to_plu">
                      <?php
                        $PLUS = $PLUFacade->fetchAllPLU()->fetchAll();
                        foreach($PLUS as $PLU) { ?>
                        <option value="<?= $PLU["plu_num"] ?>"><?= $PLU["plu_desc"] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="yield">Yield</label>
                    <input type="text" class="form-control" id="yield" placeholder="Enter Yield" name="yield">
                  </div>
                  <button type="submit" class="btn btn-success me-2" name="add_transform">Add Transform</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include('layout/footer.php') ?>