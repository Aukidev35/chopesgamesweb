<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeleProduit;
use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\ModeleMarque;
use App\Models\ModeleAdministrateur;
//use App\Models\ModeleAdministrateur;
//$pager = \Config\Services::pager();
helper(['url', 'assets']);
class Visiteur extends BaseController
{

    public function accueil()
    {
        $modelProd = new ModeleProduit();
        $data['vitrines'] = $modelProd->retournerVitrine();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();

        echo view('templates/header', $data);
        echo view('visiteur/accueil');
        echo view('templates/footer');
    }

    public function listerProduits()
    {
        $session = session();
        $pager = \Config\Services::pager();
        $match = esc($this->request->getPost('search')); // fonction recherche integrée
        $modelProd = new ModeleProduit();
        if (empty($match)) {
            $data['lesProduits'] = $modelProd->paginate(12);
        } else {
            $data['lesProduits'] = $modelProd->produitsSearch($match)->paginate(12);
        }
        $data['pager'] = $modelProd->pager;
        $data['TitreDeLaPage'] = 'Nos produits';
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retournerMarques();

        echo view('templates/header', $data);
        echo view("visiteur/listerProduits");
        echo view('templates/footer');
    }

    public function listerProduitsMarque($nomarque=false)
    {
        if ($nomarque == false) {
            return redirect()->to('Visiteur/listerProduits');
        } else {
            $session = session();
            $pager = \Config\Services::pager();
            $modelMarq = new ModeleMarque();
            $marque = $modelMarq->retournerMarques($nomarque);
            
            $data['lamarque'] = $marque["NOMARQUE"];
            $data['TitreDeLaPage'] = $marque["NOM"];
            $modelCat = new ModeleCategorie();
            $data['categories'] = $modelCat->retournerCategories();
            $modelProd = new ModeleProduit();
            $data["lesProduits"] = $modelProd->retounerProduitsMarque($nomarque)->paginate(12);
            $data['pager'] = $modelProd->pager;
            $modelMarq = new ModeleMarque();
            $data['marques'] = $modelMarq->retournerMarques();
            
            echo view('templates/header', $data);
            echo view("visiteur/listerProduits");
            echo view('templates/footer');
        }
    }

    public function listerProduitsCategorie($nocategorie=false) 
    {
       if($nocategorie==false){
        return redirect()->to('Visiteur/listerProduits');
        }else{
            $session = session();
            $pager = \Config\Services::pager();
            $modelCat = new ModeleCategorie();
            $categorie = $modelCat->retournerCategories($nocategorie);

            $data['categories'] = $modelCat->retournerCategories();
            $data['TitreDeLaPage'] = $categorie["LIBELLE"];
            $modelProd = new ModeleProduit();
            $data["lesProduits"] = $modelProd->retounerProduitsCategorie($nocategorie)->paginate(12);
            $data['pager'] = $modelProd->pager;
            $modelMarq = new ModeleMarque();
            $data['marques'] = $modelMarq->retournerMarques();
     
            echo view('templates/header', $data);
            echo view("visiteur/listerProduits");
            echo view('templates/footer');
      } 
   }

    public function voirProduit($noProduit)
    {
        $modelProd = new ModeleProduit();
        $data["unProduit"] = $modelProd->retournerProduits($noProduit);
        if (empty($data['unProduit'])) {
            //echo view('error404');
            //throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page inconnue');
        }

        $data['TitreDeLaPage'] = $data['unProduit']["LIBELLE"];
        $categorie = $data['unProduit']["NOCATEGORIE"];
        $marque = $data['unProduit']["NOMARQUE"];

        $modelCat = new ModeleCategorie();
        $data['categorie'] = $modelCat->retournerCategories($categorie);
        $data['categories'] = $modelCat->retournerCategories();

        $modelMarq = new ModeleMarque();
        $data['marque'] = $modelMarq->retournerMarques($marque);

        echo view('templates/header', $data);
        echo view('visiteur/voirProduit');
        echo view('templates/footer');
    }

    public function ajouterPanier($noProduit)
    {
        $modelProd = new ModeleProduit();
        $produit = $modelProd->retournerProduits($noProduit);
        $item = array(
            'id'    => $produit["NOPRODUIT"],
            'qty'    => 1,
            'price'    => ($produit["PRIXHT"]) + ($produit["TAUXTVA"]),
            'ht' => $produit["PRIXHT"],
            'tva' => $produit["TAUXTVA"],
            'name'    => $produit["LIBELLE"],
            'image' => $produit["NOMIMAGE"],
            'maxi' => $produit["QUANTITEENSTOCK"]
        );
        $session = session();
        if ($session->has('cart')) {
            $cart =  array_values(session('cart'));
            $index = $this->exists($item['id']);
            if ($index == -1) {
                array_push($cart, $item);
            } else {
                $cart[$index]['qty']++;
            }
            $session->set('cart', $cart);
        } else {
            $cart = array($item);
            $session->set('cart', $cart);
        }
        return redirect()->to('Visiteur/afficherPanier');
    }

    private function exists($id)
    {
        $items = array_values(session('cart'));
        for ($i = 0; $i < count($items); $i++) {
            if ($items[$i]['id'] == $id) return $i;
        }
        return -1;
    }

    function afficherPanier()
    {
        $session = session();
        helper(['form']);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retournerCategories();
        if ($session->has('cart'))
            $data['items'] = array_values(session('cart'));
        else $data['items'] = array();
        echo view('templates/header', $data);
        echo view('visiteur/afficherPanier');
        echo view('templates/footer');
    }

    function suppressionItemPanier($id = '')
    {
        $session = session();
        if ($session->has('cart')) {
            $items =  array_values(session('cart'));
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]['id'] == $id) unset($items[$i]);
            }
            $session->set('cart', $items);
        }
        return redirect()->to('Visiteur/afficherPanier');
    }

    public function miseAJourPanier()
    {
        $session = session();
        if ($session->has('cart')) {
            $items =  array_values(session('cart'));
            $update = $this->request->getPost('update');
            for ($i = 0; $i < count($items); $i++) {
                $items[$i]['qty'] = $update[$items[$i]['id']];
            }
            $session->set('cart', $items);
        }
        return redirect()->to('Visiteur/afficherPanier');
    }

    public function Enregistrer()
    {

        helper(['form']);
        $validation =  \Config\Services::validation();
        $data['TitreDeLaPage'] = "S'enregister";
        $session = session();


        $rules = [ //régles de validation creation
            'txtNom' => 'required',
            'txtPrenom' => 'required',
            'txtAdresse' => 'required',
            'txtVille'    => 'required',
            'txtCP' => 'required',
            'txtEmail' => 'required|valid_email|is_unique[client.EMAIL,id,{id}]',
            'txtMdp'    => 'required'
        ];

        if (!empty($session->get('statut'))) //régles de validation pour modification
            $rules['txtEmail'] = 'required|valid_email';

        $messages = [ //message à renvoyer en cas de non respect des règles de validation
            'txtNom' => [
                'required' => 'Un nom  est requis',
            ],
            'txtPrenom' => [
                'required' => 'Un prénom est requis',
            ],
            'txtAdresse' => [
                'required' => 'Une adresse est requise',
            ],
            'txtVille'    => [
                'required' => 'Une ville est requise',
            ],
            'txtCP' => [
                'required' => 'Un code postal est requis',
            ],
            'txtEmail' => [
                'required' => 'Un Email est requis',
                'valid_email' => 'Un Email valide est requis',
                'is_unique' => 'Cet Email est déjà utilisé',
            ],
            'txtMdp'    => [
                'required' => 'Un mot de passe est requis',
            ]
        ];
        $modelCat = new ModeleCategorie();
        $data_bis['categories'] = $modelCat->retournerCategories();
        echo view('templates/header', $data_bis);
        $modelCli = new ModeleClient();

        if (!$this->validate($rules, $messages)) {

            if ($_POST) //if ($this->request->getMethod()=='post') // si c'est une tentative d'enregistrement // erreur IDE !!
                $data['TitreDeLaPage'] = "Corriger votre formulaire";
            else {
                if (empty($session->get('statut'))) $data['TitreDeLaPage'] = "S'enregister"; // premier affichage création compte sans session
                else { // premier affichage modification compte car session
                    $data['TitreDeLaPage'] = "Modifier mon profil/Droit à l'oublie";
                    $compte = $modelCli->retournerClientNumero($session->get('id'));
                    $data['txtNom'] = $compte['NOM'];
                    $data['txtPrenom'] = $compte['PRENOM'];
                    $data['txtAdresse'] = $compte['ADRESSE'];
                    $data['txtVille'] = $compte['VILLE'];
                    $data['txtCP'] = $compte['CODEPOSTAL'];
                    $data['txtEmail'] = $compte['EMAIL'];
                }
            }
        } else {  // envoi d'une modification de compte (email et mdp aussi ? A VOIR...) ou enregistrement

            $compte = [
                'NOM' => $this->request->getPost('txtNom'),
                'PRENOM' => $this->request->getPost('txtPrenom'),
                'ADRESSE' => $this->request->getPost('txtAdresse'),
                'VILLE' => $this->request->getPost('txtVille'),
                'CODEPOSTAL' => $this->request->getPost('txtCP'),
                'EMAIL' => $this->request->getPost('txtEmail'),
                'MOTDEPASSE' => $this->request->getPost('txtMdp')
            ];

            if (empty($session->get('statut'))) { // enregistrement
                $modelCli->save($compte);
                $data['TitreDeLaPage'] = "Bravo ! vous êtes enregister sur ChopesGames";
            } else { // envoi d'une modification de compte
                $id = $session->get('id');
                if ($modelCli->update($id, $compte))
                    $data['TitreDeLaPage'] = "Bravo ! Mise à jour effectuée";
                else $data['TitreDeLaPage'] = "Sorry";
            }
        }
        echo view('visiteur/Enregistrer', $data);
        echo view('templates/footer');
    }

    public function Connecter()
    {
        helper(['form']);
        $validation =  \Config\Services::validation();
        $session = session();
        $data['TitreDeLaPage'] = 'Se connecter';
        $rules = [ //régles de validation
            'txtEmail' => 'required|valid_email|is_not_unique[client.EMAIL,id,{id}]',
            'txtMdp'   => 'required|is_not_unique[client.MOTDEPASSE,id,{id}]'
        ];

        $messages = [ //message à renvoyer en cas de non respect des règles de validation
            'txtEmail' => [
                'required' => 'Un Email est requis',
                'valid_email' => 'Un Email valide est requis',
                'is_not_unique' => 'Adresse E-mail incorrecte',
            ],
            'txtMdp'    => [
                'required' => 'Un mot de passe est requis',
                'is_not_unique' => 'Mot de passe incorrect',
            ]
        ];
        $modelCat = new ModeleCategorie();
        $data_bis['categories'] = $modelCat->retournerCategories();
        echo view('templates/header', $data_bis);
        if (!$this->validate($rules, $messages)) {
            if ($_POST) //if ($this->request->getMethod()=='post') // si c'est une tentative d'enregistrement // erreur IDE !!
                $data['TitreDeLaPage'] = "Corriger votre formulaire";
            else   $data['TitreDeLaPage'] = "Se connecter";
            echo view('visiteur/Connecter', $data); // sinon premier affichage
        } else {
            $modelCli = new ModeleClient();
            $Identifiant = esc($this->request->getPost('txtEmail'));
            $MdP = esc($this->request->getPost('txtMdp'));

            $UtilisateurRetourne = $modelCli->retournerClientParMail($Identifiant);

            if (!$UtilisateurRetourne == null) {
                // if (password_verify($MdP,$UtilisateurRetourne->MOTDEPASSE))
                // PAS D'ENCODAGE DU MOT DE PASSE POUR FACILITATION OPERATIONS DE TESTS (ENCODAGE A FAIRE EN PRODUCTION!)
                if ($MdP == $UtilisateurRetourne["MOTDEPASSE"]) {
                    if (!empty($session->get('statut'))) {
                        unset($_SESSION['cart']);
                    }
                    $session->set('id', $UtilisateurRetourne["NOCLIENT"]);
                    $session->set('statut', 1);
                    return redirect()->to('Visiteur/accueil');
                } else {
                    $data['TitreDeLaPage'] = 'Mot de passe incorrect';
                    echo view('visiteur/Connecter', $data);
                }
            } else {
                $data['TitreDeLaPage'] = 'Adresse E-mail incorrecte';
                echo view('visiteur/Connecter', $data);
            }
        }
        echo view('templates/footer');
    }

    public function connexionAdministrateur()
    {
        helper(['form']);
        $validation =  \Config\Services::validation();
        $session = session();

        $rules = [ //régles de validation
            'txtIdentifiant' => 'required',
            'txtMotDePasse'   => 'required'
        ];
        $messages = [ //message à renvoyer en cas de non respect des règles de validation
            'txtIdentifiant' => [
                'required' => 'Un identifiant est requis',
            ],
            'txtMotDePasse'    => [
                'required' => 'Un mot de passe est requis',
            ]
        ];

        $modelCat = new ModeleCategorie();
        $data_bis['categories'] = $modelCat->retournerCategories();
        echo view('templates/header', $data_bis);
        if (!$this->validate($rules, $messages)) {
            if ($_POST) //if ($this->request->getMethod()=='post') // si c'est une tentative d'enregistrement // erreur IDE !!
                $data['TitreDeLaPage'] = "Corriger votre formulaire";
            else   $data['TitreDeLaPage'] = "Se connecter";
            echo view('visiteur/connexionAdministrateur', $data); // sinon premier affichage

        } else { //validation ok
            $modelAdm = new ModeleAdministrateur();
            $Identifiant = esc($this->request->getPost('txtIdentifiant'));
            $MdP = esc($this->request->getPost('txtMotDePasse'));
            $adminRetourne = $modelAdm->retournerAdministrateurID($Identifiant);

            if (!$adminRetourne == null) {
                //  if (password_verify($MdP,$adminRetourne->MOTDEPASSE))
                // PAS D'ENCODAGE DU MOT DE PASSE POUR FACILITATION OPERATIONS DE TESTS (ENCODAGE A FAIRE EN PRODUCTION!)
                if ($MdP == $adminRetourne["MOTDEPASSE"]) {
                    $session->set('identifiant', $adminRetourne["IDENTIFIANT"]);
                    $session->set('mail', $adminRetourne["EMAIL"]);
                    if (!empty($session->get('statut'))) {
                        unset($_SESSION['cart']);
                    }
                    if ($adminRetourne["PROFIL"] == 'Employé') {
                        $session->set('statut', 2);
                    } elseif ($adminRetourne["PROFIL"] == 'Super') {
                        $session->set('statut', 3);
                    }
                    return redirect()->to('Visiteur/accueil');
                } else {
                    $data['TitreDeLaPage'] = 'Mot de passe incorrect';
                    echo view('visiteur/connexionAdministrateur', $data);
                }
            } else {
                $data['TitreDeLaPage'] = 'Identifiant incorrecte';
                echo view('visiteur/connexionAdministrateur', $data);
            }
            echo view('templates/footer');
        }
    }

    public function prodById(int $id)
    {
        $modelProd = new ModeleProduit();
        $slug= $modelProd->retournerSlug($id);
    //redirection   
        if ($slug != null)
        { 
        // return redirect()->to('games/'.$slug['NOMIMAGE'].'/'.$slug['NOMMARQUE']); !!!!slug fous la merde pour voir un produit a approfondir
        $this->voirProduit($id);
        }
    //else redirect 404 ?
    }
    public function prodBySlug($slug)
    {
        $modelProd = new ModeleProduit();
        $id= $modelProd->retournerId($slug);
    //pas de redirection mais invocation de la méthode déjà programmée     
        if ($id != null)
        { 
        $this->voirProduit($id);
        }
    //else redirect 404 ?
    }

}