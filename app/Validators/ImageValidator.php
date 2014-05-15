<?php

namespace Validators;

trait ImageValidator {

    public function validateImageType() {
        $this->registerValidator(function($image) {
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $image->getFilename());
            $extension = end($temp);
            if (!((($image->getType() == "image/gif") || ($image->getType() == "image/jpeg") || ($image->getType() == "image/jpg") || ($image->getType() == "image/pjpeg") || ($image->getType() == "image/x-png") || ($image->getType() == "image/png")) && in_array($extension, $allowedExts))) {
                $image->addError('type', 'Invalid image type.');
            }
        });
    }
    
    public function validateImageSize() {
        $this->registerValidator(function($image) {
            if ($image->getSize() > 5 ) {
                $image->addError('size', 'Image too large.');
            }
        });
    }
}