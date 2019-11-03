<?php

namespace Controllers;

class Classrooms {

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
            $this->CreateView('classroom', $slug);
        } else {
            header('Location: /connexion/');
        }
    }

    public function Add($subsite, $method, $slug) {
        $ClientAuth = $this->views->ClientAuth;
        if (!empty($ClientAuth)) {
            if ($method == 'POST' ) {
                $cb = $this->Classroom->CreateClassroom($_POST);
                $this->views->SetPushMessage((!$cb? 'CREATE_CLASSROOM_ERROR': 'CREATE_CLASSROOM_SUCCESS'), (!$cb? 'error': 'success'));
            }
            $this->CreateView('add-classroom', $slug);
        } else {
            header('Location: /connexion/');
        }
    }

    private function CreateView(string $view, ?string $slug = null) {
        $classrooms = $this->Classroom->GetClassrooms((!empty($slug)? $slug: null));
        $this->views->header();
        $this->views->load($view, [ 'classrooms' => (!empty($slug)? (!empty($classrooms[0])? $classrooms[0]: null): $classrooms), 'single' => (!empty($slug)? true: false), 'students' => (!empty($slug)? $this->Students->GetStudents(null, $slug): null), 'students_number' => function($classroom = null) { return $this->Students->GetStudentsNumber($classroom); } ]);
        $this->views->footer();
    }

}

?>