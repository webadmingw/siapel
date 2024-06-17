<?php
require_once '../app/Models/NewsModel.php';
require_once '../app/Models/EventModel.php';

class HomeController {
    private $newsModel;
    private $eventModel;

    public function __construct() {
        $this->newsModel = new NewsModel();
        $this->eventModel = new EventModel();
    }

    public function index() {
        $news = $this->newsModel->getAllNewsHomePage();
        $event = $this->eventModel->getAllHomePage();
        require_once '../app/Views/home/index.php';
    }

    public function news($id) {
        $news = $this->newsModel->getByIdHome($id);
        require_once '../app/Views/home/news.php';
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

}
