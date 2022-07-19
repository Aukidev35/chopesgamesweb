<?php
echo form_open('visiteur/miseAJourPanier');
$session = session();
?>
<!-- Banderolle -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
        <h2 class='titrepage'>Panier</h2><hr/>               
    </div>
  </div>
</div>
<!-- fin de banderolle -->
<div class="container col-md-8 col-sm-12 toppro">
    <div class="row align-items-center">
        <table class="table table-responsive-md">
            <tr>
                <th width="10%"></th>
                <th width="30%">Produit</th>
                <th width="15%">Prix</th>
                <th width="13%">Quantité</th>
                <th width="25%">Total produit</th>
                <th width="12%"></th>
            </tr>
            <?php $total = 0; ?>
            <?php if (count($items) > 0) {
                foreach ($items as $item) : ?>                   
                    <tr>
                        <td>
                            <?php if (!empty($item['image'])) { ?>
                                <a href="<?= base_url() . '/index.php/Visiteur/voirProduit/' . $item['id'] ?>"><?= img_class($item['image'] . '.jpg', 'image','img_panier')?></a>
                            <?php } else { ?>
                                <a href="<?= base_url() . '/index.php/Visiteur/voirProduit/' . $item['id'] ?>"><img src="<?= base_url() . '/assets/images/nonimage.jpg' ?>" width="80" /></a>
                            <?php } ?>
                        </td>
                        <td><a href="<?= base_url() . '/index.php/Visiteur/voirProduit/' . $item['id'] ?>"><?php echo $item['name']; ?></a></td>
                        <td><?php echo $item['price']; ?>€</td>
                        <td><?php echo form_input(array('name' => 'update['.$item['id'].']', 'type' => 'number', 'class' => 'form-control', 'style' => 'width:75px', 'value' => $item['qty'], 'min' => 1, 'max' => $item['maxi'])); ?></td>
                        <td><?php echo $item['price']*$item['qty']; ?>€</td>
                        <td><a href="<?php echo site_url('visiteur/suppressionItemPanier/' . $item["id"]); ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    </tr>
                    <?php $total += $item['price']*$item['qty']; ?>
                <?php endforeach;
            } else { ?>
                <tr>
                    <td colspan="6">
                        <p>Aucun produit dans le panier</p>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td><a href="<?php echo site_url('visiteur/listerProduits'); ?>" class="btn btn-warning">Continuer<br>vos achats</a></td>
                <td colspan="2"></td>
                <td><?php echo form_submit('quantité', 'Modifier', "class='btn btn-info'"); ?></td>
                <?php if (count($items) > 0) { ?>
                    <td>Total :<br><b><?php echo $total . ' €'; ?></b></td>
                    <?php if (!empty($session->get('statut'))) { ?>
                        <td><a href="<?php echo site_url('Client/validationCommande'); ?>" class="btn btn-success">Passer la<br>commande</a></td>
                    <?php } else { ?>
                        <td><a href="<?php echo site_url('visiteur/Connecter'); ?>" class="btn btn-success">Passer la<br>commande</a></td>
                <?php };
                } ?>
            </tr>
        </table>
        <?php echo form_close(); ?>
    </div>
</div>