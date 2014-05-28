<?php

namespace Dao;

class CartDao extends \Wee\Dao {

    private function readRow($row) {
        $cart = new \Models\Cart();
        $cart->updateAttributes($row);
        $cart->setId($row['id']);
        $cart->setCart_Item();

        return $cart;
    }

    private function getCarts($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[] = $this->readRow($row);
        }
        return $result;
    }

    private function getCart($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null)
            return null;
        $result = $this->readRow($row[0]);
        return $result;
    }

    public function getAllCarts() {
        $sql = 'SELECT * FROM carts';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->getCategories($stmt);
    }

    public function getCartById($cart_id) {
        $sql = 'SELECT * FROM carts WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $cart_id);
        $stmt->execute();
        return $this->getCart($stmt);
    }

    public function getCartByUserId($user_id) {
        $sql = 'SELECT * FROM carts WHERE user_id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user_id);
        $stmt->execute();
        return $this->getCart($stmt);
    }

    public function setCartTotalByCartId($cart_id, $total) {
        $sql = 'UPDATE carts SET total = :total WHERE id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':total', $total);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
    }

    public function calculateCartTotal($cart_id) {
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItems = $cartItemDao->getAllCartItemsByCartId($cart_id);
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total = $total + $cartItem->getPrice();
        }
        $sql = 'UPDATE carts SET total = :total WHERE id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':total', $total, \PDO::PARAM_INT);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
        return $total;
    }

    public function getNumberOfItemsInCart($cart_id) {
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItems = $cartItemDao->getAllCartItemsByCartId($cart_id);
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total = $total + $cartItem->getQuantity();
        }

        return $total;
    }

    public function addCart($user_id) {
       
        $sql = 'INSERT INTO carts (user_id, date, active, total)'
                . 'VALUES (:user_id, :date, :active, :total)';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':date', date('Y-m-d H:i:s'));
        $stmt->bindValue(':active', 1);
        $stmt->bindValue(':total', 0);
        $stmt->execute();
    }

    public function getLastInsertedCart() {
        $sql = 'SELECT * FROM carts WHERE id = LAST_INSERT_ID()';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $cart = $this->getCart($stmt);

        return $cart->getId();
    }

    public function assignCartToUser() {
        $sql = 'UPDATE carts SET user_id = :user_id WHERE id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $_SESSION['id']);
        $stmt->bindValue(':cart_id', $_SESSION['cart_id']);
        $stmt->execute();
    }

    public function deleteCartById($cart_id) {
        $sql = 'DELETE FROM carts WHERE id = :cart_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':cart_id', $cart_id);
        $stmt->execute();
    }
     public function deactivateCartByUserId($user_id){
        $sql = 'UPDATE carts SET active = :active WHERE user_id = :user_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':active', 0);
        $stmt->execute();
    }
}
