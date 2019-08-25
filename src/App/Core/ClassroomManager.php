<?php

namespace App\Core;

class ClassroomManager {

    private $db;

    public function __construct(\App\Databases $Databases) {
        $this->db           = function() use ($Databases) { return $Databases->PDO($Databases->databases['website']); };
    }

    private function RequestClassroomIdentifier(): string {
        $classrooms = $this->GetClassrooms();
        $browse     = true;
        while ($browse) {
            $random         = $this->RandomString(16);
            $AlreadyUsed    = false;
            foreach ($classrooms as $classroom) {
                if ($classroom['identifier'] == $random) {
                    $AlreadyUsed = true;
                    break;
                }
            }
            (!$AlreadyUsed ? $browse = false: $browse = true);
        }
        return $random;
    }

    private function RandomString(int $length, string $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function CreateClassroom(array $classroom) {
        $name       = htmlspecialchars($classroom['classroom']);
        $db         = $this->db;
        $request    = $db()->prepare('INSERT INTO `classrooms` (`identifier`, `name`, `creation_date`, `own`) VALUES (:identifier, :name, :creation_date, :own)');
        $request    = $request->execute([
            'identifier'    => $this->RequestClassroomIdentifier(),
            'name'          => $classroom['classroom'],
            'creation_date' => date('Y-m-d H:i:s'),
            'own'           => 1
        ]);
        return (!$request? false: true);
    }

    public function GetClassrooms(string $classroom = null, bool $count = false) {
        $db         = $this->db;
        $request    = $db()->query('SELECT * FROM `classrooms`' . (!empty($classroom)? ' WHERE `identifier` = "' . $classroom . '"': null));
        if (!$count) {
            $return     = [];
            while ($data = $request->fetch()) {
                array_push($return, $data);
            }
        } else { $return = $request; }
        return (!$return? []: $return);
    }

    public function GetClassroomsNumber(string $classroom = null): int {
        $classroom    = $this->GetClassrooms($classroom, true);
        $classroom    = $classroom->rowCount();
        return (!$classroom? 0: $classroom);
    }

}

?>