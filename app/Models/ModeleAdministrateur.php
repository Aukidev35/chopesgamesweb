<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleAdministrateur extends Model
{

    protected $table = 'administrateur';
    protected $allowedFields = ['IDENTIFIANT', 'EMAIL', 'PROFIL', 'MOTDEPASSE'];
    protected $primaryKey = 'IDENTIFIANT';

    public function retournerAdministrateur($identifiant, $MotDePasse)
    {
        return $this->where(['IDENTIFIANT' => $identifiant, 'MOTDEPASSE' => $MotDePasse])
            ->first();
    }

    public function retournerAdministrateurID($idadmin)
    {
        return $this->where(['IDENTIFIANT' => $idadmin])
            ->first();
    }


    function retournerAdministrateursEmployes()
    {
        return $this->where(['PROFIL' => 'Employé'])
            ->findAll();
    }

    function retournerAdministrateurEmail($mail)
    {
        return $this->where(['EMAIL' => $mail])
            ->first();
    }
}
