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
        $order->setState($row['state_id']);
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
    
    public function getOrderByIdAndUser($id, $user) {
        $sql = 'SELECT * FROM orders WHERE id = :id AND user_id = :user_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':user_id', $user);
        $stmt->execute();
        return $this->getOrder($stmt);
    }
    
    public function addOrder($order) {
        $sql = "INSERT INTO orders (user_id, cart_id, state_id, shipping_method_id, payment_method_id, date)"
                . "VALUES (:user_id, :cart_id, :state_id, :shipping_method_id, :payment_method_id, :date)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $order->getUser_id());
        $stmt->bindValue(':cart_id', $order->getCart_id());
        $state_id = 0;
        $stmt->bindValue(':state_id', $state_id);
        $method = 1;
        $stmt->bindValue(':shipping_method_id', $method);
        $stmt->bindValue(':payment_method_id', $method);
        $stmt->bindValue(':date', date('Y-m-d H:i:s'));
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
    
    public function getLastOrdersByUser($user) {
        $sql = 'SELECT * FROM orders WHERE user_id = :user_id AND billing_address_id IS NOT NULL AND shipping_address_id IS NOT NULL ORDER BY date DESC LIMIT 5';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $user->getId());
        $state_id = 0;
//        $stmt->bindValue(':state_id', $state_id);
        $stmt->execute();
        return $this->getOrders($stmt);
    }
    
    public function getAllOrdersByUser($user_id, $start, $limit) {
        $sql = 'SELECT * FROM orders WHERE user_id = :user_id AND billing_address_id IS NOT NULL AND shipping_address_id IS NOT NULL ORDER BY date DESC LIMIT :start, :limit';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindParam(':start', $start, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $this->getOrders($stmt);
    }
    
    public function getOrdersCount($user_id) {
        $sql = "SELECT COUNT(*) FROM orders WHERE user_id = :user_id AND billing_address_id IS NOT NULL AND shipping_address_id IS NOT NULL";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[0];
    }
    
    public function getAllOrders($start, $limit) {
        $sql = 'SELECT * FROM orders WHERE billing_address_id IS NOT NULL AND shipping_address_id IS NOT NULL ORDER BY date DESC LIMIT :start, :limit';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':start', $start, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->getOrders($stmt);
    }
    
    public function getOrderCount() {
        $sql = "SELECT COUNT(*) FROM orders WHERE billing_address_id IS NOT NULL AND shipping_address_id IS NOT NULL";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result[0];
    }
    
    public function getFilterOrders($username, $state_id, $time, $start, $limit) {
        $sql = 'SELECT o.id, o.user_id, o.billing_address_id, o.shipping_address_id, o.cart_id, o.total, o.date, o.state_id, '
              . ' o.shipping_method_id, o.payment_method_id FROM orders o INNER JOIN users u ON ' 
              . ' o.user_id = u.id WHERE o.billing_address_id IS NOT NULL AND o.shipping_address_id IS NOT NULL AND u.username LIKE :username ';
        if ($state_id != 5) {
            $sql .= 'AND o.state_id = :state_id ';
        }
        if ($time != 'not') {
            $sql .= 'AND o.date >= NOW() - INTERVAL 1 ' . strtoupper($time) . ' ';
        }
        $sql .= ' ORDER BY o.id DESC LIMIT :start, :limit';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':username', '%' . $username . '%');
        if ($state_id != 5) {
            $stmt->bindParam(':state_id', $state_id, \PDO::PARAM_INT);
        }
        $stmt->bindParam(':start', $start, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $this->getOrders($stmt);
    }
    
    public function updateShippingAddressId($order, $shipping_address_id) {
        $sql = 'UPDATE orders SET shipping_address_id = :shipping_address_id WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':shipping_address_id', $shipping_address_id, \PDO::PARAM_INT);
        $stmt->bindParam(':id', $order->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function deleteOrderById($order_id) {
        $sql = 'DELETE FROM orders WHERE id = :order_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':order_id', $order_id);
        $stmt->execute();        
    }
    
    public function getFilteredOrdersCount($username, $state_id, $time) {
        $sql = 'SELECT COUNT(o.id) FROM orders o INNER JOIN users u ON ' 
              . ' o.user_id = u.id WHERE o.billing_address_id IS NOT NULL AND o.shipping_address_id IS NOT NULL AND u.username LIKE :username ';
        if ($state_id != 5) {
            $sql .= 'AND o.state_id = :state_id ';
        }
        if ($time != 'not') {
            $sql .= 'AND o.date >= NOW() - INTERVAL 1 ' . strtoupper($time) . ' ';
        }
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':username', '%' . $username . '%');
        if ($state_id != 5) {
            $stmt->bindParam(':state_id', $state_id, \PDO::PARAM_INT);
        }
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[0];
    }
}