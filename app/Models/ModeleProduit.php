<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleProduit extends Model
{

    protected $table = 'produit';
    protected $allowedFields = ['NOPRODUIT ', 'NOCATEGORIE', 'NOMARQUE', 'LIBELLE', 'DETAIL', 'PRIXHT', 'TAUXTVA', 'NOMIMAGE', 'QUANTITEENSTOCK', 'DATEAJOUT', 'DISPONIBLE', 'VITRINE'];
    protected $primaryKey = 'NOPRODUIT';


    public function retournerProduits($pNoArticle = false)
    {
        if ($pNoArticle === false) {
            return $this->findAll();
        }

        return $this->where(['NOPRODUIT' => $pNoArticle])->first();
    }

    public function retournerVitrine()
    {
        return $this->where(['VITRINE' => 1])
            ->findAll();
    }

    public function produitsSearch($match)
    {
        return $this->like('LIBELLE', $match, 'both');
    }

    public function insererProduit($pDonneesAInserer)
    {
        return $this->insert($pDonneesAInserer);
    }

    public function retounerProduitsMarque($nomarque)
    {
        return $this->where(['NOMARQUE' => $nomarque]);
    }

    public function retounerProduitsCategorie($categorie)
    {
        return $this->where(['NOCATEGORIE' => $categorie]);
    }
    public function retournerSlug($id)
    {
        //return $this->select('NOMIMAGE')->where(['NOPRODUIT' => $id])->first();
        return $this->select('NOMIMAGE', 'NOMMARQUE')->join('marque', 'marque.NOMARQUE = produit.NOMARQUE')->where(['NOPRODUIT' => $id])->first();
    }
    public function retournerId($slug)
    {
        //return $this->select('NOPRODUIT')->where(['NOMIMAGE' => $slug])->first();
        return $this->select('NOPRODUIT')->where(['NOMIMAGE' => $slug])->first();
    }
    public function retournerNom($slug)
    {
        //return $this->select('NOPRODUIT')->where(['NOMIMAGE' => $slug])->first();
        return $this->select('NOPRODUIT')->where(['NOMARQUE' => $slug])->first();
    }
}