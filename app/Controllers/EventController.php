<?php
require_once '../app/Models/EventModel.php';

class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new EventModel();
    }

    public function index() {
        $events = $this->eventModel->getAll();
        require_once '../app/Views/event/index.php';
    }

    public function event($id) {
        $news = $this->eventModel->getById($id);
        $registeredEvent = $this->eventModel->getEventRegByUserAndEventId($id, $_SESSION['eid']);
        require_once '../app/Views/home/event.php';
    }

    public function reg($id) {
        if ($_SESSION) {
            $this->eventModel->insertRegistration($id, $_SESSION['eid']);
        }

        header('Location: ' . BASE_URL . "home/event/" . $id);
        exit;
    }

    public function delete($id) {
        $this->eventModel->delete($id);
        header('Location: ' . BASE_URL . "event");
        exit;
    }

    public function view($id) {
        $news = $this->eventModel->getById($id);
        require_once '../app/Views/event/view.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $venue = $_POST['venue'];
            $online_link = $_POST['online_link'];
            $map_link = $_POST['map_link'];
            $this->eventModel->update($id, $title, $description, $start_time, $end_time, $venue, $online_link, $map_link);
        } 

        $news = $this->eventModel->getById($id);
        require_once '../app/Views/event/edit.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $venue = $_POST['venue'];
            $online_link = $_POST['online_link'];
            $map_link = $_POST['map_link'];
            $this->eventModel->addTraining($title, $description, $start_time, $end_time, $venue, $online_link, $map_link);
            header('Location: ' . BASE_URL . "event");
            exit;
        } 

        require_once '../app/Views/event/create.php';
    }

}
