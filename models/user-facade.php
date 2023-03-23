<?php

  class UserFacade extends DBConnection {

    public function verifyUsernameAndPassword($username, $password) {
      $sql = $this->connect()->prepare("SELECT username, password FROM user WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      $count = $sql->rowCount();
      return $count;
    }

    public function signIn($username, $password) {
      $sql = $this->connect()->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      return $sql;
    }

  }

?>