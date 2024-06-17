<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUserByEidAndPasswordHash($eid, $password) {
        $password_hash = md5($password);
        $this->db->query("select * from  users where eid = :eid and password_hash = :password_hash and deleted = 0;");
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

}
