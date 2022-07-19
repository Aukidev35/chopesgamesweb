<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleLigne extends Model
{
    protected $table = 'ligne';
    protected $allowedFields = ['NOCOMMANDE', 'NOPRODUIT', 'QUANTITECOMMANDEE'];


   public function ajouterLigne($pDonneesAInserer)
    {
       //return $this->db->insert('ligne', $pDonneesAInserer);
       $this->db->table('ligne')->insert($pDonneesAInserer);
    }

   public function retournerLignes($nocommande)
   {
      return $this->where(['NOCOMMANDE' => $nocommande])
      ->join('produit', 'produit.noproduit = ligne.noproduit')
      ->findAll();
   }
} 