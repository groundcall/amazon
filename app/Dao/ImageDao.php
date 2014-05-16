<?php

namespace Dao;

class ImageDao extends \Wee\Dao {
    
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
}