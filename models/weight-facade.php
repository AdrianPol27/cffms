<?php

  class WeightFacade extends DBConnection {

    public function fetchAllWeight() {
      $sql = $this->connect()->prepare("SELECT * FROM weight WHERE is_deleted = 0 ORDER BY added_on ASC");
      $sql->execute();
      return $sql;
    }

    public function fetchAllWeightByDate($date) {
      $sql = $this->connect()->prepare("SELECT * FROM weight WHERE is_deleted = 0 AND added_on = '$date'");
      $sql->execute();
      return $sql;
    }

    public function verifyWeightNumFromDate($PLUNum, $addedOn) {
      $sql = $this->connect()->prepare("SELECT * FROM weight WHERE plu_num = ? AND added_on = ? AND is_deleted = 0");
      $sql->execute([$PLUNum, $addedOn]);
      $count = $sql->rowCount();
      return $count;
    }

    public function addWeight($PLUNum, $oldFbBi, $fbBi, $deliveryCw, $deliverySn, $ps, $biDPs, $ei, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted) {
      $sql = $this->connect()->prepare("INSERT INTO weight(plu_num, old_fb_bi, fb_bi, delivery_cw, delivery_sn, ps, bi_d_ps, ei, added_by, added_on, updated_by, deleted_by, is_deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $sql->execute([$PLUNum, $oldFbBi, $fbBi, $deliveryCw, $deliverySn, $ps, $biDPs, $ei, $addedBy, $addedOn, $updatedBy, $deletedBy, $isDeleted]);
      return $sql;
    }

    public function updateWeight($id, $oldFbBi, $fbBi, $deliveryCw, $deliverySn, $ps, $biDPs, $ei, $updatedBy, $updatedOn) {
      $sql = $this->connect()->prepare("UPDATE weight SET old_fb_bi = '$oldFbBi', fb_bi = '$fbBi', delivery_cw = '$deliveryCw', delivery_sn = '$deliverySn', ps = '$ps', bi_d_ps = '$biDPs', ei = '$ei', updated_by = '$updatedBy', updated_on = '$updatedOn' WHERE id = '$id'");
      $sql->execute();
      return $sql;
    }

    public function deleteWeight($PLUNum, $deletedBy, $deletedOn) {
      $sql = $this->connect()->prepare("UPDATE weight SET deleted_by = '$deletedBy', deleted_on = '$deletedOn', is_deleted = 1 WHERE plu_num = $PLUNum");
      $sql->execute();
      return $sql;
    }

    public function updateIsTransformed($fromPLUNum) {
      $sql = $this->connect()->prepare("UPDATE weight SET is_transformed = '1' WHERE plu_num = $fromPLUNum");
      $sql->execute();
      return $sql;
    }

  }

?>