<!-- banderole -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
    <h2>Mes commandes:</h2>            
    </div>
  </div>
</div>
<!-- fin de banderole -->
    <div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                    <div class="container col-md-5">
                   
                    <table class="table table-hover">
                            <thead>
                                <tr>
                                
                                <th width="10%">Date de commande</th>
                                <th width="15%">Total TTC</th>
                                
                                </tr>
                            </thead>
                        <?php
                        foreach($commandes as $commande){
                            $NumComm = $commande["NOCOMMANDE"];?>
                        <tr onclick="window.location.href = '<?php echo site_url('client/detailsCommande/'.$NumComm) ?>'" class="hover">
                            <td><?php echo substr($commande["DATECOMMANDE"],0,10);?> </td>
                            <td> <?php echo $commande["TOTALTTC"].'€';?></td> </tr>
                        <?php }?></table>
                    </div>
            </div>
        </div>
    </div>
