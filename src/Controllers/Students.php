<?php

namespace Controllers;

class Students {

    private $views;
    private $view;
    private $databases;
    private $Classroom;
    private $Students;
    private $PostedFiles;
    
    public function __construct(\App\Router\views $views, \App\Databases $Databases, \App\Core\ClassroomManager $Classroom, \App\Core\StudentsManager $Students) {
        $this->db           = function() use ($Databases) { return $Databases->PDO($Databases->databases['website']); };
        $this->views        = $views;
        $this->Classroom    = $Classroom;
        $this->Students     = $Students;
    }

    public function View($subsite, $method, $slug) {
        $ClientAuth = $this->views->ClientAuth;
        if (!empty($ClientAuth)) {
            if ($method == 'POST') {
                $cb = $this->Students->UpdateStudent($_POST['identifier'], null, (isset($_POST['classroom']) && !empty($_POST['classroom'])? $_POST['classroom']: null), null);
                $this->views->SetPushMessage((!$cb? 'UPDATE_STUDENT_ERROR': 'UPDATE_STUDENT_SUCCES'), (!$cb? 'error': 'success'));
            }
            $this->CreateView('student', $slug);
        } else {
            header('Location: /connexion/');
        }
    }

    public function Edit($subsite, $method, $slug) {
        $ClientAuth = $this->views->ClientAuth;
        if (!empty($ClientAuth)) {
            if ($method == 'POST') {
                $cb = $this->Students->UpdateStudent($_POST['identifier'], $_POST, (isset($_POST['classroom']) && !empty($_POST['classroom'])? $_POST['classroom']: null), (isset($_FILES) && !empty($_FILES)? $_FILES: null));
                $this->views->SetPushMessage((!$cb? 'UPDATE_STUDENT_ERROR': 'UPDATE_STUDENT_SUCCES'), (!$cb? 'error': 'success'));
                header('Location: /etudiants/'. $_POST['identifier']);
            }
            $this->CreateView('student', $slug, true);
        } else {
            header('Location: /connexion/');
        }
    }

    public function Add($subsite, $method, $slug) {
        $ClientAuth = $this->views->ClientAuth;
        if (!empty($ClientAuth)) {
            if ($method == 'POST') {
                $cb = $this->Students->CreateStudent($_POST, (!empty($_FILES)? $_FILES: null));
                $this->views->SetPushMessage((!$cb? 'CREATE_STUDENT_ERROR': 'CREATE_STUDENT_SUCCES'), (!$cb? 'error': 'success'));
            }
            $this->CreateView('add-student', $slug, true);
        } else {
            header('Location: /connexion/');
        }
    }

    private function CreateView(string $view, ?string $slug = null, $editmode = false) {
        $students = $this->Students->GetStudents((!empty($slug)? $slug: null));
        $this->views->header();
        $this->views->load($view, [ 'students' => (!empty($slug)? (!empty($students[0])? $students[0]: null): $students), 'single' => (!empty($slug)? true: false), 'options' => $this->Students->GetOptions(), 'diets' => $this->Students->GetDiets(), 'classroom' => function($classroom = null) { return $this->Classroom->GetClassrooms($classroom); }, 'students_number' => function($classroom = null) { return $this->Students->GetStudentsNumber($classroom); }, 'editmode' => $editmode ]);
        $this->views->footer();
    }

}

?>