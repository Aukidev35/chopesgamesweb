<!-- banderole -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
    <h2>Historique commande</h2>          
    </div>
  </div>
</div>
<!-- fin de banderole -->
    <div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                    <div class="container col-md-5">
                    <h4>Client: <?php echo $client['NOM']; echo ' '.$client['PRENOM'];?></h4> 
                    <table class="table table-hover">
                            <thead>
                                <tr>
                                
                                <th width="10%">Date de commande</th>
                                <th width="15%">Total TTC</th>
                                
                                </tr>
                            </thead>
                        <?php
                        foreach($commandes as $commande){?>
                        <tr onclick="window.location.href = '<?php echo site_url('AdministrateurEmploye/detailsCommande/'.$commande['NOCOMMANDE']) ?>'" class="hover">
                            <td><?php echo substr($commande['DATECOMMANDE'],0,10);?> </td>
                            <td> <?php echo $commande['TOTALTTC'].'€';?></td> </tr>
                        <?php }?></table>
                    </div>
            </div>
        </div>
    </div>
