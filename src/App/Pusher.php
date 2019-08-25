<?php

namespace App;

class Pusher {

    public $Notification;
    public $Type;

    public function __construct() {
        $this->Notification     = null;
        $this->Type             = null;
    }

    private function GetMessage(string $code): string {
        $parse      = file_get_contents( realpath(__DIR__ . '/..') . '/config/push.json' );
        $parse      = json_decode($parse, true);
        $message    = null;
        foreach ($parse as $key=>$m) {
            if ($code == $key) {
                $message = $m;
            }
        }
        return $message;
    }

    public function SetNotification(string $code, string $type = 'danger') {
        $this->Notification     = $this->GetMessage($code);
        $this->Type             = $type;
    }
}

?>