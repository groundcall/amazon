<?php

namespace Models;

class Filtering extends \Wee\Model {

    protected $order;
    protected $sort;
    protected $stock;
    protected $title;
    protected $category_id;
    protected $price;
    protected $start;
    protected $limit;
    
    public function __construct() {
        $this->setAttrAccessible(array('order', 'sort', 'stock', 'title', 'category_id', 'price', 'start', 'limit'));
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
    
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getStart() {
        return $this->start;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function setStart($start) {
        $this->start = $start;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }



}
