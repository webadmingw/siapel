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

    public function open($id) {
        $this->eventModel->published($id);
        header('Location: ' . BASE_URL . "event");
        exit;
    }

    public function close($id) {
        $this->eventModel->published($id, false);
        header('Location: ' . BASE_URL . "event");
        exit;
    }

    public function view($id) {
        $news = $this->eventModel->getById($id);
        require_once '../app/Views/event/view.php';
    }

    public function participant($id) {
        $event = $this->eventModel->getById($id);
        $par = $this->eventModel->getParticipantById($id);
        require_once '../app/Views/event/participant.php';
    }

    public function download($id) {
        $event = $this->eventModel->getById($id);
        $par = $this->eventModel->getParticipantById($id);
        
        // Set the filename
        $filename = "peserta_".$event["title"].".csv";

        // Set the headers to force download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $filename . '"');

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Output the column headings
        fputcsv($output, ['Peserta', 'KTP', 'Alamat', 'Kota', 'Tanggal Registrasi']);

        // Output the data
        foreach ($par as $p) {
            fputcsv($output, [$p['fullname'], $p['ktp'], $p['addr'], $p['cities_name'], $p['registered_at']]);
        }

        // Close the output stream
        fclose($output);
        exit;
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
            $errors = array();
            if (!isset($_POST['title']) || empty($_POST['title'])) {
                $errors['title'] = 'Judul pelatihan harus diisi';
            } else {
                $title = $_POST['title'];
            }
            if (!isset($_POST['description']) || empty($_POST['description'])) {
                $errors['description'] = 'Deskripsi pelatihan harus diisi';
            } else {
                $description = $_POST['description'];
            }
            if (!isset($_POST['start_time']) || empty($_POST['start_time'])) {
                $errors['start_time'] = 'Waktu mulai pelatihan harus diisi';
            } else {
                $start_time = $_POST['start_time'];
            }
            if (!isset($_POST['end_time']) || empty($_POST['end_time'])) {
                $errors['end_time'] = 'Waktu selesai pelatihan harus diisi';
            } else {
                $end_time = $_POST['end_time'];
            }
            if (!isset($_POST['venue']) || empty($_POST['venue'])) {
                $errors['venue'] = 'Tempat pelatihan harus diisi';
            } else {
                $venue = $_POST['venue'];
            }

            $online_link = $_POST['online_link'];
            $map_link = $_POST['map_link'];
            $cat_id = 1;

            if (!empty($errors)) {
                require_once '../app/Views/event/create.php';
                exit;
            }
            
            if($this->eventModel->addTraining($title, $description, $start_time, $end_time, $venue, $cat_id, $online_link, $map_link)){
                header('Location: ' . BASE_URL . "event");
                exit;
            }else{
                $error = "Gagal simpan Pelatihan";
            }
        } 
        require_once '../app/Views/event/create.php';
    }

}
