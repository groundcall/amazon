<?php

namespace Dao;

class ProductDao extends \Wee\Dao {
    
    private function readRow($row) {
        $product = new \Models\Product();
        $product->updateAttributes($row);
        $product->setId($row['id']);
        $product->setCategory();
        $product->setImageByProductId();
        
        $product->setId($row['id']);
        $product->setTitle($row['title']);
        $product->setCategory_id($row['category_id']);
        $product->setPrice($row['price']);
        $product->setDescription($row['description']);
        $product->setShort_description($row['short_description']);
        $product->setStock($row['stock']);
        $product->setActive($row['active']);
        
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
    
    public function getAllProducts($start, $limit) {
        $sql = 'SELECT * FROM products ORDER BY id DESC LIMIT :start, :limit';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':start', $start, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
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
    
    public function getFilterProducts($title, $category_id, $stock, $start, $limit) {
       $sql = 'SELECT * FROM products WHERE title LIKE :title';
       if ($category_id != 0) {
           $sql .= ' AND category_id = :category_id';
       } 
       if ($stock != 0) {
           $sql .= ' AND stock >= :stock';
       }
       $sql .= ' ORDER BY id DESC LIMIT :start, :limit';
       $stmt = $this->getConnection()->prepare($sql);
       $stmt->bindValue(':title', '%' . $title . '%');
       if ($category_id != 0) {
           $stmt->bindValue(':category_id', $category_id);
       }
       if ($stock != 0) {
           $stmt->bindValue(':stock', 1);
       }
       $stmt->bindParam(':start', $start, \PDO::PARAM_INT);
       $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
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
    
    public function updateProduct($product) {
        $sql = "UPDATE products SET title = :title, category_id = :category_id, price = :price, description = :description, short_description = :short_description, stock = :stock WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $product->getId());
        $stmt->bindValue(':title', $product->getTitle());
        $stmt->bindValue(':category_id', $product->getCategory_id());
        $stmt->bindValue(':price', $product->getPrice());
        $stmt->bindValue(':description', $product->getDescription());
        $stmt->bindValue(':short_description', $product->getShort_description());
        $stmt->bindValue(':stock', $product->getStock());
        $stmt->execute();
    }
    
    public function getProductCount() {
        $sql = "SELECT COUNT(*) FROM products";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[0];
    }
    
<<<<<<< HEAD
    public function getFilteredProductCount($title, $category_id, $stock) {
        $sql = "SELECT COUNT(*) FROM products WHERE title LIKE :title";
        if ($category_id != 0) {
           $sql .= ' AND category_id = :category_id';
        } 
        if ($stock != 0) {
           $sql .= ' AND stock >= :stock';
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
        $result = $stmt->fetch();
        return $result[0];
=======
    public function getLastProducts($limit) {
        $sql = "SELECT * FROM products p INNER JOIN images i ON p.id = i.product_id ORDER BY p.id DESC LIMIT :limit";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $this->getProducts($stmt);
>>>>>>> THIS REALLY IS THE LAST COMMIT BEFORE BRANCHING
    }
    
    public function pairTitleIdExists($product) {
        $sql = 'SELECT * FROM products WHERE title = :title AND id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':title', $product->getTitle());
        $stmt->bindValue(':id', $product->getId());
        $stmt->execute();
        $result=$stmt->fetch();
        if ($result) {
            return true;
        }
        else {
            return false;
        }
    }
}
