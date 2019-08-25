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
        $dashboard = (!empty($this->views->GetAuth()? true: false));
        $this->views->header($dashboard);
        $this->views->load(($dashboard? 'dashboard': 'welcome'), (!$dashboard? [ 'licence' => $this->GetLicence() ]: [ 'students' => function($classroom = null) { return $this->Students->GetStudentsNumber($classroom); }, 'classrooms' => function($classroom = null) { return $this->Classroom->GetClassroomsNumber($classroom); } ]));
        $this->views->footer($dashboard);
    }

    private function GetLicence(): string {
        $lien = 'https://raw.githubusercontent.com/SimonOriginal/lcdb-manager/master/LICENSE';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $lien);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($curl);
        curl_close($curl);
        return $return;
    }

}

?>