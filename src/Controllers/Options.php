<?php

namespace Controllers;

class Options {

    private $views;
    private $view;
    private $databases;
    private $Options;
    private $PostedFiles;
    
    public function __construct(\App\Router\views $views, \App\Databases $Databases, \App\Core\OptionsManager $Options) {
        $this->db           = function() use ($Databases) { return $Databases->PDO($Databases->databases['website']); };
        $this->views        = $views;
        $this->Options      = $Options;
        $this->PostedDatas  = (isset($_POST) && !empty($_POST)? $_POST: false);
    }

    public function index($type, $null, $auth, $injection) {
        if ($type == 'POST' && $injection == 'add-option') { $cb = $this->Options->CreateOption($this->PostedDatas); $this->views->SetPushMessage((!$cb? 'CREATE_OPTION_ERROR': 'CREATE_OPTION_SUCCESS'), (!$cb? 'error': 'success')); }
        if ($type == 'POST' && $injection == 'add-diet') { $cb = $this->Options->CreateDiet($this->PostedDatas); $this->views->SetPushMessage((!$cb? 'CREATE_DIET_ERROR': 'CREATE_DIET_SUCCESS'), (!$cb? 'error': 'success')); }
        $ClientAuth = $this->views->ClientAuth;
        if ($auth && !empty($ClientAuth) || !$auth) {
            $this->views->header(true);
            $this->views->load($injection);
            $this->views->footer(true);
        } else {
            header('Location: /connexion/');
        }
    }

}

?>