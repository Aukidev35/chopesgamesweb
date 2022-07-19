<?php
namespace App\Controllers;
use App\Models\ModeleProduit;
use App\Models\ModeleAdministrateur;
use App\Models\ModeleCategorie;
use App\Models\ModeleIdentifiant;
use App\Models\ModeleMarque;
use App\Models\ModeleNouvelles;
use App\Models\ModeleAbonnes;
use app\Config\Email;

helper(['url', 'assets', 'form']);

class AdministrateurSuper extends BaseController
{

    public function ajouterProduit($prod = false)
    {
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();
        $data['TitreDeLaPage'] = 'Ajouter un produit';

        $rules = [ //régles de validation creation
            'Categorie' => 'required',
            'Marque' => 'required',
            'txtLibelle' => 'required',
            'txtDetail'    => 'required',
            'txtPrixHT' => 'required',
            'txtQuantite' => 'required',
            'txtNomimage' => 'required',
            'image' => [
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg]',
                'max_size[image,1024]',
            ]
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                if($prod==false) {
                    $data['TitreDeLaPage'] = 'Ajouter un produit';
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }
                
            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouterProduit');
            echo view('templates/footer');
        } else // si formulaire valide
        {


            $donneesAInserer = array(
                'NOCATEGORIE' => $this->request->getPost('Categorie'),
                'NOMARQUE' => $this->request->getPost('Marque'),
                'LIBELLE' => $this->request->getPost('txtLibelle'),
                'DETAIL' => $this->request->getPost('txtDetail'),
                'PRIXHT' => $this->request->getPost('txtPrixHT'),
                'TAUXTVA' => (($this->request->getPost('txtPrixHT') * 20) / 100),
                'NOMIMAGE' => pathinfo($this->request->getPost('txtNomimage'), PATHINFO_FILENAME), // on n'insère que le nom du fichier dans la BDD
                'QUANTITEENSTOCK' => $this->request->getPost('txtQuantite'),
                'DATEAJOUT' => date("Y-m-d"),
                'DISPONIBLE' => 0,
            );

            if ($this->request->getPost('txtQuantite') > 0) $donneesAInserer['DISPONIBLE'] = 1;

            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $this->request->getPost('txtNomimage') . '.jpg';
                    $img->move('assets/images/', $newName);
                    print_r($donneesAInserer);
                    $modelProd = new ModeleProduit();
                    $modelProd->save($donneesAInserer);
                    
                    return redirect()->to('visiteur/listerProduits');
                }
            }
            //else redirecte ??
        }
    }

    public function rendreIndisponible($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/listerProduits');
        }

        $donneesAInserer = array(
            'DISPONIBLE' => 0
        );
        $modelProd = new ModeleProduit();
        $modelProd->update($noProduit, $donneesAInserer);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function rendreDisponible($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/listerProduits');
        }
        $donneesAInserer = array(
            'DISPONIBLE' => 1
        );
        $modelProd = new ModeleProduit();
        $modelProd->update($noProduit, $donneesAInserer);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function modifierProduit($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/listerProduits');
        }
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();
        $modelProd = new ModeleProduit();
        $data['TitreDeLaPage'] = 'Modifier un produit';

        $rules = [ //régles de validation creation
            'Categorie' => 'required',
            'Marque' => 'required',
            'txtLibelle' => 'required',
            'txtDetail'    => 'required',
            'txtPrixHT' => 'required',
            'txtQuantite' => 'required',
            'txtNomimage' => 'required',
            'vitrine' => '',
        ];

        if (!$this->validate($rules)) {
            if($_POST)$data['TitreDeLaPage'] = 'Corriger votre formulaire';
            $produit =  $modelProd->retournerProduits($noProduit);
            $data['noProduit'] = $produit['NOPRODUIT'];
            $data['Categorie'] = $produit['NOCATEGORIE'];
            $data['Marque'] = $produit['NOMARQUE'];
            $data['txtLibelle'] = $produit['LIBELLE'];
            $data['txtDetail'] = $produit['DETAIL'];
            $data['txtPrixHT'] = $produit['PRIXHT'];
            $data['txtNomimage'] = $produit['NOMIMAGE'];
            $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
            $data['vitrine'] = $produit['VITRINE'];
            
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifierProduit');
            echo view('templates/footer');
        } else {

            $donneesAInserer = array(
                'NOCATEGORIE' => $this->request->getPost('Categorie'),
                'NOMARQUE ' => $this->request->getPost('Marque'),
                'LIBELLE' => $this->request->getPost('txtLibelle'),
                'DETAIL' => $this->request->getPost('txtDetail'),
                'PRIXHT' => $this->request->getPost('txtPrixHT'),
                'TAUXTVA' => (($this->request->getPost('txtPrixHT') * 20) / 100),
                'DATEAJOUT' => date("Y-m-d"),
                'NOMIMAGE' => $this->request->getPost('txtNomimage'),
                'QUANTITEENSTOCK' => $this->request->getPost('txtQuantite'),
                'VITRINE' => 0
            );

            if ($this->request->getPost('checkbox') == 1) {$donneesAInserer['VITRINE']=1;} 
            
            $modelProd->update($noProduit, $donneesAInserer);

            return redirect()->to('visiteur/listerProduits');
        }
    }

    function modifierIdentifiantsBancaires()
    {
        $modelIdent = new ModeleIdentifiant();
        $data['identifiant'] = $modelIdent->retournerIdentifiant();

        $rules = [ //régles de validation creation
            'txtSite' => 'required',
            'txtRang' => 'required',
            'txtIdentifiant' => 'required',
            'txtHmac'    => 'required',
        ];


        if (!$this->validate($rules)) {
            $modelCat = new ModeleCategorie();
            $data['categories'] = $modelCat->retournerCategories();
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifierIdentifiantsBancaires');
            echo view('templates/footer');
        } else {

            $donneesAInserer = array(
                'SITE' => $this->request->getPost('txtSite'),
                'RANG' => $this->request->getPost('txtRang'),
                'IDENTIFIANT' => $this->request->getPost('txtIdentifiant'),
                'CLEHMAC' => $this->request->getPost('txtHmac'),
                'SITEENPRODUCTION' => 0
            );

            if ($this->request->getPost('checkbox') == 1) {
                $donneesAInserer['SITEENPRODUCTION'] = 1;
            }

            $modelIdent->update(1, $donneesAInserer);
            return redirect()->to('visiteur/listerProduits');
        }
    }

    public function ajouterCategorie()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();
        $rules = ['txtcategorie' => 'required'];

        if (!$this->validate($rules)) 
        {
            if ($_POST)
            { 
                $data['TitreDeLaPage'] = 'Corriger votre formulaire';
            }
            else 
            {
                $data['TitreDeLaPage'] = 'Ajouter une catégorie';
            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouterCategorie');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array('LIBELLE' => $this->request->getPost('txtcategorie'));
            $modelCat->save($donneesAInserer);
            return redirect()->to('visiteur/listerProduits');
        }
    }

    public function ajouterMarque()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();
        $rules = ['txtmarque' => 'required'];

        if (!$this->validate($rules)) {
            if ($_POST)
            {
                 $data['TitreDeLaPage'] = 'Corriger votre formulaire';
            }
            else 
            {
                $data['TitreDeLaPage'] = 'Ajouter une marque';
            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouterMarque');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'NOM' => $this->request->getPost('txtmarque')
            );
            $modelMarq->save($donneesAInserer);
            return redirect()->to('visiteur/listerProduits');
        }

    }

    public function ajouterAdmin()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();
        $modelAdmin = new ModeleAdministrateur();
        $rules = [
            'txtIdentifiant' => 'required',
            'txtMotDePasse' => 'required',
            'txtEmail' => 'required'
        ];

        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire';
            else {
                $data['TitreDeLaPage'] = 'Ajouter un administrateur';

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouterAdmin');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'IDENTIFIANT' => $this->request->getPost('txtIdentifiant'),
                'EMAIL' => $this->request->getPost('txtEmail'),
                'MOTDEPASSE' => $this->request->getPost('txtMotDePasse'),
                'PROFIL' => 'Employé'
            );
            $modelAdmin->insert($donneesAInserer);
            return redirect()->to('visiteur/listerProduits');
        }
    }
    public function listerAdmin()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();
        $modelAdmin = new ModeleAdministrateur();
        $data['admin'] = $modelAdmin->retournerAdministrateursEmployes();
        $data['TitreDeLaPage'] = 'Liste des administrateurs';
        echo view('templates/header', $data);
        echo view('AdministrateurSuper/listeAdmin');
        echo view('templates/footer');
    }
    public function modifierAdmin($id)
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();
        $modelAdmin = new ModeleAdministrateur();
        $data['admin'] = $modelAdmin->retournerAdministrateurID($id);
        $rules = [
            'txtMotDePasse' => 'required',
            'txtEmail' => 'required'
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; 
            else {
                $data['TitreDeLaPage'] = 'Modifier un administrateur';
            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifierAdmin');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'EMAIL' => $this->request->getPost('txtEmail'),
                'MOTDEPASSE' => $this->request->getPost('txtMotDePasse'),
            );
            $modelAdmin->update($id,$donneesAInserer);
            return redirect()->to('visiteur/listerProduits');
        }
    }
    public function supprimerAdmin($id)
    {
        $modelAdmin = new ModeleAdministrateur();
        $modelAdmin->delete($id);
        return redirect()->to('AdministrateurSuper/listerAdmin');
    }
    public function saisiNewsletter()
    {
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();
        $modelenouv = new ModeleNouvelles();
        $rules = [
            'txtObjet' => 'required',
            'txtTitre' => 'required',
            'txtMessage' => 'required'
        ];
        if (!$this->validate($rules)) 
        {
            if ($_POST)
            { 
                $data['TitreDeLaPage'] = 'Corriger votre formulaire';
            }
            else 
            {
                $data['TitreDeLaPage'] = 'Saisie newsletter';
            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/newsletter');
            echo view('templates/footer');
        }
        else
        {
            $donneesAInserer = array(
                'OBJET' => $this->request->getPost('txtObjet'),
                'TITRE' => $this->request->getPost('txtTitre'),
                'MESSAGE' => $this->request->getPost('txtMessage')
            );
            $modelenouv->save($donneesAInserer);//
            $this->sendEmail($modelenouv->getInsertID());
            return redirect()->to('visiteur/listerProduits');           
        }
    }
    public function sendEmail($idData = 'nouveau',$user = 'all')
    {
        $modeleabonnes = new ModeleAbonnes();
        $modelenouv = new ModeleNouvelles();
        $email = \Config\Services::email();
        
        if($idData == 'nouveau')
        {
            $DataMail = $modelenouv->nouvelle();
        }
        else
        {
            $DataMail = $modelenouv->nouvelle($idData);
        }
        foreach($modeleabonnes->returnAbonnes($user) as $abonne)
        {
            $email->setFrom('shopesgames.110@gmail.com', 'Le mois chopesgames');
            $email->setSubject($DataMail['OBJET']);
            $email->setMessage($DataMail['MESSAGE']);
            $email->setTo($abonne['email']);            
        }
    }
    public function saveAbonnes()
    {
        $modelabonnes = new ModeleAbonnes();
        $rules = ['txtmail' => 'required|trim|is_unique[abonnes.email]|valid_email'];
        if (!$this->validate($rules)) {
        }else{
            $modelabonnes->save(['email' => $this->request->getPost('txtmail')]);
            $this->sendEmail('nouveau',$this->request->getPost('txtmail'));
        }
        return redirect()->to('visiteur/listerProduits');
    }
}
