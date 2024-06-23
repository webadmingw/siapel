<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserByEid($eid) {
        $this->db->query("select * from  users where eid = :eid and deleted = 0;");
        $this->db->bind(':eid', $eid);

        return $this->db->single();
    }

    public function getUserByEidAndPasswordHash($eid, $password) {
        $password_hash = md5($password);
        $this->db->query("select * from  users where email = :eid and password_hash = :password_hash and deleted = 0;");
        $this->db->bind(':eid', $eid);
        $this->db->bind(':password_hash', $password_hash);

        return $this->db->single();
    }

    public function insertUser($eid, $email, $phone_number, $fullname, $password) {
        $password_hash = md5($password);
        $this->db->query("insert into users (eid, email, phone_number, fullname, password_hash, deleted) values (:eid, :email, :phone_number, :fullname, :password_hash, 0)");
        $this->db->bind(':eid', $eid);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone_number', $phone_number);
        $this->db->bind(':fullname', $fullname);
        $this->db->bind(':password_hash', $password_hash);
        return $this->db->execute();
    }

    public function insertUserAdmin($eid, $email, $phone_number, $fullname, $password, $role) {
        $password_hash = md5($password);
        $this->db->query("insert into users (eid, email, phone_number, fullname, password_hash, role, deleted) values (:eid, :email, :phone_number, :fullname, :password_hash, :role, 0)");
        $this->db->bind(':eid', $eid);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone_number', $phone_number);
        $this->db->bind(':fullname', $fullname);
        $this->db->bind(':password_hash', $password_hash);
        $this->db->bind(':role', $role);
        return $this->db->execute();
    }

    public function updateUserWithoutPassword($eid, $email, $phone_number, $fullname, $role) {
        $this->db->query("update users set email = :email, phone_number = :phone_number, fullname = :fullname, role = :role where eid = :eid and deleted = 0;");
        $this->db->bind(':eid', $eid);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone_number', $phone_number);
        $this->db->bind(':fullname', $fullname);
        $this->db->bind(':role', $role);
        return $this->db->execute();
    }

    public function changePasswordByUserId($user_id, $new_password) {
        $new_password_hash = md5($new_password);
        $this->db->query("update users set password_hash = :new_password_hash where eid = :user_id and deleted = 0;");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':new_password_hash', $new_password_hash);
        return $this->db->execute();
    }

    public function deleteUser($user_id) {
        $this->db->query("update users set deleted = 1, updated_at = :updated_at where eid = :user_id and deleted = 0;");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':updated_at', gmdate('Y-m-d H:i:s'));
        return $this->db->execute();
    }

    public function getAllUsers() {
        $this->db->query("select * from users where deleted = 0;");
        return $this->db->resultSet();
    }

}


