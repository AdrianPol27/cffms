<?php 

  include('layout/header.php');
  include('db/connector.php');
  include('models/user-facade.php');

  $userFacade = new UserFacade;

  if (isset($_POST["signin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username)) {
      array_push($invalid, 'Username should not be empty!');
    } if (empty($password)) {
      array_push($invalid, 'Password should not be empty!');
    } else {

      $verifyUsernameAndPassword = $userFacade->verifyUsernameAndPassword($username, $password);
      $signIn = $userFacade->signIn($username, $password);

      if ($verifyUsernameAndPassword > 0) {
        while ($row = $signIn->fetch(PDO::FETCH_ASSOC)) {
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['full_name'] = $row['full_name'];
          $_SESSION['user_type'] = $row['user_type'];
          header('Location: index.php');
        }
      } else {
        array_push($invalid, "Incorrect username or password!");
      }

    }
  }

?>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img class="w-100" src="images/logo.png" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form action="signin.php" method="post" class="pt-3">
                <?php include('errors.php'); ?>
                <div class="form-group mb-2">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn w-100" name="signin">Sign In</button>
                </div>
              </form>
              <div class="my-2 d-flex justify-content-between align-items-center">
                <button type="submit" class="btn" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot password?</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- Modal -->
  <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Forgot Password?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="m-0">It seems that you forgot your password, kindly contact the IT Department for your password recovery.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<?php include('layout/footer.php') ?>