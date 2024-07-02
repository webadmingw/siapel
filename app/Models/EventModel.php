<?php
class EventModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('
        select 
            n.*, u.fullname updated_by, uc.fullname created_by, c.category, count(er.id) t_participant
        from training n 
        join users u on u.eid = n.updated_by
        join users uc on uc.eid = n.created_by
        join category c on c.id = n.cat_id
        left join event_registrations er on er.event_id = n.id
        where 
            n.deleted=0
        group by n.id
        order by n.created_at desc;
        ');
        return $this->db->resultSet();
    }

    public function getParticipantById($evid) {
        $this->db->query("
        select 
            er.*, u.fullname, u.addr,  ifnull(c.name, '') cities_name, u.ktp 
        from event_registrations er 
        join users u on u.eid = er.user_id 
        left join cities c on c.code = u.cities
        where 
            er.event_id = :evid
        order by registered_at asc
        ;
        ");
        $this->db->bind(':evid', $evid);
        return $this->db->resultSet();
    }

    public function searchAll($keyword) {
        $search = "%{$keyword}%";
        return $this->db->queryLike("
        select 
            n.*, u.fullname, c.category, count(er.id) t_participant
        from training n 
        join users u on u.eid = n.updated_by
        join category c on c.id = n.cat_id
        left join event_registrations er on er.event_id = n.id
        where 
            n.published=1 
            and n.deleted=0
            and start_time > now()
            and n.title like ?
        group by n.id
        order by n.updated_at;
        ", $keyword);
    }

    public function getAllHomePage() {
        $this->db->query('
        select 
            n.*, u.fullname, c.category, count(er.id) t_participant
        from training n 
        join users u on u.eid = n.updated_by
        join category c on c.id = n.cat_id
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
            n.*, u.fullname, c.category, count(er.id) t_participant 
        from training n 
        join users u on u.eid = n.updated_by 
        join category c on c.id = n.cat_id
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

    public function update($id, $title, $description, $start_time, $end_time, $venue, $online_link, $map_link, $attachment) {
        $this->db->query('
        UPDATE training 
        SET 
            title = :title, 
            description = :description, 
            start_time = :start_time, 
            end_time = :end_time, 
            venue = :venue, 
            online_link = :online_link, 
            map_link = :map_link,
            attachment = :attachment 
        WHERE 
            id = :id;
        ');
        $this->db->bind(':id', $id);
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        $this->db->bind(':start_time', $start_time);
        $this->db->bind(':end_time', $end_time);
        $this->db->bind(':venue', $venue);
        $this->db->bind(':online_link', $online_link);
        $this->db->bind(':map_link', $map_link);
        $this->db->bind(':attachment', $attachment);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('UPDATE training SET deleted = 1, updated_at = now(), updated_by = :eid WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':eid', $_SESSION['eid']);
        return $this->db->execute();
    }

    public function published($id, $status=true) {
        $this->db->query('UPDATE training SET published = :published, updated_at = now(), updated_by = :eid WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':published', $status);
        $this->db->bind(':eid', $_SESSION['eid']);
        return $this->db->execute();
    }

    public function addTraining($title, $description, $start_time, $end_time, $venue, $cat_id, $online_link, $map_link, $attachment) {
        $this->db->query('INSERT INTO training (title, description, start_time, end_time, venue, cat_id, online_link, map_link, created_by, updated_by, attachment) VALUES (:title, :description, :start_time, :end_time, :venue, :cat_id, :online_link, :map_link, :created_by, :updated_by, :attachment)');
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        $this->db->bind(':start_time', $start_time);
        $this->db->bind(':end_time', $end_time);
        $this->db->bind(':venue', $venue);
        $this->db->bind(':cat_id', $cat_id);
        $this->db->bind(':online_link', $online_link);
        $this->db->bind(':map_link', $map_link);
        $this->db->bind(':created_by', $_SESSION['eid']);
        $this->db->bind(':updated_by', $_SESSION['eid']);
        $this->db->bind(':attachment', $attachment);
        return $this->db->execute();
    }

    public function addComment($eventId, $userId, $comment) {
        $this->db->query('INSERT INTO comments (event_id, created_by, comment) VALUES (:event_id, :user_id, :comment)');
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':comment', $comment);
        return $this->db->execute();
    }

    public function getCommentsByEventId($eventId) {
        $this->db->query('
        SELECT 
            c.*, u.fullname 
        FROM comments c
        join users u on u.eid = c.created_by 
        WHERE event_id = :event_id;
        ');
        $this->db->bind(':event_id', $eventId);
        return $this->db->resultSet();
    }

}

