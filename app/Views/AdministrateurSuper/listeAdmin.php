<!-- banderole -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
    <h2><?php echo $TitreDeLaPage ?></h2>        
    </div>
  </div>
</div>
<!-- fin de banderole -->

<div>
    <ul class="cart-box">
        <?php foreach($admin as $admin)
        {?> 
        <li class="cart-list">
            <ul>
                <?php  echo $admin['IDENTIFIANT'] ?>
                <a class="btn hvr-hover" href="<?= site_url('administrateurSuper/modifierAdmin/'.$admin['IDENTIFIANT']) ?>">Modifier</a>&emsp; &emsp;
                <a class="btn hvr-hover" href="<?= site_url('AdministrateurSuper/supprimerAdmin/'.$admin['IDENTIFIANT']) ?>">Supprimer</a>
            </ul>
        </li> <?php
        }?>
    </ul>
</div>
