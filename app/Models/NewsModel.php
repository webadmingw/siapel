<?php
class NewsModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllNews() {
        $this->db->query('SELECT * FROM news ORDER BY created_at DESC');
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
        $this->db->query('SELECT * FROM news WHERE id = :id');
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
        $this->db->query('INSERT INTO news (title, content, contributor_id, image) VALUES (:title, :content, :contributor_id, :image)');
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
        $this->db->query('DELETE FROM news WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
