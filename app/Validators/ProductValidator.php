<?php

namespace Validators;

trait ProductValidator {

    public function validateProductTitle() {
        $this->registerValidator(function($product) {
            if (strlen($product->getTitle()) < 2) {
                $product->addError("title", "Product title must have at least 2 characters.");
            }
        });
    }

    public function validateProductPrice() {
        $this->registerValidator(function($product) {
            if ($product->getPrice() <= 0 || !is_numeric($product->getPrice())) {
                $product->addError("price", "Price must be a positive number.");
            }
        });
    }

    public function validateProductStock() {
        $this->registerValidator(function($product) {
            if ($product->getStock() < 0 || !is_numeric($product->getStock())) {
                $product->addError("stock", "Stock must be a positive number.");
            }
        });
    }

    public function validateProductDescription() {
        $this->registerValidator(function($product) {
            if (strlen(strip_tags($product->getDescription())) < 5) {
                $product->addError("description", "Description must have at least 5 characters.");
            }
        });
    }

    public function validateProductShort_description() {
        $this->registerValidator(function($product) {
            if (strlen($product->getShort_description()) < 5) {
                $product->addError("short_description", "Short description must have at least 5 characters.");
            }
        });
    }

    public function productTitleNotExists($attributeName = 'title', $message = 'Title already exists.') {
        $this->registerValidator(function($object) use ($attributeName, $message) {
            if (\Wee\DaoFactory::getDao('Product')->getProductByTitle($object) != null && !(\Wee\DaoFactory::getDao('Product')->pairTitleIdExists($object))) {
                $object->addError($attributeName, $message);
            }
        });
    }

    public function validateProductImageType() {
        $this->registerValidator(function($product) {
            if (!$product->getId() || $product->getImage()->getId() == null) {
                $allowedExts = array("gif", "jpeg", "jpg", "png");
                $temp = explode(".", $product->getImage()->getFilename());
                $extension = end($temp);
                if (!((($product->getImage()->getType() == "image/gif") ||
                        ($product->getImage()->getType() == "image/jpeg") ||
                        ($product->getImage()->getType() == "image/jpg") ||
                        ($product->getImage()->getType() == "image/pjpeg") ||
                        ($product->getImage()->getType() == "image/x-png") ||
                        ($product->getImage()->getType() == "image/png")) && in_array($extension, $allowedExts))) {
                    $product->addError('image', 'Invalid image type.');
                }
            }
        });
    }

    public function validateProductImageSize() {
        $this->registerValidator(function($product) {
            if (!($product->getId() || $product->getImage())) {
                if ($product->getImage()->getSize() > 5 * 1024 * 1024) {
                    $product->addError('image', 'Image too large.');
                }
            }
        });
    }

}
