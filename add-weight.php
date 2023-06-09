<?php

	include('layout/header.php');
	include('db/connector.php');
	include('models/global-facade.php');
	include('models/user-facade.php');
  include('models/plu-facade.php');
  include('models/weight-facade.php');

	$globalFacade = new GlobalFacade;
	$userFacade = new UserFacade;
  $PLUFacade = new PLUFacade;
  $weightFacade = new WeightFacade;

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

  if (isset($_POST["add_weight"])) {
    $PLUNum = $_POST["plu_num"];
    $PLUS = $PLUFacade->fetchPLUByNum($PLUNum);
    foreach($PLUS as $PLU) { 
      $PLUDescription = $PLU['plu_desc'];
    }
    if (empty($_POST["fb_bi"])) {
      $oldFbBi = 0;
      $fbBi = 0;
    } else {
      $oldFbBi = $_POST["fb_bi"];
      $fbBi = $_POST["fb_bi"];
    }
    if (empty($_POST["delivery_cw"])) {
      $deliveryCw = 0;
    } else {
      $deliveryCw = $_POST["delivery_cw"];
    }
    $deliverySn = $_POST["delivery_sn"];
    if (empty($_POST["ps"])) {
      $ps = 0;
    } else {
      $ps = $_POST["ps"];
    }
    $biDPs = (($fbBi + $deliveryCw) - $ps);
    $ei = $_POST["ei"];
    if (empty($_POST["ei"])) {
      $ei = 0;
    } else {
      $ei = $_POST["ei"];
    }
    $addedBy = $fullName;
    $addedOn = date("Y-m-d");
    $updatedBy = '';
    $deletedBy = '';
    $isDeleted = 0;

    $verifyWeightNumFromDate = $weightFacade->verifyWeightNumFromDate($PLUNum, $addedOn);
    if ($verifyWeightNumFromDate > 0) {
      array_push($invalid, "PLU weight already been added for this day!");
    } else {
      $addWeight = $weightFacade->addWeight($PLUNum, $oldFbBi, $fbBi, $deliveryCw, $deliverySn, $ps, $biDPs, $ei, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted);
      if ($addWeight) {
        header("Location: weight.php?add_weight=Weight has been added successfully!");
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
        <li class="nav-item active">
          <a class="nav-link" href="weight.php">
            <i class="mdi mdi-scale menu-icon"></i>
            <span class="menu-title">Weight</span>
          </a>
        </li>
        <li class="nav-item">
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
                  <h2>Add Weight</h2>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="weight.php" class="text-decoration-none text-reset">Weight</a>&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Add Weight</p>
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
                <form class="forms-sample" action="add-weight.php" method="post">
                  <?php include('errors.php'); ?>
                  <div class="form-group">
                    <label for="pluDesc">PLU Description</label>
                    <select class="form-select" id="pluDesc" name="plu_num">
                      <?php
                        $PLUS = $PLUFacade->fetchAllPLU()->fetchAll();
                        foreach($PLUS as $PLU) { ?>
                        <option value="<?= $PLU["plu_num"] ?>"><?= $PLU["plu_desc"] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="fbBi">BI</label>
                    <input type="text" class="form-control" id="fbBi" placeholder="Enter BI" name="fb_bi">
                  </div>
                  <div class="form-group m-0">
                    <input type="checkbox" id="PLUDelivery">
                    <label for="flexCheckChecked">PLU has delivery</label>
                  </div>
                  <div class="form-group d-none" id="deliveryCwFormGroup">
                    <label for="deliveryCw">Delivery (CW)</label>
                    <input type="text" class="form-control" id="deliveryCw" placeholder="Enter Delivery CW" name="delivery_cw">
                  </div>
                  <div class="form-group d-none" id="deliverySnFormGroup">
                    <label for="deliverySn">Delivery (SN)</label>
                    <input type="text" class="form-control" id="deliverySn" placeholder="Enter Delivery SN" name="delivery_sn">
                  </div>
                  <div class="form-group">
                    <label for="ps">PS</label>
                    <input type="text" class="form-control" id="ps" placeholder="Enter Delivery PS" name="ps">
                  </div>
                  <div class="form-group">
                    <label for="ei">EI</label>
                    <input type="text" class="form-control" id="ei" placeholder="Enter EI" name="ei">
                  </div>
                  <button type="submit" class="btn btn-success me-2" name="add_weight">Add Weight</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include('layout/footer.php') ?>