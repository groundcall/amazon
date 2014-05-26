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

        $product->setImageByProductId();
        $product->setCategory();

        return $product;
    }

    private function getProducts($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[] = $this->readRow($row);
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

    public function deleteProduct($product_id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $product_id);
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

    public function getFilterProducts3($filtering, $count) {
        if ($filtering->getCategory_id()) {
            if ($filtering->getCategory_id() == '0') {
                $category = '';
            } else {
                $category = ' AND category_id = ' . $filtering->getCategory_id();
            }
        } else {
            $category = '';
        }
        if ($filtering->getStock()) {
            if ($filtering->getStock() == 1) {
                $stock = 1;
            } else {
                $stock = 0;
            }
            $stock = ' AND stock >= ' . $stock;
        } else {
            $stock = '';
        }
        if ($filtering->getPrice()) {
            if ($_GET['price'] == 1) {
                $price_min = 0;
                $price_max = 49.99;
            }
            if ($_GET['price'] == 2) {
                $price_min = 49.99;
                $price_max = 99.99;
            }
            if ($_GET['price'] == 3) {
                $price_min = 99.99;
                $price_max = PHP_INT_MAX;
            }
            $price = ' AND price BETWEEN ' . $price_min . ' AND ' . $price_max;
        } else {
            $price = '';
        }
        if ($filtering->getSort() && $filtering->getOrder()) {
            $sort = ' ORDER BY ' . $filtering->getSort();
            $order = ' ' . $filtering->getOrder();
        } else {
            $sort = '';
            $order = '';
        }
        if ($filtering->getStart() && $filtering->getLimit()){
            $limit = ' LIMIT ' . $filtering->getStart() . ', ' . $filtering->getLimit();
        }
        else{
            if ($count == 'count'){
                $limit = '';
            }
            else {
                $limit = ' LIMIT 0,' . $filtering->getLimit();
            }
        }

        $sql = 'Select * FROM products WHERE title LIKE :title' . $category . $stock . $price . $sort . $order . $limit;
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':title', '%' . $filtering->getTitle() . '%');
        $stmt->execute();

        if ($count == 'count') {
            $result = $this->getProducts($stmt);
            return sizeof($result);
        } else {
            return ($this->getProducts($stmt));
        }
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
    }

    public function getLastProducts($limit) {
        $sql = "SELECT p.id, p.title, p.category_id, p.price, p.author_id, p.isbn, p.appereance_year, p.description, p.short_description,"
                . " p.stock, p.active, i.path, i.filename, i.product_id FROM products p INNER JOIN images i ON p.id = i.product_id "
                . " WHERE p.active = :active AND p.stock > 0 ORDER BY p.id DESC LIMIT :limit";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $active = 1;
        $stmt->bindValue(':active', $active, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->getProducts($stmt);
    }

    public function pairTitleIdExists($product) {
        $sql = 'SELECT * FROM products WHERE title = :title AND id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':title', $product->getTitle());
        $stmt->bindValue(':id', $product->getId());
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategoryByProductId($product_id) {
        $sql = "SELECT category_id FROM products WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $product_id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[0];
    }

    public function getRandomProducts($product_id, $limit) {
        $sql = "SELECT p.id, p.title, p.category_id, p.price, p.author_id, p.isbn, p.appereance_year, p.description, p.short_description,"
                . " p.stock, p.active, i.path, i.filename, i.product_id FROM products p INNER JOIN images i ON p.id = i.product_id "
                . " WHERE p.id <> :id AND category_id = :category_id AND p.active = :active ORDER BY RAND() LIMIT :limit";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $product_id, \PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $this->getCategoryByProductId($product_id), \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $active = 1;
        $stmt->bindValue(':active', $active, \PDO::PARAM_INT);
        $stmt->execute();
        return $this->getProducts($stmt);
    }

    public function getProductsByCategoryId($category_id) {
        $sql = 'SELECT * FROM products WHERE category_id = :category_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':category_id', $category_id, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->getProducts($stmt);
    }

    public function searchProductTitle($title, $start, $limit) {
        $sql = "SELECT p.id, p.title, p.category_id, p.price, p.author_id, p.isbn, p.appereance_year, p.description, p.short_description,"
                . " p.stock, p.active, i.path, i.filename, i.product_id FROM products p INNER JOIN images i ON p.id = i.product_id "
                . " WHERE p.title LIKE :title LIMIT :start, :limit";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':title', '%' . $title . '%');
        $stmt->bindParam(':start', $start, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->getProducts($stmt);
    }

    public function searchProductTitleCount($title) {
        $sql = "SELECT COUNT(*) FROM products p INNER JOIN images i ON p.id = i.product_id "
                . " WHERE p.title LIKE :title";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':title', '%' . $title . '%');
        $stmt->execute();
        $result = $stmt->fetch();

        return $result[0];
    }
    
//    
//    public function updateProductStockByProductId($product_id, $stock) {
//        $sql = 'UPDATE products SET stock = :stock WHERE id = :product_id';
//        $stmt = $this->getConnection()->prepare($sql);
//        $stmt->bindValue(':stock', $stock, \PDO::PARAM_INT);
//        $stmt->bindValue(':product_id', $product_id, \PDO::PARAM_INT);
//        $stmt->execute();
//    }
}
