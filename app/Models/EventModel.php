<?php
class EventModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('SELECT * FROM news ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getAllHomePage() {
        $this->db->query('
        select 
            n.*, u.fullname, count(er.id) t_participant
        from training n 
        join users u on u.eid = n.updated_by
        left join event_registrations er on er.event_id = n.id
        where 
            n.published=1 
            and n.deleted=0
            and start_time > now()
        group by n.id
        order by n.updated_at;
        ');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('
        select 
            n.*, u.fullname, count(er.id) t_participant 
        from training n 
        join users u on u.eid = n.updated_by 
        left join event_registrations er on er.event_id = n.id
        where 
        n.id=:id
        group by n.id;
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getEventRegByUserAndEventId($event_id, $eid) {
        $this->db->query('
        select registered_at from event_registrations er where er.event_id = :event_id and er.user_id = :user_id;
        ');
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':user_id', $eid);
        return $this->db->single();
    }

    public function insertRegistration($event_id, $user_id) {
        $this->db->query('INSERT INTO event_registrations (event_id, user_id, registered_at) VALUES (:event_id, :user_id, :reg_date)');
        $this->db->bind(':event_id', $event_id);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':reg_date', date('Y-m-d H:i:s')); // use current datetime
        return $this->db->execute();
    }
}
