<?php

namespace Controllers;

class Dashboard {

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

    public function index() {
        $IsDashboard = (!empty($this->views->ClientAuth? true: false));
        (!$IsDashboard? $this->views->SetSubsite(null): null);
        $this->views->header();
        $this->views->load(($IsDashboard? 'dashboard': 'welcome'), (!$IsDashboard? [ 'GetChangelogs' => $this->GetChangelogs(), 'licence' => $this->GetLicence() ]: [ 'students' => function($classroom = null) { return $this->Students->GetStudentsNumber($classroom); }, 'classrooms' => function($classroom = null) { return $this->Classroom->GetClassroomsNumber($classroom); } ]));
        $this->views->footer();
    }

    private function GetLicence(): string {
        $licence = file_get_contents(realpath(__DIR__ . '/../..') . '/LICENCE');
        return $licence;
    }

    private function GetChangelogs() {
        $changelogs = file_get_contents(realpath(__DIR__ . '/../..') . '/CHANGELOGS.md');
        $Parsedown = new \Parsedown();
        return $Parsedown->text($changelogs);
    }

}

?>