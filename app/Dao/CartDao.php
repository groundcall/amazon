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

}
