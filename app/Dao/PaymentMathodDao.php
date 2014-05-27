<?php

namespace Dao;

class PaymentMethodDao extends \Wee\Dao {

    private function readRow($row) {
        $paymentMethod = new \Models\Payment();
        $paymentMethod->updateAttributes($row);
        $paymentMethod->setId($row['id']);

        return $paymentMethod;
    }

    private function getPaymentMethods($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[] = $this->readRow($row);
        }

        return $result;
    }

    private function getPaymentMethod($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
        $result = $this->readRow($row[0]);

        return $result;
    }
    
    public function getAllPaymentMethods() {
        $sql = 'SELECT * FROM payment_methods';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->getPaymentMethods($stmt);
    }
    
    public function getPaymentMethodById($id) {
        $sql = 'SELECT * FROM payment_methods WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $this->getPaymentMethod($stmt);
    }
}