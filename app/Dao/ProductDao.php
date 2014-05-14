<?php

namespace Dao;

class ProductDao extends \Wee\Dao {
    
    private function readRow($row) {
        $product = new \Models\Product();
        $product->updateAttributes($row);

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
        $sql = 'SELECT P.id, P.title, P.category_id, P.price, P.author_id, P.isbn, P.appereance_year, P.description, P.short_description, P.stock, P.active, C.label FROM products P INNER JOIN categories C ON P.category_id = C.id ORDER BY P.id DESC';
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
       $sql = 'SELECT P.id, P.title, P.category_id, P.price, P.author_id, P.isbn, P.appereance_year, P.description, P.short_description, P.stock, P.active, C.label FROM products P INNER JOIN categories C ON P.category_id = C.id WHERE title LIKE :title';
       if ($category_id != 0) {
           $sql .= ' AND category_id = :category_id';
       } 
       if ($stock != 0) {
           $sql .= ' AND stock > :stock';
       }
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
}
