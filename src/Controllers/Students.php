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
        $this->PostedDatas  = (isset($_POST) && !empty($_POST)? $_POST: false);
        $this->PostedFiles  = (isset($_FILES) && !empty($_FILES)? $_FILES: false);
    }

    public function index($type, $student, $auth, $injection) {
        if ($type == 'POST' && $injection == 'add-student') { (!empty($this->PostedFiles)? $this->PostedDatas['_FILES_'] = $this->PostedFiles: null); $cb = $this->Students->CreateStudent($this->PostedDatas); $this->views->SetPushMessage((!$cb? 'CREATE_STUDENT_ERROR': 'CREATE_STUDENT_SUCCES'), (!$cb? 'error': 'success')); }
        if ($type == 'POST' && $injection != 'add-student') { (!empty($this->PostedFiles)? $this->PostedDatas['_FILES_'] = $this->PostedFiles: null); $cb = $this->Students->UpdateStudent($this->PostedDatas['identifier'], (!isset($this->PostedDatas['classroom']) && !isset($this->PostedDatas['_FILES_'])? $this->PostedDatas: null), (isset($this->PostedDatas['classroom']) && !empty($this->PostedDatas['classroom'])? $this->PostedDatas['classroom']: null), (isset($this->PostedDatas['_FILES_']) && !empty($this->PostedDatas['_FILES_'])? $this->PostedDatas['_FILES_']: null)); $this->views->SetPushMessage((!$cb? 'UPDATE_STUDENT_ERROR': 'UPDATE_STUDENT_SUCCES'), (!$cb? 'error': 'success')); }
        $ClientAuth = $this->views->ClientAuth;
        if ($auth && !empty($ClientAuth) || !$auth) {
            $students = $this->Students->GetStudents((!empty($student)? $student: null));
            $this->views->header(true);
            $this->views->load(($injection == 'add-student'? 'add-student': 'student'), [ 'students' => (!empty($student)? (!empty($students[0])? $students[0]: null): $students), 'single' => (!empty($student)? true: false), 'classroom' => function($classroom = null) { return $this->Classroom->GetClassrooms($classroom); } , 'options' => $this->Students->GetOptions(), 'diets' => $this->Students->GetDiets(), 'injection' => $injection, 'students_number' => function($classroom = null) { return $this->Students->GetStudentsNumber($classroom); } ]);
            $this->views->footer(true);
        } else {
            header('Location: /connexion/');
        }
    }

}

?>