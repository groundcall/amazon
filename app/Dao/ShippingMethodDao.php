<?php

namespace Dao;

class ShippingMethodDao extends \Wee\Dao {

    private function readRow($row) {
        $shippingMethod = new \Models\ShippingMethod();
        $shippingMethod->updateAttributes($row);
        $shippingMethod->setId($row['id']);

        return $shippingMethod;
    }

    private function getShippingMethods($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[] = $this->readRow($row);
        }

        return $result;
    }

    private function getShippingMethod($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
        $result = $this->readRow($row[0]);

        return $result;
    }
    
    public function getAllShippingMethods() {
        $sql = 'SELECT * FROM shipping_methods';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->getShippingMethods($stmt);
    }
    
    public function getShippingMethodById($id) {
        $sql = 'SELECT * FROM shipping_methods WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $this->getShippingMethod($stmt);
    }
}