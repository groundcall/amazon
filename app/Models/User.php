<?php

namespace Models;

class User extends \Wee\Model {
    protected $id;
    protected $username;
    protected $created_at;

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getCreatedAt() {
        return \DateTime::createFromFormat("Y-m-d H:i:s", $this->created_at);
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at->format("Y-m-d H:i:s");
    }

    public static function findAll() {
        $db = \Wee\Database::sharedInstance();
        $stmt = $db->prepare("select * from user");
        $stmt->execute();

        $results = array();

        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $results[] = User::hydrate($row);
        }

        return $results;
    }
}
