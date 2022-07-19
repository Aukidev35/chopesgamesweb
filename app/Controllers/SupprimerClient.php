<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeleProduit;
use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\ModeleMarque;
use App\Models\ModeleAdministrateur;

helper(['url', 'assets']);
class SupprimerClient extends BaseController
{
    function suppressionCompte()
    {
        $session = session();
        $noclient = $session->get('id');
        
    }
}