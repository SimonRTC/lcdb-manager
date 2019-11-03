<?php

namespace App\Core;

class StudentsManager {

    private $db;

    public function __construct(\App\Databases $Databases) {
        $this->db           = function() use ($Databases) { return $Databases->PDO($Databases->databases['website']); };
    }

    private function RequestStudentIdentifier(): string {
        $students   = $this->GetStudents();
        $browse     = true;
        while ($browse) {
            $random         = $this->RandomString(16);
            $AlreadyUsed    = false;
            foreach ($students as $student) {
                if ($student['identifier'] == $random) {
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

    private function GetBase64Image(array $picture) {
        if (isset($picture['picture']['tmp_name']) && !empty($picture['picture']['tmp_name'])) {
            $size       = getimagesize($picture['picture']['tmp_name']);
            if ($size) {
                $path = $picture['picture']['tmp_name'];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                return $base64;
            }
        }
        return false;
    }

    public function GetDiets(string $id = null): array {
        $db         = $this->db;
        $request    = $db()->query('SELECT * FROM `diets`' . (!empty($id)? ' WHERE `id` = "' . $id . '"': null));
        $return     = [];
        while ($data = $request->fetch()) {
            array_push($return, $data);
        }
        return (!$return? []: $return);
    }

    public function GetOptions(string $id = null): array {
        $db         = $this->db;
        $request    = $db()->query('SELECT * FROM `options`' . (!empty($id)? ' WHERE `id` = "' . $id . '"': null));
        $return     = [];
        while ($data = $request->fetch()) {
            array_push($return, $data);
        }
        return (!$return? []: $return);
    }

    public function GetStudents(string $student = null, string $classroom = null, bool $count = false) {
        $db         = $this->db;
        $request    = $db()->query('SELECT * FROM `students`' . (!empty($student) || !empty($classroom)? ' WHERE': null) . (!empty($student)? ' `identifier` = "' . $student . '" ': null). (!empty($classroom)? ' `classroom` = "' . $classroom . '" ': null));
        if (!$count) {
            $return     = [];
            while ($data = $request->fetch()) {
                $data['profile'] = json_decode(base64_decode($data['profile']), true);
                array_push($return, $data);
            }
        } else {
            $return = $request;
        }
        return (!$return? []: $return);
    }

    public function GetStudentsNumber(string $classroom = null): int {
        $student    = $this->GetStudents(null, $classroom, true);
        $student    = $student->rowCount();
        return (!$student? 0: $student);
    }

    public function CreateStudent(array $student, ?array $picture = null): bool {
        $name       = htmlspecialchars((!empty($student['firstname'])? $student['firstname']: null)) . ' ' . htmlspecialchars((!empty($student['lastname'])? $student['lastname']: null));
        $picture    = (!empty($picture)? $this->GetBase64Image($picture): null);
        $diet       = (!empty($student['diet'])? htmlspecialchars($student['diet']): null);
        $options    = [];
        foreach ($this->GetOptions() as $option) { foreach ($student as $k=>$posted) { if ($k == $option['id']) { array_push($options, [ 'id' => $k, 'active' => ($posted == "true"?  true: false) ]); break; } } }
        
        $profile    = [
            'firstname'     => $name,
            'lastname'      => null,
            'diet'          => $diet,
            'options'       => $options
        ];
        $profile    = base64_encode(json_encode($profile, true));
        $db         = $this->db;
        $request    = $db()->prepare('INSERT INTO `students` (`identifier`, `classroom`, `profile`, `picture`, `creation_date`, `own`) VALUES (:identifier, :classroom, :profile, :picture, :creation_date, :own)');
        $request    = $request->execute([
            'identifier'    => $this->RequestStudentIdentifier(),
            'classroom'     => $student['classroom'],
            'profile'       => $profile,
            'picture'       => (!empty($picture)? $picture: null),
            'creation_date' => date('Y-m-d H:i:s'),
            'own'           => 1
        ]);
        return (!$request? false: true);
    }

    public function UpdateStudent(string $identifier, array $POST = null, string $classroom = null, array $picture = null): bool {
        if (empty($picture)) {
            if (!empty($POST)) {
                $names      = (!empty($POST['editnames'])? htmlspecialchars($POST['editnames']): null);
                $diet       = (!empty($POST['diet'])? htmlspecialchars($POST['diet']): null);
                $options    = [];
                foreach ($this->GetOptions() as $option) { foreach ($POST as $k=>$posted) { if ($k == $option['id']) { array_push($options, [ 'id' => $k, 'active' => ($posted == "true"?  true: false) ]); break; } } }
                if (!empty($diet)) {
                    $profile    = [
                        'firstname'     => $names,
                        'lastname'      => null,
                        'diet'          => $diet,
                        'options'       => $options
                    ];
                    $profile = base64_encode(json_encode($profile, true));
                }
                $sql = 'UPDATE `students` SET `profile` = :profile WHERE identifier = :identifier';
            } else {
                $sql = 'UPDATE `students` SET `classroom` = :classroom WHERE identifier = :identifier';
            }
        } else {
            $picture = $this->GetBase64Image($picture);
            if ($picture) {
                $sql = 'UPDATE `students` SET `picture` = :picture WHERE identifier = :identifier';
            } else {
                return false;
            }
        }
        $db         = $this->db;
        $request    = $db()->prepare($sql);
        if (empty($POST) && empty($picture)) {
            $exec = [ 'classroom' => $classroom, 'identifier' => $identifier ];
        } elseif (!empty($profile) && empty($picture)) {
            $exec = [ 'profile' => $profile, 'identifier' => $identifier ];
        } elseif (!empty($picture)) {
            $exec = [ 'picture' => $picture, 'identifier' => $identifier ];
        }
        $response = $request->execute($exec);
        return (!$response? false: true);
    }

}

?>