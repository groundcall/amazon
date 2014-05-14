<?php

namespace Models;

class Product extends \Wee\Model {
    
    protected $id;
    protected $title;
    protected $category_id;
    protected $label;
    protected $price;
    protected $author_id;
    protected $isbn;
    protected $appereance_year;
    protected $description;
    protected $short_description;
    protected $stock;
    protected $active;
    
    function __construct() {
        $this->setAttrAccessible(array('id', 'title', 'category_id', 'label', 'price', 'author_id', 'isbn', 'appereance_year', 'description', 'short_description', 'stock', 'active'));
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

    public function setCategory_id($category_id) {
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

    public function getLabel() {
        return $this->label;
    }

    public function getAppereance_year() {
        return $this->appereance_year;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setAppereance_year($appereance_year) {
        $this->appereance_year = $appereance_year;
    }


}