<?php

namespace Dao;

class EducationDao extends \Wee\Dao {
    
    private function readRow($row) {
        $education = new \Models\Education();
        $education->updateAttributes($row);
        $education->setId($row['id']);
        
        return $education;
    }

    private function getEducations($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            $result[]=$this->readRow($row);
        }
        return $result;
    }
    
    private function getEducation($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
        $result = $this->readRow($row[0]);
        return $result;
    }
    
    public function getAllEducations() {
        $sql = 'SELECT * FROM education';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->getEducations($stmt);
    }
}