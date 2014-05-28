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
        $sql = 'SELECT * FROM users WHERE role_id = :role_id ORDER BY id DESC LIMIT :start, :limit';
        $stmt = $this->getConnection()->prepare($sql);
        $role_id = 2;
        $stmt->bindParam(':role_id', $role_id, \PDO::PARAM_INT);
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
        $sql = "INSERT INTO users (username, firstname, lastname, email, password, phone, gender, created_at, education_id, activation_key, role_id)"
                . " VALUES (:username, :firstname, :lastname, :email, :password, :phone, :gender, :created_at, :education_id, :activation_key, :role_id)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':firstname', $user->getFirstname());
        $stmt->bindValue(':lastname', $user->getLastname());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':phone', $user->getPhone());
        $stmt->bindValue(':password', md5($user->getPassword()));
        $stmt->bindValue(':gender', $user->getGender());
        $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
        if ($user->getEducation_id() == null) {
            $user->setEducation_id(0);
        }
        $role_id = 2;
        $stmt->bindValue(':role_id', $role_id);
        $stmt->bindValue(':education_id', $user->getEducation_id());
        $stmt->bindValue(':activation_key', $user->getActivation_key());
        $stmt->execute();
    }
    
    public function getLastInsertedUserId() {
        $sql = "SELECT * FROM users WHERE id = LAST_INSERT_ID()";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $user = $this->getUser($stmt);
        return $user->getId();
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
    
    public function getUserByEmailAddress($email) {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $this->getUser($stmt);
    }
    
    public function getUserByEmailAndPassword($email, $password) {
        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', md5($password));
        $stmt->execute();
        return $this->getUser($stmt);
    }
    
    public function activateUserByActivationKey($activation_key, $user_id) {
        $sql = "UPDATE users SET activated = :activated, activation_key = :new_activation_key WHERE id = :user_id AND activation_key = :activation_key";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':activation_key', $activation_key, \PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id);
        $activated = 1;
        $stmt->bindValue(':activated', $activated, \PDO::PARAM_INT);
        $new_activation_key = NULL;
        $stmt->bindValue(':new_activation_key', $new_activation_key, \PDO::PARAM_NULL);
        $stmt->execute();
    }
    
    public function updateActivationKey($user) {
        $sql = "UPDATE users SET activation_key = :activation_key WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':activation_key', $user->getActivation_key());
        $stmt->execute();
    }
    
    public function updatePassword($activation_key, $user_id, $password) {
        $sql = "UPDATE users SET password = :password, activation_key = :new_activation_key WHERE id = :user_id AND activation_key = :activation_key";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':activation_key', $activation_key, \PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':password', md5($password), \PDO::PARAM_STR);
        $new_activation_key = NULL;
        $stmt->bindValue(':new_activation_key', $new_activation_key, \PDO::PARAM_NULL);
        $stmt->execute();
    }
    
    public function updateBillingAddress($user_id, $address_id) {
        $sql = "UPDATE users SET billing_address_id = :billing_address_id WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':billing_address_id', $address_id);
        $stmt->bindValue(':id', $user_id);
        $stmt->execute();
    }
    
    public function updateShippingAddress($user_id, $address_id) {
        $sql = "UPDATE users SET shipping_address_id = :shipping_address_id WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':shipping_address_id', $address_id);
        $stmt->bindValue(':id', $user_id);
        $stmt->execute();
    }
    
    public function getUserForLogin($user) {
        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', md5($user->getPassword()));
        $stmt->execute();
        return $this->getUser($stmt);
    }
}
