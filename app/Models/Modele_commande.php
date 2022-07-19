<?php

namespace App\Models;

use CodeIgniter\Model;

class Modele_commande extends Model
{
    protected $table = 'commande';
    protected $allowedFields = ['NOCLIENT', 'DATECOMMANDE', 'TOTALHT', 'TOTALTTC', 'DATETRAITEMENT'];
    protected $primaryKey = 'NOCOMMANDE';

   public function retournerCommande($nocommande)
   {
    return $this->where(['NOCOMMANDE' => $nocommande])
       ->join('client', 'client.NOCLIENT = commande.noclient')
       ->first();
   }

//    public function modifier_commande($nocommande,$pDonneesAInserer)
//    {
//     $this->db->where('NOCOMMANDE', $nocommande);
//     $this->db->update('commande', $pDonneesAInserer);
//    }

   public function retournerCommandesClient($noclient)
   {
    return $this->where(['commande.NOCLIENT' => $noclient])
       ->join('client', 'client.NOCLIENT = commande.noclient')
       ->findAll();
   }

   public function controleCommande($noclient)
   {
      return $this->where(['commande.NOCLIENT' => $noclient])
      ->join('client', 'client.NOCLIENT = commande.noclient')
      ->findAll();
   }
      
} 