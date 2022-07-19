<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleClient extends Model
{

    protected $table = 'client';
    protected $allowedFields = ['NOCLIENT', 'NOM', 'PRENOM', 'ADRESSE', 'VILLE', 'CODEPOSTAL', 'EMAIL', 'MOTDEPASSE'];
    protected $primaryKey = 'NOCLIENT';

    public function retournerClientParMail($mail = false)
    {
        return $this->where(['EMAIL' => $mail])
            ->first();
    }

    public function retournerClientNumero($noclient)
   {
  return $this->where(['NOCLIENT' => $noclient])->first(); 
   } 

   public function retournerClients()
   {
  return $this->findAll();
   } 

    public function supprimerClient($mail)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('client');
        
        $data = [
            'NOM' => null,
            'PRENOM'  => null,
            'ADRESSE'  => null,
            'VILLE'  => null,
            'CODEPOSTAL'  => null,
            'EMAIL'  => null,
            'MOTDEPASSE'  => null
        ];
         
        $builder->set($data);
        $builder->where('EMAIL', $mail);
        $builder->update();
    }

}
