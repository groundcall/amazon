<?php

namespace Models;

class Filter extends \Wee\Model {
    
    protected $title;
    protected $sortBy;
    protected $sortType;
    protected $category;
    protected $price;
    protected $stock;

    public function __construct() {
        
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getSortBy() {
        return $this->sortBy;
    }

    public function getSortType() {
        return $this->sortType;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setSortBy($sortBy) {
        $this->sortBy = $sortBy;
    }

    public function setSortType($sortType) {
        $this->sortType = $sortType;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }
}