<?php

namespace App\Core;

class OptionsManager {

    private $db;

    public function __construct(\App\Databases $Databases) {
        $this->db           = function() use ($Databases) { return $Databases->PDO($Databases->databases['website']); };
    }

    private function RequestOptionsId(bool $IsDiet): string {
        $callback   = ($IsDiet? $this->GetDiets() :$this->GetOptions());
        $browse     = true;
        while ($browse) {
            $random         = $this->RandomString(10);
            $AlreadyUsed    = false;
            foreach ($callback as $cb) {
                if ($cb['id'] == $random) {
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

    public function RemoveOption(string $id, bool $display = false): bool {
        $db = $this->db;
        $request = $db()->prepare("UPDATE `options` SET `display` = :display WHERE `id` = :id");
        $result = $request->execute([ 'display' => ($display? 1: 0), 'id' => $id ]);
        return ($result? true: false);
    }

    public function CreateOption(array $option) {
        $name       = htmlspecialchars($option['option']);
        $db         = $this->db;
        $request    = $db()->prepare('INSERT INTO `options` (`id`, `name`, `creation_date`, `own`, `display`) VALUES (:id, :name, :creation_date, :own, 1)');
        $request    = $request->execute([
            'id'            => $this->RequestOptionsId(false),
            'name'          => $option['option'],
            'creation_date' => date('Y-m-d H:i:s'),
            'own'           => 1
        ]);
        return (!$request? false: true);
    }

    public function CreateDiet(array $diet) {
        $name       = htmlspecialchars($diet['diet']);
        $db         = $this->db;
        $request    = $db()->prepare('INSERT INTO `diets` (`id`, `name`, `creation_date`, `own`) VALUES (:id, :name, :creation_date, :own)');
        $request    = $request->execute([
            'id'            => $this->RequestOptionsId(true),
            'name'          => $diet['diet'],
            'creation_date' => date('Y-m-d H:i:s'),
            'own'           => 1
        ]);
        return (!$request? false: true);
    }

    public function GetOptions(string $id = null, bool $count = false) {
        $db         = $this->db;
        $request    = $db()->query('SELECT * FROM `options`' . (!empty($classroom)? ' WHERE `id` = "' . $id . '"': null));
        if (!$count) {
            $return     = [];
            while ($data = $request->fetch()) {
                array_push($return, $data);
            }
        } else { $return = $request; }
        return (!$return? []: $return);
    }

    public function GetDiets(string $id = null, bool $count = false) {
        $db         = $this->db;
        $request    = $db()->query('SELECT * FROM `diets`' . (!empty($classroom)? ' WHERE `id` = "' . $id . '"': null));
        if (!$count) {
            $return     = [];
            while ($data = $request->fetch()) {
                array_push($return, $data);
            }
        } else { $return = $request; }
        return (!$return? []: $return);
    }

    public function GetOptionsNumber(string $id = null): int {
        $options    = $this->GetOptions($id, true);
        $options    = $options->rowCount();
        return (!$options? 0: $options);
    }

    public function GetDietsNumber(string $id = null): int {
        $diets      = $this->GetDiets($id, true);
        $diets      = $diets->rowCount();
        return (!$diets? 0: $diets);
    }

    
}

?>