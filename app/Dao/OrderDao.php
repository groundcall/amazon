<?php

namespace Dao;

class OrderDao extends \Wee\Dao {

    private function readRow($row) {
        $order = new \Models\Order();
        $order->updateAttributes($row);
        $order->setId($row['id']);
        $order->createUser($row['user_id']);
        $order->createCart($row['cart_id']);
        $order->createBilling_address();
        $order->createShipping_address();
        $order->createShipping_method();
        $order->createPayment_method();
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
    
    public function addOrder($order) {
        $sql = "INSERT INTO orders (user_id, cart_id, state_id, shipping_method_id, payment_method_id, date, confirmation_key)"
                . "VALUES (:user_id, :cart_id, :state_id, :shipping_method_id, :payment_method_id, :date, :confirmation_key)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $order->getUser_id());
        $stmt->bindValue(':cart_id', $order->getCart_id());
        $state_id = 0;
        $stmt->bindValue(':state_id', $state_id);
        $method = 1;
        $stmt->bindValue(':shipping_method_id', $method);
        $stmt->bindValue(':payment_method_id', $method);
        $stmt->bindValue(':date', date('Y-m-d H:i:s'));
        $stmt->bindValue(':confirmation_key', $order->getConfirmation_key());
        $stmt->execute();
    }
    
    public function getLastInsertedOrderId() {
        $sql = 'SELECT * FROM orders WHERE id = LAST_INSERT_ID()';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $this->getOrder($stmt);
        return $result->getId();     
    }
    
    public function updateBillingAddress($order) {
        $sql = "UPDATE orders SET billing_address_id = :billing_address_id WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $order->getId());
        $stmt->bindValue(':billing_address_id', $order->getBilling_address_id());
        $stmt->execute();
    }
    
    public function updateShippingAddress($order) {
        $sql = "UPDATE orders SET shipping_address_id = :shipping_address_id WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $order->getId());
        $stmt->bindValue(':shipping_address_id', $order->getShipping_address_id());
        $stmt->execute();
    }
    
    public function updateShippingMethod($order) {
        $sql = "UPDATE orders SET shipping_method_id = :shipping_method_id WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $order->getId());
        $stmt->bindValue(':shipping_method_id', $order->getShipping_method_id());
        $stmt->execute();
    }
    
    public function updatePaymentMethod($order) {
        $sql = "UPDATE orders SET payment_method_id = :payment_method_id WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $order->getId());
        $stmt->bindValue(':payment_method_id', $order->getPayment_method_id());
        $stmt->execute();
    }
    
    public function updateTotal($order) {
        $sql = "UPDATE orders SET total = :total WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $order->getId());
        $stmt->bindValue(':total', $order->getTotal());
        $stmt->execute();
    }
    
    public function updateOrderState($order) {
        $sql = "UPDATE orders SET state_id = :state_id WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $order->getId());
        $stmt->bindValue(':state_id', $order->getState_id());
        $stmt->execute();
    }
    
    public function finalizeOrder($order_id, $confirmation_key) {
        $sql = "UPDATE orders SET confirmation_key = :new_confirmation_key, state_id = :state_id WHERE id = :id AND confirmation_key = :confirmation_key";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $order_id);
        $stmt->bindValue(':confirmation_key', $confirmation_key);
        $new_confirmation_key = NULL;
        $stmt->bindValue(':new_confirmation_key', $new_confirmation_key, \PDO::PARAM_NULL);
        $state = 2;
        $stmt->bindValue(':state_id', $state);
        $stmt->execute();
    }
}