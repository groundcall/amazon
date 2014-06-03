<?php

namespace Dao;

class ImageDao extends \Wee\Dao {
    
    private function readRow($row) {
        $image = new \Models\Image();
        $image->setId($row['id']);
        $image->setProduct_id($row['product_id']);
        $image->setFilename($row['filename']);
        $image->setPath($row['path']);
        $image->setId($row['id']);
        
        return $image;
    }
    
    private function getImage($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
        $result = $this->readRow($row[0]);
        return $result;
    }
    
    public function addImage($image) {
        $sql = "INSERT INTO images (product_id, path, filename) VALUES (:product_id, :path, :filename)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':product_id', $image->getProduct_id());
        $stmt->bindValue(':path', $image->getPath());
        $stmt->bindValue(':filename',$image->getFilename());
        $stmt->execute();
    }
    
    public function deleteImage($product_id) {
        $sql = "DELETE FROM images WHERE product_id = :product_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':product_id', $product_id);
        $stmt->execute();
    }
    
    public function updateImageFilename($image) {
        $sql = "UPDATE images SET filename = :filename WHERE product_id = :product_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':product_id', $image->getProduct_id());
        $stmt->bindValue(':filename',$image->getFilename());
        $stmt->execute();
    }
    
    public function getImageNameByProductId($product_id) {
        $sql = 'SELECT path, filename FROM images WHERE product_id = :product_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':product_id', $product_id);
        $stmt->execute();
        $result = $stmt->fetch();
        $imageName = $result['path'] . $result['filename'];
        return $imageName;
    }
    
    public function getImageByProductId($product_id) {
        $sql = 'SELECT * FROM images WHERE product_id = :product_id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':product_id', $product_id);
        $stmt->execute();
        return $this->getImage($stmt);
    }
}