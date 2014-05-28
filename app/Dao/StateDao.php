<?php

namespace Dao;

class StateDao extends \Wee\Dao {

    private function readRow($row) {
        $state = new \Models\State();
        $state->updateAttributes($row);
        $state->setId($row['id']);
        return $state;
    }

    private function getStates($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[] = $this->readRow($row);
        }
        return $result;
    }

    private function getState($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
        $result = $this->readRow($row[0]);
        return $result;
    }
    
    public function getStateById($id) {
        $sql = 'SELECT * FROM states WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $this->getState($stmt);
    }
}

