<?php

namespace Dao;

class CategoryDao extends \Wee\Dao {
    
    private function readRow($row) {
        $category = new \Models\Category();
        $category->updateAttributes($row);
        $category->setId($row['id']);
<<<<<<< HEAD
=======
//        $category->setLabel($row['label']);

>>>>>>> All Validators moved in constructors, removed id in attributes accesible function
        return $category;
    }

    private function getCategories($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row){
            $result[]=$this->readRow($row);
        }
        return $result;
    }
    
    private function getCategory($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null)
            return null;
        $result = $this->readRow($row[0]);
        return $result;
    }
    
    public function getAllCategories() {
        $sql = 'SELECT * FROM categories';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->getCategories($stmt);
    }
    
    public function getCategoryById($category_id) {
        $sql = 'SELECT * FROM categories WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $category_id);
        $stmt->execute();
        return $this->getCategory($stmt);
    }
}