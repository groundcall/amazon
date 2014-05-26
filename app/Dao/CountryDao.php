<?php

namespace Dao;

class CountryDao extends \Wee\Dao {
    
    private function readRow($row) {
        $country = new \Models\Country();
        $country->updateAttributes($row);
        $country->setId($row['id']);
        
        return $country;
    }
    
    private function getCountries($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[]=$this->readRow($row);
        }
        return $result;
    }
    
    private function getCountry($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {            
            return null;
        }
        $result = $this->readRow($row[0]);
        return $result;
    }
    
    public function getCountryById($country_id) {
        $sql = 'SELECT * FROM countries WHERE id = :country_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':country_id', $country_id);
        $stmt->execute();
        return $this->getCountry($stmt);
    }
    
    public function getAllCountries() {
        $sql = 'SELECT * FROM countries';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->getCountries($stmt);
    }
}