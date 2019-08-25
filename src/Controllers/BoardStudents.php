<?php

namespace Controllers;

class BoardStudents {

    private $views;
    private $view;
    private $databases;
    private $Classroom;
    private $Students;
    
    public function __construct(\App\Router\views $views, \App\Databases $Databases, \App\Core\ClassroomManager $Classroom, \App\Core\StudentsManager $Students) {
        $this->db           = function() use ($Databases) { return $Databases->PDO($Databases->databases['website']); };
        $this->views        = $views;
        $this->Classroom    = $Classroom;
        $this->Students     = $Students;
    }

    public function index($type, $classroom, $auth, $injection) {
        $ClientAuth = $this->views->ClientAuth;
        if ($auth && !empty($ClientAuth) || !$auth) {
            $this->views->header(true);
            $this->views->load('board-students', [ 'classrooms' => $this->Classroom->GetClassrooms($classroom), 'students' => function($classroom = null) { return $this->Students->GetStudents(null, $classroom); }, 'single' => (!empty($classroom)? true: false), 'students_number' => function($classroom = null) { return $this->Students->GetStudentsNumber($classroom); }, 'option' => $this->Students->GetOptions(), 'diets' => function($diet = null) { return $this->Students->GetDiets($diet); } ]);
            $this->views->footer(true);
        } else {
            header('Location: /connexion/');
        }
    }

}

?>