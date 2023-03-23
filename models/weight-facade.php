<?php

  class WeightFacade extends DBConnection {

    public function fetchAllWeight() {
      $sql = $this->connect()->prepare("SELECT * FROM weight WHERE is_deleted = 0 ORDER BY added_on ASC");
      $sql->execute();
      return $sql;
    }

    public function addWeight($PLUNum, $PLUDescription, $fbBi, $deliveryCw, $deliverySn, $ps, $biDPs, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted) {
      $sql = $this->connect()->prepare("INSERT INTO weight(plu_num, plu_desc, fb_bi, delivery_cw, delivery_sn, ps, bi_d_ps, added_by, added_on, updated_by, deleted_by, is_deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $sql->execute([$PLUNum, $PLUDescription, $fbBi, $deliveryCw, $deliverySn, $ps, $biDPs, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted]);
      return $sql;
    }

    public function updateWeight($id, $fbBi, $deliveryCw, $deliverySn, $ps, $biDPs, $ei, $updatedBy, $updatedOn) {
      $sql = $this->connect()->prepare("UPDATE weight SET fb_bi = '$fbBi', delivery_cw = '$deliveryCw', delivery_sn = '$deliverySn', ps = '$ps', bi_d_ps = '$biDPs', ei = '$ei', updated_by = '$updatedBy', updated_on = '$updatedOn' WHERE id = '$id'");
      $sql->execute();
      return $sql;
    }

    public function deleteWeight($PLUNum) {
      $sql = $this->connect()->prepare("UPDATE weight SET is_deleted = 1 WHERE plu_num = $PLUNum");
      $sql->execute();
      return $sql;
    }

  }

?>