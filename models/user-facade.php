<?php

  class UserFacade extends DBConnection {

    public function verifyUsernameAndPassword($username, $password) {
      $sql = $this->connect()->prepare("SELECT username, password FROM user WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      $count = $sql->rowCount();
      return $count;
    }

    public function isLoggedIn($userId) {
      $sql = $this->connect()->prepare("UPDATE user SET is_logged_in = 1 WHERE id = $userId");
      $sql->execute();
      return $sql;
    }

    public function isLoggedOut($userId) {
      $sql = $this->connect()->prepare("UPDATE user SET is_logged_in = 0 WHERE id = $userId");
      $sql->execute();
      return $sql;
    }

    public function signIn($username, $password) {
      $sql = $this->connect()->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      return $sql;
    }

  }

?>