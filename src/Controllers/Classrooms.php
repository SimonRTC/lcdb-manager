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
        $this->PostedDatas  = (isset($_POST) && !empty($_POST)? $_POST: false);
    }

    public function index($type, $classroom, $auth, $injection) {
        if ($type == 'POST' && $injection == 'add-classroom') {  $cb = $this->Classroom->CreateClassroom($this->PostedDatas); $this->views->SetPushMessage((!$cb? 'CREATE_CLASSROOM_ERROR': 'CREATE_CLASSROOM_SUCCESS'), (!$cb? 'error': 'success')); }
        $ClientAuth = $this->views->ClientAuth;
        if ($auth && !empty($ClientAuth) || !$auth) {
            $classrooms = $this->Classroom->GetClassrooms((!empty($classroom)? $classroom: null));
            $this->views->header(true);
            $this->views->load(($injection == 'add-classroom'? 'add-classroom': 'classroom'), [ 'classrooms' => (!empty($classroom)? (!empty($classrooms[0])? $classrooms[0]: null): $classrooms), 'single' => (!empty($classroom)? true: false), 'students' => (!empty($classroom)? $this->Students->GetStudents(null, $classroom): null), 'students_number' => function($classroom = null) { return $this->Students->GetStudentsNumber($classroom); } ]);
            $this->views->footer(true);
        } else {
            header('Location: /connexion/');
        }
    }

}

?>