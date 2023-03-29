<?php

  class PLUFacade extends DBConnection {

    public function fetchAllPLU() {
      $sql = $this->connect()->prepare("SELECT * FROM plu WHERE is_deleted = 0");
      $sql->execute();
      return $sql;
    }

    public function addPLU($PLUNum, $PLUDescription, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted) {
      $sql = $this->connect()->prepare("INSERT INTO plu(plu_num, plu_desc, added_by, added_on, updated_by, deleted_by, is_deleted) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $sql->execute([$PLUNum, $PLUDescription, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted]);
      return $sql;
    }

    public function updatePLU($PLUId, $PLUNum, $PLUDescription, $updatedBy, $updatedOn, $id) {
      $sql = $this->connect()->prepare("UPDATE plu SET plu_num = '$PLUNum', plu_desc = '$PLUDescription', updated_by = '$updatedBy', updated_on = '$updatedOn' WHERE id = '$id'");
      $sql->execute();
      return $sql;
    }

    public function deletePLU($PLUNum, $deletedBy, $deletedOn) {
      $sql = $this->connect()->prepare("UPDATE plu SET deleted_by = '$deletedBy', deleted_on = '$deletedOn', is_deleted = 1 WHERE plu_num = $PLUNum");
      $sql->execute();
      return $sql;
    }

    public function fetchPLUByNum($PLUNum) {
      $sql = $this->connect()->prepare("SELECT * FROM plu WHERE plu_num = ?");
      $sql->execute([$PLUNum]);
      return $sql;
    }

  }

?>