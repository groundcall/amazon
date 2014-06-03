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

    private function getCartItem($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
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
    
    public function addCartItemToCart($cart_item){
        $sql = "INSERT INTO cart_items (cart_id, product_id, title, quantity, price)"
                . "VALUES (:cart_id, :product_id, :title, :quantity, :price)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_id', $cart_item->getCart_id());
        $stmt->bindValue(':product_id', $cart_item->getProduct()->getId());
        $stmt->bindValue(':title', $cart_item->getProduct()->getTitle());
        $stmt->bindValue(':quantity', $cart_item->getQuantity());
        $price = $cart_item->getQuantity() * $cart_item->getProduct()->getPrice();
        $stmt->bindValue(':price', $price);
        $stmt->execute();
    }

    public function deleteCartItemFromCart($cart_item_id, $cart_id) {
        $sql = 'DELETE FROM cart_items WHERE id = :cart_item_id AND cart_id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_item_id', $cart_item_id);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
    }

    public function removeCartItemById($cart_item_id, $cart_id) {
        $sql = 'DELETE FROM cart_items WHERE id = :id AND cart_id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $cart_item_id);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
    }

    public function getCartItemById($cart_item_id) {
        $sql = 'SELECT * FROM cart_items WHERE id = :cart_item_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_item_id', $cart_item_id);
        $stmt->execute();
        return $this->getCartItem($stmt);
    }
    
    public function getCartItemByProductId($product_id) {
        $sql = 'SELECT * FROM cart_items WHERE product_id = :product_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':product_id', $product_id);
        $stmt->execute();
        return $this->getCartItem($stmt);
    }

    public function updateCartItem($cart_item) {
        $sql = 'UPDATE cart_items SET quantity = :quantity, price = :price WHERE id = :cart_item_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':quantity', $cart_item->getQuantity());
        $price = $cart_item->getProduct()->getPrice() * $cart_item->getQuantity();
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':cart_item_id', $cart_item->getId());
        $stmt->execute();
    }

    public function getCartItemByProductIdAndCartId($product_id, $cart_id) {
        $sql = 'SELECT * FROM cart_items WHERE product_id = :product_id AND cart_id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':product_id', $product_id);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
        return $this->getCartItem($stmt);
    }
    
    public function removeAllCartItems($cart_id) {
        $sql = 'DELETE FROM cart_items WHERE cart_id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
    }
}
