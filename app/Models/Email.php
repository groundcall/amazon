<?php

namespace Models;

class Email extends \Wee\Model {
            
    protected $title;
    protected $message;
    protected $address;
    
    public function __construct() {
        
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
    
    private function setEmail() {
        require_once '/home/adumitrache/Sites/bookstore/team-3/team-3/swift/lib/swift_required.php';
        $transport = \Swift_SmtpTransport::newInstance('smtp.loki.pitechnologies.ro', 25);
        $mailer = \Swift_Mailer::newInstance($transport);
        return $mailer;
    }

    public function sendActivationEmail($user) {
        $mailer = $this->setEmail();
        $this->title = 'Activate your account';
        $this->message = "Hello, " . $user->getFirstname() . " " . $user->getLastname() . " !\n"
                        . "To activate your account please access the following link: \n"
                        . 'http://' . $_SERVER["SERVER_NAME"] . "/users/confirm_activation?user_id=" . $user->getid() 
                        . "&activation_key=" . $user->getActivation_key() . "\n"
                        . "This link is available for 24 hours and can be used only once.";
        $message = \Swift_Message::newInstance($this->title)
                    ->setFrom(array('adumitrache@pitechnologies.ro' => 'bookstore.com'))
                    ->setTo(array($user->getEmail() => $user->getFirstname() . ' ' . $user->getLastname()))
                    ->setBody($this->message);
        $mailer->send($message);
    }
    
    public function sendResetPasswordEmail($user) {
        $mailer = $this->setEmail();
        $this->title = 'Bookshop.com – Reset password';
        $this->message = "Hello, " . $user->getFirstname() . " " . $user->getLastname() . " !\n"
                    . "To reset your password please access the following link: \n"
                    . 'http://' . $_SERVER["SERVER_NAME"] . "/users/change_password?user_id=" . $user->getId()
                    . "&activation_key=" . $user->getActivation_key() . "\n"
                    . "This link is available for 24 hours and can be used only once.";
        $message = \Swift_Message::newInstance($this->title)
                    ->setFrom(array('adumitrache@pitechnologies.ro' => 'bookstore.com'))
                    ->setTo(array($user->getEmail() => $user->getFirstname() . ' ' . $user->getLastname()))
                    ->setBody($this->message);
        $mailer->send($message);
    }
    
    public function sendOrderConfirmationEmail($order) {
        $mailer = $this->setEmail();
        $this->title = 'Book Shop – Order confirmation';
        $this->message = "Hello, " . $order->getUser()->getFirstname() . " " . $order->getUser()->getLastname() . " !\n"
                . "Your order has been successfully placed. The order number is " . $order->getId() . ".\n"
                . "To track your order progress please access the following link: \n"
                . "http://" . $_SERVER["SERVER_NAME"] . "/checkout/order_confirmation?order_id=" . $order->getId()
                . "&confirmation_key=" . $order->getConfirmation_key() . "\n";
        $message = \Swift_Message::newInstance($this->title)
                    ->setFrom(array('adumitrache@pitechnologies.ro' => 'bookstore.com'))
                    ->setTo(array($order->getUser()->getEmail() => $order->getUser()->getFirstname() . ' ' . $order->getUser()->getLastname()))
                    ->setBody($this->message);
        $mailer->send($message);
    }
}

