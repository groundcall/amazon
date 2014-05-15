<?php

namespace Dao;

class ProductDao extends \Wee\Dao {
    
    private function readRow($row) {
        $product = new \Models\Product();
        $product->updateAttributes($row);
        $product->setCategory();
        return $product;
    }

    private function getProducts($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            $result[]=$this->readRow($row);
        }
        return $result;
    }
    
    private function getProduct($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null)
            return null;
        $result = $this->readRow($row[0]);
        return $result;
    }
    
    public function getAllProducts() {
        $sql = 'SELECT * FROM products ORDER BY id DESC';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->getProducts($stmt);
    }
    
    public function deleteProduct($product_id){
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> bindValue(':id', $product_id);
        $stmt->execute();
    }
    
    public function setProductActivity($product_id, $active) {
        $sql = "UPDATE products SET active = :activated WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $product_id);
        $stmt->bindValue(':activated', $active);
        $stmt->execute();
    }
    
    public function getFilterProducts($title, $category_id, $stock) {
       $sql = 'SELECT * FROM products WHERE title LIKE :title';
       if ($category_id != 0) {
           $sql .= ' AND category_id = :category_id';
       } 
       if ($stock != 0) {
           $sql .= ' AND stock >= :stock';
       }
       $sql .= ' ORDER BY id DESC';
       $stmt = $this->getConnection()->prepare($sql);
       $stmt->bindValue(':title', '%' . $title . '%');
       if ($category_id != 0) {
           $stmt->bindValue(':category_id', $category_id);
       }
       if ($stock != 0) {
           $stmt->bindValue(':stock', 1);
       }
       $stmt->execute();
       return $this->getProducts($stmt);
   }
   
    public function getProductByTitle($product) {
        $sql = 'SELECT * FROM products WHERE title = :title';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':title', $product->getTitle());
        $stmt->execute();
        return $this->getProduct($stmt);
    }
    
    public function addProduct($product) {
        $sql = "INSERT INTO products(title, category_id, price, description, short_description, stock) VALUES (:title, :category_id, :price, :description, :short_description, :stock)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':title', $product->getTitle());
        $stmt->bindValue(':category_id', $product->getCategory_id());
        $stmt->bindValue(':price', $product->getPrice());
        $stmt->bindValue(':description', $product->getDescription());
        $stmt->bindValue(':short_description', $product->getShort_description());
        $stmt->bindValue(':stock', $product->getStock());
        $stmt->execute();
    }
    
    public function getProductById($product_id) {
        $sql = 'SELECT * FROM products WHERE id = :product_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':product_id', $product_id);
        $stmt->execute();
        return $this->getProduct($stmt);
    }
    
    public function getLastInsertedProduct() {
        $sql = 'SELECT * FROM products WHERE id = LAST_INSERT_ID()';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $product = $this->getProduct($stmt);
        return $product->getId();
    }
}
