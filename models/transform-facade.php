<?php

  class TransformFacade extends DBConnection {

    public function fetchAllTransform() {
      $sql = $this->connect()->prepare("SELECT * FROM transform WHERE is_deleted = 0 ORDER BY transformed_on ASC");
      $sql->execute();
      return $sql;
    }

    public function addTransform($fromPLUId, $toPLUId, $yield, $transformedBy, $transformedOn, $updatedBy, $deletedBy, $isDeleted) {
      $sql = $this->connect()->prepare("INSERT INTO transform(from_plu_num, to_plu_num, yield, transformed_by, transformed_on, updated_by, deleted_by, is_deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $sql->execute([$fromPLUId, $toPLUId, $yield, $transformedBy, $transformedOn, $updatedBy, $deletedBy, $isDeleted]);
      return $sql;
    }

    public function fetchProcessByPLUNumAndDate($fromPLUNum, $date) {
      $sql = $this->connect()->prepare("SELECT * FROM transform WHERE from_plu_num = '$fromPLUNum' AND transformed_on = '$date'");
      $sql->execute();
      return $sql;
    }

  }

?>