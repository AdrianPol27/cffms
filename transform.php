<?php

	include('layout/header.php');
	include('db/connector.php');
	include('models/global-facade.php');
	include('models/user-facade.php');+
  include('models/plu-facade.php');
  include('models/weight-facade.php');
  include('models/transform-facade.php');

	$globalFacade = new GlobalFacade;
	$userFacade = new UserFacade;
  $PLUFacade = new PLUFacade;
  $weightFacade = new WeightFacade;
  $transformFacade = new TransformFacade;

	$userId = 0;
  $date = date("Y-m-d");

	if (isset($_SESSION["user_id"])) {
		$userId = $_SESSION["user_id"];
	}
  if (isset($_SESSION["full_name"])) {
		$fullName = $_SESSION["full_name"];
	}
  if (isset($_SESSION["user_type"])) {
		$userType = $_SESSION["user_type"];
	}
  if (isset($_GET["add_transform"])) {
		$addTransformError = $_GET["add_transform"];
    array_push($success, $addTransformError);
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
                  <h2>Overview</h2>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<a href="transform.php" class="text-decoration-none text-reset">Weight</a>&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Overview</p>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a class="btn btn-success mt-2 mt-xl-0" href="add-transform.php">Add Transform</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Weight Information</p>
                <?php include('errors.php'); ?>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>PLU #</th>
                        <th>PLU Description</th>
                        <th>BI</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $transforms = $transformFacade->fetchAllTransform()->fetchAll();
                        foreach($transforms as $transform) { 
                          if ($transform["transformed_on"] != $date) { 
                            // Do nothing
                          } else {
                      ?>
                      <tr>
                        <td><?= $transform["to_plu_num"] ?></td>
                        <td>
                          <?php
                            $PLUNum = $transform["to_plu_num"];
                            $PLUS = $PLUFacade->fetchPLUByNum($PLUNum);
                            foreach($PLUS as $PLU) { 
                              echo $PLU['plu_desc'];
                            }?>
                        </td>
                        <td><?= number_format($transform["yield"], 2) ?></td>
                        <td>
                          <?php if ($userType == 'admin') { ?>
                            <a class="btn btn-info" href="view-weight.php?fb_bi=<?= $weight["fb_bi"] ?>&delivery_cw=<?= $weight["delivery_cw"] ?>&delivery_sn=<?= $weight["delivery_sn"] ?>&ps=<?= $weight["ps"] ?>&bi_d_ps=<?= $weight["bi_d_ps"] ?>&ei=<?= $weight["ei"] ?>&added_by=<?= $weight["added_by"] ?>&added_on=<?= $weight["added_on"] ?>&updated_by=<?= $weight["updated_by"] ?>&updated_on=<?= $weight["updated_on"] ?>&deleted_by=<?= $weight["deleted_by"] ?>&deleted_on=<?= $weight["deleted_on"] ?>"><i class="mdi mdi-eye"></i></a>
                            <a class="btn btn-primary text-white" href="update-weight.php?id=<?= $weight["id"]?>&fb_bi=<?= $weight["fb_bi"] ?>&delivery_cw=<?= $weight["delivery_cw"] ?>&delivery_sn=<?= $weight["delivery_sn"] ?>&ps=<?= $weight["ps"] ?>&bi_d_ps=<?= $weight["bi_d_ps"] ?>&ei=<?= $weight["ei"] ?>&added_by=<?= $weight["added_by"] ?>&added_on=<?= $weight["added_on"] ?>&updated_by=<?= $weight["updated_by"] ?>&updated_on=<?= $weight["updated_on"] ?>&deleted_by=<?= $weight["deleted_by"] ?>&deleted_on=<?= $weight["deleted_on"] ?>"><i class="mdi mdi-lead-pencil"></i></a>
                            <a class="btn btn-danger text-white" href="delete-weight.php?plu_num=<?= $weight["plu_num"] ?>&deleted_by=<?= $fullName ?>"><i class="mdi mdi-close-circle"></i></a> 
                          <?php } if ($userType == 'supervisor') { ?>
                            <a class="btn btn-primary text-white" href="update-weight.php?id=<?= $weight["id"]?>&fb_bi=<?= $weight["fb_bi"] ?>&delivery_cw=<?= $weight["delivery_cw"] ?>&delivery_sn=<?= $weight["delivery_sn"] ?>&ps=<?= $weight["ps"] ?>&bi_d_ps=<?= $weight["bi_d_ps"] ?>&ei=<?= $weight["ei"] ?>&added_by=<?= $weight["added_by"] ?>&added_on=<?= $weight["added_on"] ?>&updated_by=<?= $weight["updated_by"] ?>&updated_on=<?= $weight["updated_on"] ?>&deleted_by=<?= $weight["deleted_by"] ?>&deleted_on=<?= $weight["deleted_on"] ?>"><i class="mdi mdi-lead-pencil"></i></a>
                            <button class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target=".deleteModal"><i class="mdi mdi-close-circle"></i></button>
                          <?php } if ($userType == 'encoder') { ?>
                            <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target=".updateModal"><i class="mdi mdi-lead-pencil"></i></button>
                            <button class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target=".deleteModal"><i class="mdi mdi-close-circle"></i></button>
                          <?php } } ?>
                        </td> 
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

  <!-- Update Modal -->
  <div class="modal fade updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Error</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="m-0">You are not allowed to update this data, kindly contact your Supervisor or the IT Department for update.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Error</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="m-0">You are not allowed to delete this data, kindly contact the IT Department for deletion.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<?php include('layout/footer.php') ?>