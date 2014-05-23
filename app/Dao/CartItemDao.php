<?php

namespace Dao;

class CartItemDao extends \Wee\Dao {

    private function readRow($row) {
        $cartItem = new \Models\CartItem();
        $cartItem->updateAttributes($row);
        $cartItem->setId($row['id']);
        $cartItem->setProduct($row['product_id']);

        return $cartItem;
    }

    private function getCartItems($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[] = $this->readRow($row);
        }

        return $result;
    }

    private function getCartitem($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null)
            return null;
        $result = $this->readRow($row[0]);

        return $result;
    }
    
    public function getAllCartItemsByCartId($cart_id) {
        $sql = 'SELECT * FROM cart_items WHERE cart_id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
        return $this->getCartItems($stmt);
    }
}

    