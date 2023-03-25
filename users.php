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
  if (isset($_GET["add_plu"])) {
		$addPLUError = $_GET["add_plu"];
    array_push($success, $addPLUError);
	}
  if (isset($_GET["update_plu"])) {
		$updatePLUError = $_GET["update_plu"];
    array_push($info, $updatePLUError);
	}
  if (isset($_GET["delete_plu"])) {
		$deletePLUError = $_GET["delete_plu"];
    array_push($invalid, $deletePLUError);
	}

	// If user is not signed in
	$globalFacade->isSignedIn($userId);

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
              <i class="mdi mdi-home menu-icon"></i>
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
                  <h2>Overview</h2>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="plu.php" class="text-decoration-none text-reset">Users</a>&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Overview</p>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a class="btn btn-success mt-2 mt-xl-0" href="add-user.php">Add User</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Users Information</p>
                <?php include('errors.php'); ?>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>User Type</th>
                        <th>Logged In</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $users = $userFacade->fetchAllUser()->fetchAll();
                        foreach($users as $user) { ?>
                      <tr>
                        <td><?= $user["full_name"] ?></td>
                        <td><?= $user["username"] ?></td>
                        <td><?= $user["password"] ?></td>
                        <td><?= $user["user_type"] ?></td>
                        <td>
                          <?php 
                            if ($user["is_logged_in"] == 0) {
                              echo '<p class="text-danger">No</p>';
                            } else {
                              echo '<p class="text-success">Yes</p>';
                            }
                          ?>
                        </td>
                        <!-- <td>
                          <a class="btn btn-info" href="view-plu.php?plu_num=<?= $PLU["plu_num"] ?>&plu_desc=<?= $PLU["plu_desc"] ?>&added_by=<?= $PLU["added_by"] ?>&added_on=<?= $PLU["added_on"] ?>&updated_by=<?= $PLU["updated_by"] ?>&updated_on=<?= $PLU["updated_on"] ?>&deleted_by=<?= $PLU["deleted_by"] ?>&deleted_on=<?= $PLU["deleted_on"] ?>"><i class="mdi mdi-eye"></i></a>
                          <a class="btn btn-primary text-white" href="update-plu.php?id=<?= $PLU["id"] ?>&plu_num=<?= $PLU["plu_num"] ?>&plu_desc=<?= $PLU["plu_desc"] ?>&added_by=<?= $PLU["added_by"] ?>&added_on=<?= $PLU["added_on"] ?>&updated_by=<?= $PLU["updated_by"] ?>&updated_on=<?= $PLU["updated_on"] ?>&deleted_by=<?= $PLU["deleted_by"] ?>&deleted_on=<?= $PLU["deleted_on"] ?>"><i class="mdi mdi-lead-pencil"></i></a>
                          <a class="btn btn-danger text-white" href="delete-plu.php?plu_num=<?= $PLU["plu_num"] ?>"><i class="mdi mdi-close-circle"></i></a>
                        </td>  -->
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include('layout/footer.php') ?>