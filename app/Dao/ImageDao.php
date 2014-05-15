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
}