<?php

  class UserFacade extends DBConnection {

    public function fetchAllUser() {
      $sql = $this->connect()->prepare("SELECT * FROM user WHERE is_deleted = 0");
      $sql->execute();
      return $sql;
    }

    public function verifyUsernameAndPassword($username, $password) {
      $sql = $this->connect()->prepare("SELECT username, password FROM user WHERE username = ? AND password = ?");
      $sql->execute([$username, $password]);
      $count = $sql->rowCount();
      return $count;
    }

    public function addUser($fullName, $username, $password, $userType, $isLoggedIn, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted) {
      $sql = $this->connect()->prepare("INSERT INTO user(full_name, username, password, user_type, is_logged_in, added_by, added_on, updated_by, deleted_by, is_deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $sql->execute([$fullName, $username, $password, $userType, $isLoggedIn, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted]);
      return $sql;
    }

    public function updateUser($id, $fullName, $username, $password, $updatedBy, $updatedOn) {
      $sql = $this->connect()->prepare("UPDATE user SET full_name = '$fullName', username = '$username', password = '$password', updated_by = '$updatedBy', updated_on = '$updatedOn' WHERE id = $id");
      $sql->execute();
      return $sql;
    }

    public function deleteUser($id, $deletedBy, $deletedOn) {
      $sql = $this->connect()->prepare("UPDATE user SET deleted_by = '$deletedBy', deleted_on = '$deletedOn', is_deleted = 1 WHERE id = $id");
      $sql->execute();
      return $sql;
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