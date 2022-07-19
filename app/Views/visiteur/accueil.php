<!-- banderole -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
      <h2>Accueil</h2>               
    </div>
  </div>
</div>
<!-- fin de banderole -->
<!-- début du sorps -->
<div class="container-fluid">
  <div class="row">
    <!-- liste catégorie côté gauche -->
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
    <!-- fin liste catégorie -->
    <!-- début du caroussel -->   
    <div class="col-sm-8">
      <div class="container">
        <div class="container-fluid" style="width:300px;height:450px;">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <?php $countcarousel=0; foreach($vitrines as $vitrine): $countcarousel++;?>
              <li data-target="#carouselExampleIndicators" <?php if($countcarousel===1): ?> data-slide-to="0" class="active" <?php else: ?> data-slide-to="<?php echo $countcarousel-1 ?>"<?php endif ?>></li>
              <?php endforeach;?>
            </ol>
            <div class="carousel-inner">
              <?php $count = 0; 
              $indicators = ''; 
              foreach ($vitrines as $vitrine): 
              $count++; 
              if ($count === 1) 
              { 
                $class = 'active'; 
              } 
              else 
              { 
                $class = ''; 
              }?> 
              <div class="carousel-item <?php echo $class; ?>">
                <a href="<?= base_url().'/index.php/Visiteur/voirProduit/'.$vitrine["NOPRODUIT"]?>">
                  <?= img_class($vitrine["NOMIMAGE"] . '.jpg', $vitrine["LIBELLE"], 'd-block'); ?>
                </a>
              </div>
              <?php endforeach;?> 
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>        
          </div>
        </div>
      </div>
    </div> 
    <!-- fin du caroussel -->
    <!-- liste des marques côté droite -->
    <div class="col-sm-2 marque">
      <div class="filter-sidebar-left" >
        <div class="card-header">
          Marque:
        </div>
        <div class="card-body">
          <?php foreach ($marques as $marque)
          { 
            echo '<h4>'.anchor('Visiteur/listerProduitsMarque/'.$marque["NOMARQUE"],$marque["NOM"]). '</h4>'; ?><?php 
          } ?>
        </div>
      </div>  
    </div>
    <!--  fin de liste marque -->
  </div>
</div>



