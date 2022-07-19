<?php
namespace App\Controllers;

use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\ModeleCommande;
use App\Models\ModeleLigne;

helper(['url', 'assets']);

class AdministrateurEmploye extends BaseController
{
    public function afficherClients()
    {
        $modelCli = new ModeleClient();
        $data['clients'] = $modelCli->retournerClients();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/afficherClients');
        echo view('templates/footer');
    }

    public function historiqueCommandes($noclient = null)
    {
        // if ($noclient == null) {
        //     return redirect()->to('AdministrateurEmploye/afficher_les_clients');
        // }
        $modelCli = new ModeleClient();
        $data['client'] = $modelCli->retournerClientNumero($noclient);
        $modelComm = new ModeleCommande();
        $data['commandes'] = $modelComm->retournerCommandesClient($noclient);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/historiqueCommandes');
        echo view('templates/footer');
    }

    public function detailsCommande($noCommande = false)
    {
        if (empty($noCommande)) {
            return redirect()->to('AdministrateurEmploye/historiqueCommandes');
        }
        $modelComm = new ModeleCommande();
        $data['commande'] = $modelComm->retournerCommande($noCommande);
        $modelLig = new ModeleLigne();
        $data['lignes'] = $modelLig->retournerLignes($noCommande);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/detailsCommande');
        echo view('templates/footer');
    }
    public function commandesNonTraitees()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelComm = new ModeleCommande();
        $data['commandes'] = $modelComm->retournerCommandesNonTraitees();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/commandesNonTraitees');
        echo view('templates/footer');
    }

    public function commandeTraitees($nocommande)
    {
        helper('date');
        $modelClient = new ModeleClient();
        $modelComm = new ModeleCommande();
        $modelLigne = new ModeleLigne();
        $modelComm->update($nocommande,array('DATETRAITEMENT' => @date('Y-m-d H:i:s')));
        $data['produits'] = $modelLigne->retournerLignes($nocommande);
        $data['commande'] = $modelComm->retournerCommande($nocommande);
        $data['client'] = $modelClient->retournerClientNumero($data['commande']['NOCLIENT']);
        $data['titre'] = 'Votre commande vient d\'être expédiée';
        //echo view('AdministrateurEmploye/commande_traitee',$data);
        $message = view('AdministrateurEmploye/commandeTraitees',$data);
        $email = \Config\Services::email();
        $email->setFrom('chopesgames.110@gmail.com', 'ChopesGames');
        $email->setTo($data['client']['EMAIL']);
        $email->setSubject('Facture Chopes Game');
        $email->setMessage($message);
        $email->send();
        return redirect()->to('AdministrateurEmploye/commandesNonTraitees');
    }
}
