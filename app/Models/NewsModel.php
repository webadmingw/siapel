<?php
class NewsModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllNews() {
        $this->db->query('
        select 
            n.*, u.fullname updated_by, uc.fullname created_by
        from news n 
        join users u on u.eid = n.updated_by
        join users uc on u.eid = n.created_by
        where 
            n.deleted=0
        group by n.id
        order by n.updated_at;
        ');
        return $this->db->resultSet();
    }

    public function getAllNewsHomePage() {
        $this->db->query('select 
            n.*, u.fullname 
        from news n
        join users u on u.eid = n.updated_by 
        where 
            n.published=1 
            and n.deleted=0 
        order by n.updated_at desc 
        limit 5;
        ');
        return $this->db->resultSet();
    }

    public function getNewsById($id) {
        $this->db->query('
        select 
            n.*, u.fullname 
        from news n
        join users u on u.eid = n.updated_by 
        where 
            n.deleted=0
            and id = :id
        ;
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByIdHome($id) {
        $this->db->query('
        select 
            n.*, u.fullname 
        from news n
        join users u on u.eid = n.updated_by 
        where 
            id = :id
            and n.published=1 
            and n.deleted=0;
        ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function createNews($title, $content, $contributor_id, $image) {
        $this->db->query('INSERT INTO news (title, content, created_by, updated_by, image, published) VALUES (:title, :content, :contributor_id, :contributor_id, :image, 1)');
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':contributor_id', $contributor_id);
        $this->db->bind(':image', $image);
        return $this->db->execute();
    }

    public function updateNews($id, $title, $content, $image) {
        $this->db->query('UPDATE news SET title = :title, content = :content, image = :image WHERE id = :id');
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':image', $image);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function deleteNews($id) {
        $this->db->query('UPDATE news SET deleted = 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
