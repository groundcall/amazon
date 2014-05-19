<?php

namespace Models;

class Image extends \Wee\Model {

    use \Validators\ImageValidator;
    
    protected $id;
    protected $product_id;
    protected $path;
    protected $filename;
    protected $type;
    protected $size;
    protected $product;

    public function __construct() {
        $this->setAttrAccessible(array('product_id', 'path', 'filename', 'type', 'size'));

        $this->validateImageType();
        $this->validateImageSize();
    }

    public function getId() {
        return $this->id;
    }

    public function getProduct_id() {
        return $this->product_id;
    }

    public function getPath() {
        return $this->path;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getProduct() {
        return $this->product;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
    }

    public function setProduct() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $this->product = $productDao->getProductById($this->product_id);
    }
    
    public function getType() {
        return $this->type;
    }

    public function getSize() {
        return $this->size;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setSize($size) {
        $this->size = $size;
    }
    
    public function setFilenameAndPath() {
        $path = '../web/product_images/public/image/';
        $filename = uniqid("product_") . $this->getFilename();
        move_uploaded_file($this->getPath(), $path . $filename);
        $this->setFilename($filename);
        $this->setPath($path);
    }

    public function saveImage() {
        $this->setFilenameAndPath();
        $imageDao = \Wee\DaoFactory::getDao('Image');
        $imageDao->addImage($this);
    }
    
    public function updateImage() {
        $this->setFilenameAndPath();
        $imageDao = \Wee\DaoFactory::getDao('Image');
        $imageDao->updateImageFilename($this);
    }
    
}
