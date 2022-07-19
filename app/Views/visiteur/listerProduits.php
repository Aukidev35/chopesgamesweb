<?php $session = session(); ?>
<!-- banderole -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
    <h2 class='titrepage'><?php echo $TitreDeLaPage ?></h2><hr/>               
    </div>
  </div>
</div>
<!-- fin de banderole -->
<!-- <h2 class='titrepage'><:?php echo $TitreDeLaPage ?></h2><hr/>  -->
<div class="container-fluid">
    <div class="row">
        <!-- liste des catégories -->
        <div class="col-sm-2 categorie">
            <div class="filter-sidebar-right" >
                <div class="card-header">
                    Categories:
                </div>
                <div class="card-body">
                    <?php foreach ($categories as $categorie) { echo '<h4>'.anchor('Visiteur/listerProduitsCategorie/'.$categorie["NOCATEGORIE"],$categorie["LIBELLE"]). '</h4>'; ?><?php } ?>
                </div>
            </div>        
        </div>
         <!--fin de liste catégorie  -->
         <!-- début de la liste de toutes les catégories -->
        <div class="col-sm-8">
            <div class="container">
                <div class="row">
                    <?php if($lesProduits==null){echo '<h3>Aucun produit correspondant à cette recherche</h3>';} ?>
                    <?php $count=0; foreach ($lesProduits as $unProduit){$count++; ?>
                    <div class="col-md-3 col-sm-5">
                        <div class="product-grid">
                            <div class="shop-cat-box"> 
                                <img class="img-fluid" src="<?= base_url() . '/games/'. $unProduit["NOMARQUE"].'/'.$unProduit["NOMIMAGE"] ?>" alt="" />
                                <!-- <a href="</?= base_url() . '/games/'. $unProduit["NOMARQUE"].'/'.$unProduit["NOMIMAGE"] ?>">  -->
                                <!-- ancienne balise avant le slug -->
                                <!-- <a href="</?= base_url().'/Visiteur/voirProduit/'.$unProduit["NOPRODUIT"]?>"> -->
                                <!-- ***************************** -->
                                <?php  
                                if(!empty($unProduit["NOMIMAGE"])) echo img_class($unProduit["NOMIMAGE"].'.jpg', $unProduit["LIBELLE"],'img-responsive image');
                                else echo img_class('nonimage.jpg', $unProduit["LIBELLE"],'img-responsive image');
                                ?>
                                </a>
                            </div>
                            <div class="product-content">
                                <h3 class="title"><a class="btn hvr-hover" href="<?= base_url().'/Visiteur/voirProduit/'.$unProduit["NOPRODUIT"]?>"><?php echo $unProduit["LIBELLE"] ?></a>
                                <?php if($session->get('statut')==3){?>
                                <a  href="<?php echo site_url('AdministrateurSuper/Vitrine/'.$unProduit["NOPRODUIT"]);  ?>"><?php if($unProduit['VITRINE']==1){ echo "<i class='fas fa-star fav'></i>";}else{echo "<i class='far fa-star fav'></i>";}?> </a>
                                <?php }?></h3>
                                <div class="btn hvr-hover">
                                    <?php echo number_format((($unProduit["PRIXHT"]) + ($unProduit["TAUXTVA"])), 2 , "," , ' '),'€' ?>
                                </div>
                                <?php if($session->get('statut')==3){
                                if($unProduit["DISPONIBLE"]==0){
                                ?>
                                <a class="disponible" href="<?php echo site_url('AdministrateurSuper/rendreDisponible/'.$unProduit["NOPRODUIT"]);  ?>">Rendre disponible</a>
                                <?php } else{?>
                                <a class="indisponible" href="<?php echo site_url('AdministrateurSuper/rendreIndisponible/'.$unProduit["NOPRODUIT"]);  ?>">Rendre indisponible</a>
                                <?php } ?>
                                <?php }else{?>
                                <?php if($unProduit["DISPONIBLE"]==0){echo 'Rupture de stock..'; }?><br/>
                                <div class='container'>  
                                    <a class="btn btn-info <?php if($unProduit["DISPONIBLE"]==0){echo 'disabled'; }?>" href="<?php echo site_url('Visiteur/ajouterPanier/'.$unProduit["NOPRODUIT"]);  ?>">Ajouter au panier</a>
                                </div> <?php } ?>
                            </div>
                        </div>
                    </div>                                  
                    <?php if($count%4 ==0){echo '</div><br/><hr/><br/><div class="row">';}
                    }?>
                </div>
            </div>
        </div>
            <div class="col-sm-2 marque">
                <div class="filter-sidebar-left" >
                    <div class="card-header">
                        Marque:
                    </div>
                    <div class="card-body">
                        <?php foreach ($marques as $marque){ echo '<h4>'.anchor('Visiteur/listerProduitsMarque/'.$marque["NOMARQUE"],$marque["NOM"]). '</h4>'; ?><?php } ?>
                    </div>
                </div>  
                </div>
                <p><?= $pager->links() ?></p>
        </div>    
    </div>