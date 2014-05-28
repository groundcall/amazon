<?php

namespace Dao;

class OrderDao extends \Wee\Dao {

    private function readRow($row) {
        $order = new \Models\Order();
        $order->updateAttributes($row);
        $order->setId($row['id']);
        return $order;
    }

    private function getOrders($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[] = $this->readRow($row);
        }
        return $result;
    }

    private function getOrder($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
        $result = $this->readRow($row[0]);
        return $result;
    }
    
    public function getOrderById($id) {
        $sql = 'SELECT * FROM orders WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $this->getOrder($stmt);
    }
    
    public function addOrder($order){
        $sql = "INSERT INTO orders (user_id, shipping_method_id, payment_method_id)"
                . "VALUES (:user_id, :shipping_method_id, :payment_method_id)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $order->getUser_id());
        $stmt->bindValue(':shipping_method_id', $order->getShipping_method_id());
        $stmt->bindValue(':payment_method_id', $order->getPayment_method_id());
        $stmt->execute();
    }
    
    public function getLastInsertedOrderId() {
        $sql = 'SELECT * FROM orders WHERE id = LAST_INSERT_ID()';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $this->getOrder($stmt);
        return $result->getId();     
    }
    
}