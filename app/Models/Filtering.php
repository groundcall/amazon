<?php

namespace Models;

class Filtering extends \Wee\Model {

    protected $order;
    protected $sort;
    protected $stock;
    protected $price_min;
    protected $price_max;
    protected $title;
    protected $category_id;
    
    protected $pagination;

    public function __construct() {
        $this->setAttrAccessible(array('order', 'sort', 'stock', 'price_min', 'price_max', 'title', 'category_id'));
    }

    public function getOrder() {
        return $this->order;
    }

    public function getSort() {
        return $this->sort;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getPrice_min() {
        return $this->price_min;
    }

    public function getPrice_max() {
        return $this->price_max;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getCategory_id() {
        return $this->category_id;
    }

    public function setOrder($order) {
       $this->order = $order;
    }

    public function setSort($sort) {
        $this->sort = $sort;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setPrice_min($price_min) {
        $this->price_min = $price_min;
    }

    public function setPrice_max($price_max) {
        $this->price_max = $price_max;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }

    public function getPagination() {
        return $this->pagination;
    }

    public function setPagination($pagination) {
        $this->pagination = $pagination;
    }
    


}
