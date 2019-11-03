<?php

namespace Controllers;

class Options {

    private $views;
    private $view;
    private $databases;
    private $Options;
    private $PostedFiles;
    private $Students;
    
    public function __construct(\App\Router\views $views, \App\Databases $Databases, \App\Core\OptionsManager $Options, \App\Core\StudentsManager $Students) {
        $this->db           = function() use ($Databases) { return $Databases->PDO($Databases->databases['website']); };
        $this->views        = $views;
        $this->Options      = $Options;
        $this->Students     = $Students;
    }

    public function AddDiet($subsite, $method, $slug) {
        $ClientAuth = $this->views->ClientAuth;
        if (!empty($ClientAuth)) {
            if ($method == 'POST') {
                $cb = $this->Options->CreateDiet($_POST);
                $this->views->SetPushMessage((!$cb? 'CREATE_DIET_ERROR': 'CREATE_DIET_SUCCESS'), (!$cb? 'error': 'success'));
            }
            $this->CreateView('add-diet');
        } else {
            header('Location: /connexion/');
        }
    }

    public function AddOpts($subsite, $method, $slug) {
        $ClientAuth = $this->views->ClientAuth;
        if (!empty($ClientAuth)) {
            if ($method == 'POST') {
                $cb = $this->Options->CreateOption($_POST);
                $this->views->SetPushMessage((!$cb? 'CREATE_OPTION_ERROR': 'CREATE_OPTION_SUCCESS'), (!$cb? 'error': 'success'));
            }
            $this->CreateView('add-option');
        } else {
            header('Location: /connexion/');
        }
    }
    
    public function DeleteOpts($subsite, $method, $slug) {
        $this->Options->RemoveOption($slug);
        header('Location: /ajouter-option/');
    }

    private function CreateView(string $view) {
        $this->views->header();
        $this->views->load($view, [ 'options' => function() { return $this->Students->GetOptions(); } , 'diets' => function() { return $this->Students->GetDiets(); } ]);
        $this->views->footer();
    }

}

?>