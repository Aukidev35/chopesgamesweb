<!DOCTYPE html>
<html>
    <?php
    use App\Controllers\AdministrateurSuper;
    $session = session();
    if ($session->has('cart')) 
    {
        $cart = session('cart');
        $nb = count($cart);
    } 
    else $nb = 0; ?>
    <head>
        <!-- titre -->
        <title>ChopesGames</title>
        <!-- méta -->
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- link -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . 'assets/images/favicon.ico' ?>">
        <!-- Ancien -->
        <link rel="alternate" type="application/rss+XML" title="ChopesGames" href="<?php echo site_url('AdministrateurSuper/flux_rss') ?>" />
        <link rel="stylesheet" href="<?= css_url('bootstrap.min') ?>">
        <link rel="stylesheet" href="<?= css_url('style') ?>">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <!-- Nouveau -->
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= css_url('bootstrap.min') ?>">
        <!-- Site CSS -->
        <link rel="stylesheet" href="<?= css_url('style') ?>">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="<?= css_url('responsive') ?>">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?= css_url('custom') ?>">
        <!-- All CSS -->
        <link rel="stylesheet" href="<?= css_url('all') ?>">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?= css_url('animate') ?>">
        <!-- baguetteBox CSS -->
        <link rel="stylesheet" href="<?= css_url('baguetteBox.min') ?>">
        <!-- bootsnav CSS -->
        <link rel="stylesheet" href="<?= css_url('bootsnav.min') ?>">
</head>
    <body>
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container-fluid">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" 
                    aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url('Visiteur/accueil') ?>">
                        <img style="width:260px;height: 75px;" src="<?= base_url() . '/assets/images/logochopesgamesheader1.png' ?>" class="logo" alt="">
                    </a>
                </div>
                <!-- End Header Navigation -->
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-link" href="<?php echo site_url('Visiteur/accueil') ?>">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('Visiteur/listerProduits') ?>">Nos produits</a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown">Catégories</a>
                            <div class="dropdown-menu">
                                <?php foreach ($categories as $categorie){?>
                                <a class="dropdown-item" href="<?php echo site_url('Visiteur/listerProduitsCategorie/'.$categorie["NOCATEGORIE"]) ?>"><?php echo $categorie["LIBELLE"]?></a>           
                                <?php } ?>
                            </div>
                        </li>            
                        <?php if ($session->get('statut') == 2 or $session->get('statut') == 3) : ?>
                        <li class="nav-item">
                            <a  class="nav-link dropdown-toggle " data-toggle="dropdown">
                                Administration
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurEmploye/afficherClients') ?>">Clients->Commandes</a>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurEmploye/commandesNonTraitees') ?>">Commandes non traitées</a>
                                <?php if ($session->get('statut') == 3) { ?>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouterProduit') ?>">Ajouter un produit</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouterCategorie') ?>">Ajouter une catégorie</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouterMarque') ?>">Ajouter une marque</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouterAdmin') ?>">Ajouter un administrateur</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/listerAdmin') ?>">Gérer les administrateurs</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/modifierIdentifiantsBancaires') ?>">Modifier identifiants bancaires site</a>
                                    <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/saisiNewsletter') ?>">newsletter</a>
                                <?php } ?>
                            </div>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item ">
                            <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown">Connexion/S'enregistrer</a>
                            <div class="dropdown-menu">
                                <?php if (!is_null($session->get('statut'))) { ?>
                                    <?php if ($session->get('statut') == 1) { ?>
                                        <a class="dropdown-item" href="<?php echo site_url('Client/historiqueCommandes') ?>">Mes commandes</a>
                                        <a class="dropdown-item" href="<?php echo site_url('Visiteur/Enregistrer') ?>">Modifier son compte</a>
                                        <a class="dropdown-item" href="<?php echo site_url('Visiteur/Enregistrer') ?>">Supprimer mon compte</a>
                                    <?php } elseif ($session->get('statut') == 3) { ?>
                                        <a class="dropdown-item" href="<?php  echo site_url('AdministrateurSuper/modifierAdmin/'.$session->get('identifiant'))?>">Modifier son compte</a>
                                    <?php } ?>
                                    <a class="dropdown-item" href="<?php echo site_url('Client/Deconnecter') ?>">Se déconnecter</a>
                                <?php } else { ?>
                                    <a class="dropdown-item" href="<?php echo site_url('Visiteur/Connecter') ?>">Se connecter</a>
                                    <a class="dropdown-item" href="<?php echo site_url('Visiteur/Enregistrer') ?>">S'enregister</a>
                                <?php } ?>
                            </div>
                        </li>
                        <?php if (empty($session->get('statut'))) : ?>
                            <li class="nav-item droite">
                                <a href="<?php echo site_url('Visiteur/connexionAdministrateur') ?>" class="fas fa-lock"></a>
                            </li>
                        <?php endif; ?>
                        <form class="search-form" method="post" action="<?php echo site_url('Visiteur/listerProduits') ?>" >
                                <div class="input-group rounded">
                                    <input type="text" name="search" id='search' class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                    <button type="submit">&#128269</button>                                   
                                </div> 
                        </form>   
                    </ul>
                    </div>
                    <div class="attr-nav">
                        <ul>
                            <li class="side-menu">
                                <a href="<?php echo site_url('Visiteur/afficherPanier') ?>">
                                    <i class="fas fa-shopping-cart"></i>
                                    <p>Mon panier</p>
                                </a>
                            </li>
                        </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>