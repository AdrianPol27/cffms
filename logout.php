<?php

  ob_start();
  session_start();

  include('db/connector.php');
  include('models/user-facade.php');

  $userFacade = new UserFacade;

  $userId = 0;

	if (isset($_SESSION["user_id"])) {
		$userId = $_SESSION["user_id"];
	}

  $isLoggedOut = $userFacade->isLoggedOut($userId);
  if ($isLoggedOut) {
    session_unset();
    session_destroy();
    header("Location: index.php");
  }

?>