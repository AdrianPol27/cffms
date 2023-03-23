<?php

  class GlobalFacade extends DBConnection {

    public function isSignedIn($userId) {
      if ($userId == 0 || $userId == NULL) {
        header("Location: signin.php");
      }
    }

  }

?>