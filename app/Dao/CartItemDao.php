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
    
    public function removeAllCartItemsByCartId($cart_id) {
        $sql = 'DELETE FROM cart_items WHERE cart_id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
    }
    
     public function addCartItemToCart($product_id, $cart_id){
        $sql = "INSERT INTO cart_items (cart_id, product_id, title, quantity, price)"
              .  "VALUES (:cart_id, :product_id, :title, :quantity, :price)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->bindValue(':product_id', $product_id);
        $stmt->bindValue(':title', "titlu de test");
        $stmt->bindValue(':quantity', 1);
        $stmt->bindValue(':price', 100);
        
        $stmt->execute();
    }
    
    public function deleteCartItemFromCart($cart_item_id) {
        $sql = 'DELETE FROM cart_items WHERE id = :cart_item_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_item_id', $cart_item_id);
        $stmt->execute();
    }
}

    