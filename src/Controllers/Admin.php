<?php

namespace Controllers;

class Admin {

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

    public function dashboard($subsite, $method, $slug) {
        $ClientAuth = $this->views->ClientAuth;
        if (!empty($ClientAuth)) {
            $this->views->header(true);
            $this->views->load('admin/dashboard', [ ]);
            $this->views->footer(true);
        } else {
            header('Location: /connexion/');
        }
    }

}

?>