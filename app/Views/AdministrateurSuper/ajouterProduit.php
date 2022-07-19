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
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <br>                   
                    <?php if ($TitreDeLaPage == 'Corriger votre formulaire') ;
                    echo form_open_multipart('AdministrateurSuper/ajouterProduit');
                    ?>
                    <div class="login-box">
                        <select id="Categorie" class="selectpicker show-tick form-control">
                            <option>Catégories</option>                        
                            <?php foreach ($categories as $uneCategorie) : ?>
                            <option value="<?php echo $uneCategorie['NOCATEGORIE']; ?>" <?php if (set_value('Categorie') == $uneCategorie['NOCATEGORIE']) echo 'selected'; ?>><?php echo $uneCategorie['LIBELLE'] ?></option>
                            <?php endforeach; ?>                      
                        </select> 
                    </div>
                    <div class="login-box">
                        <select id="Marque" class="selectpicker show-tick form-control">
                            <option>Marque</option>                        
                            <?php foreach ($marques as $uneMarque) : ?>
                            <option Value="<?php echo $uneMarque['NOMARQUE']; ?>" <?php if (set_value('Marque') == $uneMarque['NOMARQUE']) echo 'selected'; ?>><?php echo $uneMarque['NOM'] ?></option>
                            <?php endforeach; ?>                      
                        </select> 
                    </div>
                     <br />

                    <label class="text-primary" for="txtLibelle">Libelle:</label>
                    <input class="form-control" type="input" name="txtLibelle" value="<?php echo set_value('txtLibelle'); ?>" /><br />

                    <label class="text-primary" for="txtDetail">Detail:</label>
                    <textarea class="form-control" type="input" class="form-control" name="txtDetail"><?php echo set_value('txtDetail'); ?></textarea><br />

                    <label class="text-primary" for="txtPrixHT">Prix HT:</label>
                    <input class="form-control" type="input" name="txtPrixHT" value="<?php echo set_value('txtPrixHT'); ?>" /><br />

                    <label class="text-primary" for="txtNomimage">Nom image:</label>
                    <input class="form-control" type="input" name="txtNomimage" value="<?php echo set_value('txtNomimage'); ?>" /><br />

                    <label class="text-primary" for="fileimage">Image: </label><br />
                    <input type="file" name="image" /><br />
                    <label class="text-primary" for="txtQuantite">Quantite:</label>
                    <input class="form-control" type="input" name="txtQuantite" value="<?php echo set_value('txtQuantite'); ?>" /><br />

                    <input class="btn hvr-hover" type="submit" name="submit" value="Ajouter un produit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>