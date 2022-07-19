


=====> code pour tester identifiant et mot de passe lors de la supression d'un compte 06/01/2022
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
         echo view('templates/header');
         if (!$this->validate($rules, $messages)) 
         {
             if ($_POST) //if ($this->request->getMethod()=='post') // si c'est une tentative d'enregistrement // erreur IDE !!
             {
                 $data['TitreDeLaPage'] = "Quelque chose cloche";
             }
             else
            {   
             $data['TitreDeLaPage'] = "supprimerCompte";
             }
         }
         else
         {