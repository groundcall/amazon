<?php

namespace Dao;

class UserDao extends \Wee\Dao {

    private function readRow($row) {
        $user = new \Models\User();
        $user->updateAttributes($row);

        $user->setId($row['id']);
        return $user;
    }

    private function getUsers($stmt) {
        $result = array();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $result[] = $this->readRow($row);
        }

        return $result;
    }

    private function getUser($stmt) {
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($row == null) {
            return null;
        }
        $result = $this->readRow($row[0]);

        return $result;
    }

    public function getAllUsers($start, $limit) {
        $sql = 'SELECT * FROM users ORDER BY id DESC LIMIT :start, :limit';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':start', $start, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $this->getUsers($stmt);
    }

    public function getUserById($user_id) {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user_id);
        $stmt->execute();
        return $this->getUser($stmt);
    }

    public function getPasswordById($user) {
        $sql = 'SELECT password FROM users WHERE id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();
        return $this->getUser($stmt);
    }

// NOT USED

    public function getUserByUsername($user) {
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->execute();
        return $this->getUser($stmt);
    }

    public function pairUsernameIdExists($user) {
        $sql = 'SELECT * FROM users WHERE username = :username AND id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function pairEmailIdExists($user) {
        $sql = 'SELECT * FROM users WHERE email = :email AND id = :id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByEmail($user) {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->execute();
        return $this->getUser($stmt);
    }

    public function addUser($user) {
        $sql = "INSERT INTO users(username, firstname, lastname, email, password, phone, gender, created_at) VALUES (:username, :firstname, :lastname, :email, :password, :phone, :gender, :created_at)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':firstname', $user->getFirstname());
        $stmt->bindValue(':lastname', $user->getLastname());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':phone', $user->getPhone());
        $stmt->bindValue(':password', md5($user->getPassword()));
        $stmt->bindValue(':gender', $user->getGender());
        $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
        $stmt->execute();
    }

    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE id= :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user_id);
        $stmt->execute();
    }

    public function updateUser($user) {
        $sql = "UPDATE users SET username = :username, firstname = :firstname, gender = :gender, lastname = :lastname, email = :email, phone = :phone, password = :password WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':firstname', $user->getFirstname());
        $stmt->bindValue(':lastname', $user->getLastname());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':phone', $user->getPhone());
        $stmt->bindValue(':gender', $user->getGender());
        $stmt->bindValue(':password', md5($user->getPassword()));
        $stmt->execute();
    }

    public function setUserActivity($user_id, $active) {
        $sql = "UPDATE users SET activated = :activated WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user_id);
        $stmt->bindValue(':activated', $active);
        $stmt->execute();
    }

    public function getUserCount() {
        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result[0];
    }

}
