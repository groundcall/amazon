<?php

namespace Dao;

class AddressDao extends \Wee\Dao {

    private function readRow($row) {
        $address = new \Models\Address();
        $address->updateAttributes($row);
        $address->setId($row['id']);
        $address->setCountry($row['country_id']);

        return $address;
    }

//    private function getAddresses($stmt) {
//        $result = array();
//        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//        foreach ($rows as $row) {
//            $result[] = $this->readRow($row);
//        }
//
//        return $result;
//    }

    private function getAddress($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
        $result = $this->readRow($row[0]);

        return $result;
    }
 
    public function addAddress($address) {
        $sql = 'INSERT INTO addresses (address, city, country_id, firstname, lastname, email) VALUES '
                . '(:address, :city, :country_id, :firstname, :lastname, :email)';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':address', $address->getAddress());
        $stmt->bindValue(':city', $address->getCity());
        $stmt->bindValue(':country_id', $address->getCountry_id());
        $stmt->bindValue(':firstname', $address->getFirstname());
        $stmt->bindValue(':lastname', $address->getLastname());
        $stmt->bindValue(':email', $address->getEmail());
        $stmt->execute();   
    }
    
    public function getLastInsertedAddressId() {
        $sql = 'SELECT * FROM addresses WHERE id = LAST_INSERT_ID()';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $this->getAddress($stmt);
        return $result->getId();     
    }
    
    public function getAddressById($id) {
        $sql = 'SELECT * FROM addresses WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $this->getAddress($stmt);
    }
}