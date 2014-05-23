<?php

namespace Models;

class Product extends \Wee\Model {
    
    use \Validators\ProductValidator;
    
    protected $id;
    protected $title;
    protected $category_id;
    protected $price;
    protected $author_id;
    protected $isbn;
    protected $appereance_year;
    protected $description;
    protected $short_description;
    protected $stock;
    protected $active;
    
    protected $category;
    protected $image;
            
    function __construct() {
        $this->setAttrAccessible(array('title', 'category_id', 'price', 'author_id', 'isbn', 'appereance_year', 'description', 'short_description', 'stock', 'active'));
    
        $this->validateProductTitle();
        $this->validateProductPrice();
        $this->validateProductStock();
        $this->validateProductDescription();
        $this->validateProductShort_description();
        
        $this->productTitleNotExists();
        
        $this->validateProductImageType();
        $this->validateProductImageSize();
    }
    
    public function __destruct() {
        
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getCategory_id() {
        return $this->category_id;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getAuthor_id() {
        return $this->author_id;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getAppearence_year() {
        return $this->appearence_year;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getShort_description() {
        return $this->short_description;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getActive() {
        return $this->active;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setCategory_Id($category_id) {
        $this->category_id = $category_id;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setAuthor_id($author_id) {
        $this->author_id = $author_id;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setAppearence_year($appearence_year) {
        $this->appearence_year = $appearence_year;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setShort_description($short_description) {
        $this->short_description = $short_description;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function getAppereance_year() {
        return $this->appereance_year;
    }

    public function setAppereance_year($appereance_year) {
        $this->appereance_year = $appereance_year;
    }

    public function setCategory() {
        $categoryDao = \Wee\DaoFactory::getDao('Category');
        $this->category = $categoryDao->getCategoryById($this->category_id);
    }
    
    public function getCategory() {
        return $this->category->getLabel();
    }    
    
    public function getImage() {
        return $this->image;
    }
    
    public function setImage($image) {
        $this->image = $image;
    }
    
    public function createImage($path, $filename, $type, $size) {
        $image = new \Models\Image();
        $image->updateAttributes(array('path' => $path, 'size' => $size, 'filename' => $filename, 'type' =>$type));
        $this->setImage($image);
    }
    
    public function setImageByProductId() {
        $imageDao = \Wee\DaoFactory::getDao('Image');
        $this->image = $imageDao->getImageNameByProductId($this->id);
    }
}
